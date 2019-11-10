<?php declare(strict_types=1);

namespace phptests;

interface IResultPrinter
{

    public function print(ITestCaseResult $result);

}