<?php declare(strict_types=1);

namespace phptests;

class StepResult implements IStepResult
{

    private $step;

    /**
     * @var IAssertion[]
     */
    private $assertions = [];

    private $errors = [];

    public function __construct(IStep $step)
    {
        $this->step = $step;
    }

    public static function error(IStep $step, string $message)
    {
        $result = new self($step);
        $result->errors[] = $message;

        return $result;
    }

    public function assert(string $description, bool $status): IStepResult
    {
        $this->assertions[] = new Assertion($description, $status);

        if ( ! $status) {
            throw new AssertException($this, $description);
        }

        return $this;
    }

    public function softAssert(string $description, bool $status): IStepResult
    {
        $this->assertions[] = new Assertion($description, $status);

        return $this;
    }

    public function getAssertions(): array
    {
        return $this->assertions;
    }

    public function isOk(): bool
    {
        $ok = true;
        foreach ($this->assertions as $assertion) {
            if ($assertion->getStatus() === IAssertion::STATUS_FAIL) {
                $ok = false;
                break;
            }
        }

        return $ok;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}