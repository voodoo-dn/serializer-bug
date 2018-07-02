<?php

namespace App\Entity;


class DummyC extends AbstractDummyA {
    /**
     * @var string
     */
    private $c;

    protected $type = 'c';

    /**
     * @return string
     */
    public function getC()
    {
        return $this->c;
    }

    /**
     * @param string $c
     * @return self
     */
    public function setC(string $c): self
    {
        $this->c = $c;
        return $this;
    }
}