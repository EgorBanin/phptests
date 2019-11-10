<?php declare(strict_types=1);

namespace phptests;

interface IStepResult extends \JsonSerializable
{

    public function assert(string $description, bool $status): IStepResult;

    public function softAssert(string $description, bool $value): IStepResult;

    public function getAssertions(): array;

    public function isOk(): bool;

}