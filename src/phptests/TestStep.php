<?php declare(strict_types=1);

namespace phptests;

class TestStep implements ITestStep
{

    private $action;

    private $expectedResult;

    private $impl;

    public function __construct(string $action, string $expectedResult, callable $impl)
    {
        $this->action = $action;
        $this->expectedResult = $expectedResult;
        $this->impl = $impl;
    }


    public function getAction(): string
    {
        return $this->action;
    }

    public function getExpectedResult(): string
    {
        return $this->expectedResult;
    }

    public function run(): IResult
    {
        // TODO: Implement run() method.
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }


}