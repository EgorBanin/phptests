<?php declare(strict_types=1);

namespace phptests;

interface ITestRunner
{

    public function runTestCase(ITestCase $tc): IResult;

    public function getResult(): ResultCollection;

}