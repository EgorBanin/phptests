<?php declare(strict_types=1);

namespace phptests;

class Test implements ITest
{

    private $id;

    private $title;

    private $description;

    private $steps = [];

    public function __construct(string $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function step(string $action, string $expectedResult, callable $impl): ITest
    {
        return $this->addStep(new TestStep($action, $expectedResult, $impl));
    }

    public function addStep(ITestStep $step): ITest
    {
        $this->steps[] = $step;

        return $this;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    public function run(ITestRunner $runner): IResult
    {
        $result = new Result();
        foreach ($this->steps as $step) {
            $runner->runStep();
        }
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}