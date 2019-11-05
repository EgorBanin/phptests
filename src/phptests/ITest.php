<?php declare(strict_types=1);

namespace phptests;

interface ITest extends \JsonSerializable
{

    public function addStep(ITestStep $step): ITest;

    public function getSteps(): array;

    public function run(ITestRunner $runner): IResult;

}