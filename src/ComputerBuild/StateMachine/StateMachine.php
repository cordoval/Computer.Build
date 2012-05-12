<?php

namespace

require 'computer_build/vhdl'

class StateMachine
{
    use StatementTrait;

    public function __construct($name)
    {
        $this->name = $name;
        $this->statements = array();
    }

    public function setStatements($statements)
    {
        $this->statements = $statements;
    }

    public function addStatement($statement)
    {
        $this->statements[] = $statement;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFullName($shortName)
    {
        return "state_".$shortName;
    }
}

class Transition
attr_reader :from, :to, :condition
def initialize(options)
@from = options[:from]
@to = options[:to]
@condition = options[:condition] || options[:on]
end
end

class StateMachine
include VHDL::Helpers
def initialize(name, body)
@name = name
@inputs = []
@outputs = []
@inouts = []
@signals = []
@states = []
@transitions = []
body[self]
end

def inputs(*rest)
@inputs = rest
end

def input(name, type)
@inputs << [name, type]
end

def outputs(*rest)
@outputs = rest
end

def output(name, type)
@outputs << [name, type]
end

def inout(name, type)
@inouts << [name, type]
end

def signal(*rest)
@signals << rest
end

def state(name, &body)
@states << State.new(name, body)
end

def reset(&body)
@reset = body
end

def transition(options)
@transitions << Transition.new(options)
end

def generate(out)
representation = entity(@name) do |e|
e.port "clock", :in, VHDL::STD_LOGIC

@inputs.each do |pair|
name, type = pair
e.port name, :in, type
end

@outputs.each do |pair|
name, type = pair
e.port name, :out, type
end

@inouts.each do |pair|
name, type = pair
e.port name, :inout, type
end

e.type "STATE_TYPE", @states.map {|s| "state_"+s.name.to_s}
e.signal "state", "STATE_TYPE"
@signals.each do |args|
e.signal(*args)
end

e.behavior do |b|
b.process [:clock, :reset, :state] do |p|
if @reset
ifelse = p.if(equal(:reset, '1')) do |b|
def b.goto(state)
self.assign(:state, ("state_"+state.to_s).to_sym)
end
@reset.call(b)
end

ifelse.else do |b|
b.case :state do |c|
@states.each do |state|
c["state_" + state.name.to_s] = state
end
end

b.if event(:clock), equal(:clock, "1") do |b|
@transitions.each do |transition|
conditions = [equal(:state, State.full_name(transition.from))]
conditions << transition.condition unless transition.condition.nil?
b.if(*conditions) do |c|
c.assign(:state, State.full_name(transition.to))
end
end
end
end
else
p.case :state do |c|
@states.each do |state|
c["state_" + state.name.to_s] = state
end
end

p.if event(:clock), equal(:clock, "1") do |b|
@transitions.each do |transition|
conditions = [equal(:state, State.full_name(transition.from))]
conditions << transition.condition unless transition.condition.nil?
b.if(*conditions) do |c|
c.assign(:state, State.full_name(transition.to))
end
end
end
end
end # process
end
end

representation.generate(out)
end
end
end

def state_machine(name, &body)
ComputerBuild::StateMachine.new(name, body)
end
