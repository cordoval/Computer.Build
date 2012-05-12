module VHDL
  STD_LOGIC = "STD_LOGIC"

# Monkeypatching
class Symbol
  def <=(other)
    return assign(self, other)
  end
end

