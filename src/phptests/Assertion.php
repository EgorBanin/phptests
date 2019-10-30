<?php declare(strict_types=1);

namespace phptests;

class Assertion implements IAssertion
{

    private $description;

    private $status;

    public function __construct(string $description, bool $status)
    {
        $this->description = $description;
        $this->status = $status;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


}