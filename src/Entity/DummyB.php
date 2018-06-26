<?php

namespace App\Entity;


class DummyB extends AbstractDummyA {
    /**
     * @var string
     */
    private $b;

    protected $type = 'b';

    /**
     * @return string
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * @param string $b
     * @return AbstractDummyA
     */
    public function setB(string $b): AbstractDummyA
    {
        $this->b = $b;
        return $this;
    }
}