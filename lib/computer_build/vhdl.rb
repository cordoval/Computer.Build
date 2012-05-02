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



# Monkeypatching
class Symbol
  def <=(other)
    return assign(self, other)
  end
end

