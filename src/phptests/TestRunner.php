<?php declare(strict_types=1);

namespace phptests;

class TestRunner implements ITestRunner
{

    private $results = [];

    public function runTestCase(ITestCase $tc): IResult
    {
        try {
            $result = $tc->run();
        } catch (AssertException $e) {
            $result = $e->getResult();
        } catch (\Throwable $e) {
            $result = Result::error($e->getMessage());
        }

        $this->results[] = $result;

        return $result;
    }

    public function getResults(): array
    {
        return $this->results;
    }


}