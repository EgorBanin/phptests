<?php declare(strict_types=1);

namespace phptests;

interface ITestStep extends \JsonSerializable
{

    public function getAction(): string;

    public function getExpectedResult(): string;

    public function run(): IResult;

}