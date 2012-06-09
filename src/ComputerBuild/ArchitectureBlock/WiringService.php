<?php

namespace ComputerBuild\ArchitectureBlock;

/**
 *
 * Wiring Service class
 *
 * It knows what is wired to what
 *
 */
class WiringService
{
    protected $circuitList;

    public function getCircuitList()
    {

    }

    public function getValue($wireAddress)
    {
        return 1;
    }

    /**
     * wire
     *     -----            ------
     *    |left|   ----->  |right|
     *    -----            ------
     * @param $nonSmartWiringUserSpec
     */
    public function buildCircuitList(array $nonSmartWiringUserSpec)
    {
        foreach ($nonSmartWiringUserSpec as $left => $right) {
            // build a wire from $left to $right
            // each object can be port or component
            // modes : strict and overload @todo
            if ($right instanceof Port) {
                $to = $right;
            } else {
                $to = $right->getUnusedInputPort();
            }
            if ($left instanceof Port) {
                $from = $left;
            } else {
                $from = $left->getUnusedOutputPort();
            }
            $this->circuitList[] = array($from => $to);
        }
    }
}