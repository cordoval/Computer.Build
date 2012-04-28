Feature: Hardware Add
  In order to deploy an adder
  As a geek user
  I need to be able to generate and deploy hardware

  Scenario: generate
    Given I have php adder class

#  Scenario: Generate a vhdl adder file
#    Given I can generate vhdl
#    When I create high level php class of adding system
#    Then I see that vhdl for the classes get generated

#  Scenario: Simulate vhdl adder file
#    Given I can simulate vhdl
#    When I apply stimuli to SUT
#    Then I see that SUT outputs correct results

#  Scenario: Deploy adder to FPGA
#    Given I can deploy bitstream to FPGA
#    When I deploy adder to FPGA
#    Then I get working adder programmed on FPGA

