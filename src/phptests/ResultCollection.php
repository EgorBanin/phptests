<?php declare(strict_types=1);

namespace phptests;

class ResultCollection
{

    private $results = [];

    public function addResult(IResult $result): void
    {
        $this->results[] = $result;
    }

    public function __toString(): string
    {
        $str = '';
        foreach ($this->results as $result) {
            $str .= $result . "\n";
        }

        return $str;
    }

}