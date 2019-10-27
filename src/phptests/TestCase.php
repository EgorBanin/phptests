<?php declare(strict_types=1);

namespace phptests;

class TestCase implements ITestCase
{

    private $impl;

    public function __construct(callable $impl)
    {
        $this->impl = $impl;
    }

    public function result(): IResult
    {
        return new Result();
    }

    public function run(): IResult
    {
        return ($this->impl)($this);
    }


}