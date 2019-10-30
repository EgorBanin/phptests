<?php declare(strict_types=1);

namespace phptests;

use Throwable;

class AssertException extends \Exception
{

    private $result;

    public function __construct(IResult $result, $message = '', $code = 0, Throwable $previous = null)
    {
        $this->result = $result;
        parent::__construct($message, $code, $previous);
    }

    public function getResult(): IResult
    {
        return $this->result;
    }

}