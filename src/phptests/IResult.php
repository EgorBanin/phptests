<?php declare(strict_types=1);

namespace phptests;

interface IResult {

    public function assert(string $description, bool $value);

    public function __toString(): string;

}