module VHDL
  STD_LOGIC = "STD_LOGIC"

  def self.STD_LOGIC_VECTOR(range)
    if range.first > range.last
      return "STD_LOGIC_VECTOR(#{range.first} downto #{range.last})"
    else
      return "STD_LOGIC_VECTOR(#{range.first} upto #{range.last})"
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

# Monkeypatching
class Symbol
  def <=(other)
    return assign(self, other)
  end
end

