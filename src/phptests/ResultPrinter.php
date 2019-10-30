<?php declare(strict_types=1);

namespace phptests;

class ResultPrinter implements IResultPrinter
{

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function print(IResult $result)
    {
        fprintf($this->file, '%s', $result->isOk()? '.' : 'F');
    }


}