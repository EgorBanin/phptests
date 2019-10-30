<?php declare(strict_types=1);

namespace phptests;

interface ITestManager
{

    public function runGroup($groupName, ITestRunner $runner): array;

    public function getTestGroup($groupName): ITestGroup;

    public function getTestCase($caseName): ITestCase;

}