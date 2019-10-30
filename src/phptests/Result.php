<?php declare(strict_types=1);

namespace phptests;

class Result implements IResult
{
    private $assertions = [];

    private $errors = [];

    public static function error(string $message)
    {
        $result = new self();
        $result->errors[] = $message;

        return $result;
    }

    public function assert(string $description, bool $status): IResult
    {
        $this->assertions[] = new Assertion($description, $status);

        if ( ! $status) {
            throw new AssertException($this, $description);
        }

        return $this;
    }

    public function softAssert(string $description, bool $status): IResult
    {
        $this->assertions[] = new Assertion($description, $status);

        return $this;
    }

    public function __toString(): string
    {
        return json_encode($this->assertions, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function getAssertions(): array
    {
        return $this->assertions;
    }

    public function isOk(): bool
    {
        $ok = true;
        /** @var IAssertion $assertion */
        foreach ($this->assertions as $assertion) {
            if ($assertion->getStatus() === IAssertion::STATUS_FAIL) {
                $ok = false;
                break;
            }
        }

        return $ok;
    }


}