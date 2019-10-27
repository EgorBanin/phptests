<?php declare(strict_types=1);

namespace phptests;

use Traversable;

class TestGroup implements ITestGroup
{

    private $name;

    private $description;

    private $cases;

    public function __construct($name, $description, array $cases)
    {
        $this->name = $name;
        $this->description = $description;
        $this->cases = $cases;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->cases);
    }


}