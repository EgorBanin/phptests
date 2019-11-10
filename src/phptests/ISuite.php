<?php declare(strict_types=1);

namespace phptests;

interface ISuite
{

    public function getName(): string;

    public function getDescription(): string;

    /**
     * @return string[]
     */
    public function getTestCases(): array;

}