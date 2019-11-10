<?php declare(strict_types=1);

namespace phptests;

class TestCase implements ITestCase
{

    private $id;

    private $title;

    private $description;

    /**
     * @var IStep[]
     */
    private $steps = [];

    public function __construct(string $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function step(string $action, string $expectedResult, callable $impl): ITestCase
    {
        return $this->addStep(new Step($action, $expectedResult, $impl));
    }

    public function addStep(IStep $step): ITestCase
    {
        $this->steps[] = $step;

        return $this;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    public function run(): ITestCaseResult
    {
        $testResult = new TestCaseResult($this);
        $carry = null;
        foreach ($this->steps as $step) {
            $carry = $step->run($testResult, $carry);
        }

        return $testResult;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}