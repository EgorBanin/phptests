<?php declare(strict_types=1);

namespace phptests;

interface ITestCase
{

    /**
     * @throws AssertException
     * @return IResult
     */
    public function run(): IResult;

}