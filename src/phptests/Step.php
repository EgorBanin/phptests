<?php declare(strict_types=1);

namespace phptests;

class Step implements IStep
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

    public function run(ITestCaseResult $testCaseResult, $carry)
    {
        $result = new StepResult($this);
        try {
            $carry = ($this->impl)($result, $carry);
        } catch (AssertException $assertException) {
            $result = $assertException->getResult();
            $carry = null;
        } catch (\Throwable $error) {
            $result = StepResult::error($this, $error->getMessage());
            $carry = null;
        }

        $testCaseResult->addStepResult($result);

        return $carry;
    }

    public function jsonSerialize()
    {
        return [
            'action' => $this->action,
            'expectedResult' => $this->expectedResult,
        ];
    }

}