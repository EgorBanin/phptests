<?php declare(strict_types=1);

namespace phptests;

interface IResult
{

    public function assert(string $description, bool $status): IResult;

    public function softAssert(string $description, bool $value): IResult;

    public function getAssertions(): array;

    public function isOk(): bool;

    public function __toString(): string;

}