<?php declare(strict_types=1);

namespace phptests;

interface ITestCaseResult extends \JsonSerializable
{

    public function addStepResult(IStepResult $result);

    public function isOk(): bool;

}