<?php

namespace App\Entity;


class DummyD extends AbstractDummyA {
    /**
     * @var string
     */
    private $d;

    /**
     * @var DummyC
     */
    private $dummyC;

    protected $type = 'd';

    /**
     * @return string
     */
    public function getD()
    {
        return $this->d;
    }

    /**
     * @param string $d
     * @return self
     */
    public function setD(string $d): self
    {
        $this->d = $d;
        return $this;
    }

    /**
     * @return DummyC
     */
    public function getDummyC(): DummyC
    {
        return $this->dummyC;
    }

    /**
     * @param DummyC $dummyC
     */
    public function setDummyC(DummyC $dummyC): void
    {
        $this->dummyC = $dummyC;
    }
}