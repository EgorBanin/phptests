<?php declare(strict_types=1);

namespace phptests;

interface ITestManager
{

    public function getSuite(string $suiteName): ISuite;

    public function getTestCase(string $testCaseName): ITestCase;

}