<?php declare(strict_types=1);

namespace phptests;

return (new TestCase(__DIR__, 'Тест ассертов', ''))
    ->addStep(new Step(
        'Создаём пустой Result',
        'списк ассертов пуст',
        function(IStepResult $result) {
            $testResult = new StepResult(new Step('', '', function() {}));
            $result->assert(
                'В новом результате список ассертов пуст',
                empty($testResult->getAssertions())
            );

            return $testResult;
        }
    ))
    ->addStep(new Step(
        'Вызываем метод assert с аргуметом status = true',
        'Список ассертов содержит добавленный ассерт',
        function(IStepResult $result, IStepResult $testResult) {
            $testResult->assert('Пройденый ассерт', true);
            $result->assert(
                'Список ассертов содержит добавленый ассерт',
                count($testResult->getAssertions()) === 1
                && $testResult->getAssertions()[0] instanceof IAssertion
                && $testResult->getAssertions()[0]->getDescription() === 'Пройденый ассерт'
                && $testResult->getAssertions()[0]->getStatus() === true
            );

            return $testResult;
        }
    ))
    ->addStep(new Step(
        'Вызываем метод softAssert с аргуметом status = false',
        'Список ассертов содержит добавленный ассерт',
        function(IStepResult $result, IStepResult $testResult) {
            $testResult->softAssert('Проваленый софт-ассерт', false);
            $result->assert(
                'Список ассертов содержит добавленый ассерт',
                count($testResult->getAssertions()) === 2
                && $testResult->getAssertions()[1] instanceof IAssertion
                && $testResult->getAssertions()[1]->getDescription() === 'Проваленый софт-ассерт'
                && $testResult->getAssertions()[1]->getStatus() === false
            );

            return $testResult;
        }
    ))
    ->addStep(new Step(
        'Вызываем метод assert с аргуметом status = false',
        'Проваленный ассерт вызывает исключение AssertException',
        function(IStepResult $result, IStepResult $testResult) {
            $actualException = null;
            try {
                $testResult->assert('Проваленный ассерт', false);
            } catch (\Throwable $actualException) {
                //
            }
            $result->assert(
                'Проваленный ассерт вызывает исключение AssertException',
                $actualException instanceof AssertException
            );
            $result->assert(
                'Исключение AssertException содержит ссылку на результат',
                $actualException->getResult() === $testResult
            );
            $result->assert('Проваленный ассерт присутствует в списке ассертов', (
                count($testResult->getAssertions()) === 3
                && $testResult->getAssertions()[2] instanceof IAssertion
                && $testResult->getAssertions()[2]->getDescription() === 'Проваленный ассерт'
                && $testResult->getAssertions()[2]->getStatus() === false
            ));
        }
    ))
;