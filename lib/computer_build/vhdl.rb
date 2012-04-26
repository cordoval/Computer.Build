module VHDL
  STD_LOGIC = "STD_LOGIC"

  def self.STD_LOGIC_VECTOR(range)
    if range.first > range.last
      return "STD_LOGIC_VECTOR(#{range.first} downto #{range.last})"
    else
      return "STD_LOGIC_VECTOR(#{range.first} upto #{range.last})"
    end
  end

  module StatementBlock
    def case(input, &body)
      @statements << Case.new(input, body)
    end

    def if(*conditions, &body)
      ifthenelse = If.new(conditions, body)
      @statements << ifthenelse
      return ifthenelse
    end

    def assign(*args)
      @statements << Assignment.new(*args)
    end

    def high(target)
      assign(target, '1')
    end

    def low(target)
      assign(target, '0')
    end

    # Default generate, generally overridden
    def generate(out, indent)
      @statements.each {|s| s.generate(out, indent + 1)}
    end
  end

  class SingleLineStatement < Statement
    def generate(out, indent)
      out.print "  " * indent
      out.print self.line()
      out.print "\n"
    end
  end

  class Entity
    attr_reader :name
    def initialize(name, body)
      @name = name
      @ports = []
      @signals = []
      @types = []
      @components = []
      body[self]
    end

    def port(*args)
      @ports << Port.new(*args)
    end

    def signal(*args)
      @signals << Signal.new(*args)
    end


    def behavior(&body)
      @behavior = Behavior.new(body)
    end

    def type(*args)
      @types << Type.new(*args)
    end

    def component(*args, &body)
      @components << Component.new(*args, &body)
    end

    def generate(out=$stdout)
      out.puts "ENTITY #{@name} IS"
      out.puts "PORT("
      @ports.each_with_index do |port, index|
        port.generate(out, 1, (index == @ports.length-1))
      end
      out.puts ");"
      out.puts "END #{@name};"
      out.puts "ARCHITECTURE arch_#{@name} OF #{@name} IS"
      @types.each {|t| t.generate(out, 1)}
      @signals.each {|t| t.generate(out, 1)}
      @components.each {|c| c.generate(out, 1)}
      out.puts "BEGIN"
      @behavior.generate(out, 1)
      out.puts "END arch_#{@name};"
    end
  end

  class Component < MultiLineStatement
    def initialize(name)
      @name = name
      @ports = []
      yield(self)
    end

    def in(name, type)
      @ports << Port.new(name, :in, type)
    end

    def out(name, type)
      @ports << Port.new(name, :out, type)
    end

    def inout(name, type)
      @ports << Port.new(name, :inout, type)
    end

    def generate(out, indent)
      prefix = "  " * indent
      out.puts prefix + "COMPONENT #{@name}"
      out.puts prefix + "PORT("
      @ports.each_with_index do |port, index|
        port.generate(out, indent+1, (index == @ports.length-1))
      end
      out.puts prefix + ");"
      out.puts prefix + "END COMPONENT;"
    end
  end

  class Behavior
    include StatementBlock

    def initialize(body)
      @statements = []
      body.call(self)
    end

    def process(inputs, &body)
      @statements << VHDL::Process.new(inputs, body)
    end

    def instance(*args)
      @statements << Instance.new(*args)
    end
  end

  class Process
    include StatementBlock
    def initialize(inputs, body)
      @inputs = inputs
      @statements = []
      body[self]
    end

    def generate(out, indent)
      prefix = "  " * indent
      args = @inputs.map(&:to_s).join(',')
      out.puts prefix + "PROCESS(#{args})"
      out.puts prefix + "BEGIN"
      @statements.each {|s| s.generate(out, indent + 1)}
      out.puts prefix + "END PROCESS;"
    end
  end

  class Case
    def initialize(input, body)
      @input = input
      @conditions = {}
      body.call(@conditions)
    end

    def generate(out, indent)
      prefix = "  " * indent
      out.puts prefix+"CASE #{@input} IS"
      @conditions.each do |pair|
        condition, expression = pair
        out.print prefix+"  WHEN "
        if condition =~ /^\d$/
          out.print "'#{condition}'"
        elsif condition =~ /^\d+$/
          out.print "\"#{condition}\""
        else
          out.print condition
        end
        out.print " =>"
        if expression.is_a? InlineStatement
          out.puts expression.generate
        else
          out.puts
          expression.generate(out, indent+1)
        end
      end
      out.puts prefix+"END CASE;"
    end
  end

  class If < MultiLineStatement
    include StatementBlock

    def initialize(conditions, body)
      @conditions = conditions
      @compound = false
      @statements = []
      body[self]
    end

    def elsif(*conditions, &body)
      unless @compound
        @clauses = [@statements]
        @conditions = [@conditions]
      end
      @compound = true

      @statements = []
      body.call(self)
      @clauses << @statements
      @conditions << conditions
    end

    def else(*conditions, &body)
      @whentrue = @statements
      @statements = []
      body.call(self)
    end

    def generate(out, indent)
      prefix = "  " * indent
      if @compound
        conditions = @conditions.first.map(&:generate).join(' and ')
        out.puts(prefix+"IF #{conditions} THEN")
        @clauses.first.each {|s| s.generate(out, indent+1)}
        @clauses[1..100].zip(@conditions[1..100]).each do |statements, conditions|
          conditions = conditions.map(&:generate).join(' and ')
          out.puts(prefix+"ELSIF #{conditions} THEN")
          statements.each {|s| s.generate(out, indent+1)}
        end
        out.puts(prefix+"END IF;")
      elsif @whentrue
        conditions = @conditions.map(&:generate).join(' and ')
        out.puts(prefix+"IF #{conditions} THEN")
        @whentrue.each {|s| s.generate(out, indent+1)}
        out.puts(prefix+"ELSE")
        @statements.each {|s| s.generate(out, indent+1)}
        out.puts(prefix+"END IF;")
      else
        conditions = @conditions.map(&:generate).join(' and ')
        out.puts(prefix+"IF #{conditions} THEN")
        @statements.each {|s| s.generate(out, indent+1)}
        out.puts(prefix+"END IF;")
      end
    end
  end

  class Event < InlineStatement
    def initialize(target)
      @target = target
    end

    def generate
      "#{@target.to_s}'EVENT"
    end
  end

  class Invert < InlineStatement
    def initialize(body)
      @body = body
    end

    def generate
      "NOT (#{@body})"
    end
  end

  class Block < MultiLineStatement
    include StatementBlock

    def initialize(body)
      @statements = []
      body.call(self)
    end
  end

# Global scope methods for creating stuff

  module Helpers
    def entity(name, &body)
      VHDL::Entity.new(name, body)
    end

    def assign(target, expression)
      VHDL::Assign.new(target, expression)
    end

    def high(target)
      assign(target, '1')
    end

    def low(target)
      assign(target, '0')
    end

    def equal(target, expression)
      VHDL::Equal.new(target, expression)
    end

    def event(target)
      VHDL::Event.new(target)
    end

    def block(&body)
      VHDL::Block.new(body)
    end

    def subbits(sym, range)
      "#{sym}(#{range.first} downto #{range.last})".to_sym
    end

    def invert(body)
      VHDL::Invert.new(body)
    end
  end
end

# Monkeypatching
class Symbol
  def <=(other)
    return assign(self, other)
  end
end

class Fixnum
  def to_logic(width)
    str = self.to_s(2)
    return "0"*(width-str.length) + str
  end
end


def generate_vhdl(entity, out=$stdout)
  out.puts "LIBRARY ieee;"
  out.puts "USE ieee.std_logic_1164.all;"
  out.puts "USE ieee.numeric_std.all;"
  out.puts
  entity.generate(out)
end
