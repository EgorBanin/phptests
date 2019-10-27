<?php declare(strict_types=1);

namespace phptests;

class TestRunner implements ITestRunner
{

    private $results;

    public function __construct()
    {
        $this->results = new ResultCollection();
    }

    public function runTestCase(ITestCase $tc): IResult
    {
        try {
            $result = $tc->run();
        } catch (\Throwable $e) {
            $result = Result::error($e->getMessage());
        }

        $this->results->addResult($result);

        return $result;
    }

    public function getResult(): ResultCollection
    {
        return $this->results;
    }


}