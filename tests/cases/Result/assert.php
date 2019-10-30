<?php declare(strict_types=1);

namespace phptests;

return new TestCase(function(TestCase $tc) {

    $result = $tc->result();

    $testResult = new Result();
    $result->assert('В новом результате список ассертов пуст',
        empty($testResult->getAssertions())
    );

    $testResult->assert('Пройденый ассерт', true);
    $result->assert('После вызовам метода assert, список ассертов содержит добавленый ассерт', (
        count($testResult->getAssertions()) === 1
        && $testResult->getAssertions()[0] instanceof IAssertion
        && $testResult->getAssertions()[0]->getDescription() === 'Пройденый ассерт'
        && $testResult->getAssertions()[0]->getStatus() === true
    ));

    $testResult->softAssert('Проваленый софт-ассерт', false);
    $result->assert('После вызова метода softAssert, список ассертов содержит добавленый ассерт', (
        count($testResult->getAssertions()) === 2
        && $testResult->getAssertions()[1] instanceof IAssertion
        && $testResult->getAssertions()[1]->getDescription() === 'Проваленый софт-ассерт'
        && $testResult->getAssertions()[1]->getStatus() === false
    ));

    $expectedException = null;
    try {
        $testResult->assert('Проваленный ассерт', false);
    } catch (AssertException $e) {
        $expectedException = $e;
    }
    $result->assert('Проваленный ассерт вызывает исключение AssertException', (
        $expectedException instanceof AssertException
    ));
    $result->assert('Исключение AssertException содержит ссылку на результат', (
        $expectedException->getResult() === $testResult
    ));
    $result->assert('Проваленный ассерт присутствует в списке ассертов', (
        count($testResult->getAssertions()) === 3
        && $testResult->getAssertions()[2] instanceof IAssertion
        && $testResult->getAssertions()[2]->getDescription() === 'Проваленный ассерт'
        && $testResult->getAssertions()[2]->getStatus() === false
    ));

    return $result;

});