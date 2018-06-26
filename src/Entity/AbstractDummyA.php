<?php

namespace App\Entity;

abstract class AbstractDummyA {
    /**
     * @var string
     */
    private $a;

    /**
     * @return string
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * @param string $a
     * @return AbstractDummyA
     */
    public function setA(string $a): AbstractDummyA
    {
        $this->a = $a;
        return $this;
    }
}