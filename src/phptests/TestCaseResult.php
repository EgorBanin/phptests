<?php declare(strict_types=1);

namespace phptests;

class TestCaseResult implements ITestCaseResult
{

    private $tc;

    /**
     * @var IStepResult[]
     */
    private $stepResults = [];

    public function __construct(ITestCase $tc)
    {
        $this->tc = $tc;
    }

    public function addStepResult(IStepResult $result)
    {
        $this->stepResults[] = $result;
    }

    public function isOk(): bool
    {
        $ok = true;
        foreach ($this->stepResults as $result) {
            if ( ! $result->isOk()) {
                $ok = false;
                break;
            }
        }

        return $ok;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}