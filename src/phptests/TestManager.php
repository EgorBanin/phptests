<?php declare(strict_types=1);

namespace phptests;

class TestManager implements ITestManager
{

    private $groupsDir;

    private $casesDir;

    public function __construct(string $groupsDir, string $casesDir)
    {
        $this->groupsDir = realpath($groupsDir);
        $this->casesDir = realpath($casesDir);
    }

    public function getSuite($suiteName): ISuite
    {
        try {
            $result = $this->load($this->groupsDir, $suiteName . '.php');
        } catch (\Exception $e) {
            throw new \Exception('Не найдена группа ' . $suiteName, 0, $e);
        }

        if ( ! ($result instanceof ISuite)) {
            throw new \Exception('Не является ' . ISuite::class);
        }

        return $result;
    }

    public function getTestCase(string $testCaseName): ITestCase
    {
        try {
            $result = $this->load($this->casesDir, $testCaseName . '.php');
        } catch (\Exception $e) {
            throw new \Exception('Не найден кейс ' . $testCaseName, 0, $e);
        }

        if ( ! ($result instanceof ITestCase)) {
            throw new \Exception('Не является ' . ITestCase::class);
        }

        return $result;
    }

    private function load($baseDir, string $path)
    {
        $fullPath = realpath($baseDir . '/' . $path);

        if (!$fullPath) {
            throw new \Exception('Не найден скрипт ' . $path);
        }

        $isSafe = (strpos($fullPath, $baseDir) === 0);
        if (!$isSafe) {
            throw new \Exception(
                'Скрипт "' . $path
                . '" за пределами директории "' . $baseDir . '"'
            );
        }

        if (!is_file($fullPath) || !is_readable($fullPath)) {
            throw new \Exception(
                'Скрипт "' . $fullPath . '" не является файлом доступным для чтения'
            );
        }

        $result = require $fullPath;

        return $result;
    }

}