<?php declare(strict_types=1);

namespace phptests;

interface IStep extends \JsonSerializable
{

    public function getAction(): string;

    public function getExpectedResult(): string;

    public function run(ITestCaseResult $testCaseResult, $carry);

}