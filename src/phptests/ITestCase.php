<?php declare(strict_types=1);

namespace phptests;

interface ITestCase
{

    public function run(): IResult;

}