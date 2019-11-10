<?php declare(strict_types=1);

namespace phptests;

use Traversable;

class Suite implements ISuite
{

    private $name;

    private $description;

    /**
     * @var string[]
     */
    private $testCases;

    public function __construct(string $name, string $description, array $testCases)
    {
        $this->name = $name;
        $this->description = $description;
        $this->testCases = $testCases;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTestCases(): array
    {
        return $this->testCases;
    }


}