<?php

namespace Tests\ComputerBuild\ArchitectureBlock;

use ComputerBuild\ArchitectureBlock\FactoryAdder;
use ComputeBuild\ArchitectureBlock\Adder;

class FactoryAdderTest extends \PHPUnit_Framework_TestCase{

  public function testAdderInstance()
  {
    $expectedInstance = new Adder();
    $actualInstance = FactoryAdder::getInstance()->create();
    $this->assertEquals($actualInstance, $expectedInstance);
  }
}
