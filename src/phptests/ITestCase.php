<?php declare(strict_types=1);

namespace phptests;

interface ITestCase extends \JsonSerializable
{

    public function addStep(IStep $step): ITestCase;

    public function getSteps(): array;

    public function run(): ITestCaseResult;

}