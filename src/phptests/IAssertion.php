<?php declare(strict_types=1);

namespace phptests;

interface IAssertion extends \JsonSerializable {

    public const STATUS_OK = true;

    public const STATUS_FAIL = false;

    public function getDescription(): string;

    public function getStatus(): bool;

}