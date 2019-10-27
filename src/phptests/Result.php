<?php declare(strict_types=1);

namespace phptests;

class Result implements IResult
{
    private $assertions = [];

    public static function error(string $message)
    {
        $result = new self();
        $result->assertions[] = $message;

        return $result;
    }

    public function assert(string $description, bool $value)
    {
        $this->assertions[] = $description;

        if ( ! $value) {
            throw new AssertException();
        }

        return $this;
    }

    public function __toString(): string
    {
        return json_encode($this->assertions);
    }

}