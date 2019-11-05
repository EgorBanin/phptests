<?php declare(strict_types=1);

namespace phptests;

// todo: di
$test = new Test(__FILE__, 'Демотест', '');
$test->step(
    'Создаём пустой результат',
    'Список ассертов пуст',
    function(IResult $result) {
        $testResult = new Result();
        $result->assert('В новом результате список ассертов пуст',
            empty($testResult->getAssertions())
        );

        return $testResult;
    }
)->step(
    'Добавляем ассерт',
    'Список ассертов содержит добавленый ассерт',
    function(IResult $result, IResult $testResult) {
        $testResult->assert('Пройденый ассерт', true);
        $result->assert('После вызовам метода assert, список ассертов содержит добавленый ассерт', (
            count($testResult->getAssertions()) === 1
            && $testResult->getAssertions()[0] instanceof IAssertion
            && $testResult->getAssertions()[0]->getDescription() === 'Пройденый ассерт'
            && $testResult->getAssertions()[0]->getStatus() === true
        ));
    }
);

return $test;