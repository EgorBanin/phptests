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

    public function runGroup($groupName, ITestRunner $runner): ResultCollection
    {
        $group = $this->getTestGroup($groupName);
        foreach ($group as $caseName) {
            $case = $this->getTestCase($caseName);
            $runner->runTestCase($case);
        }

        return $runner->getResult();
    }

    public function getTestGroup($groupName): ITestGroup
    {
        try {
            $result = $this->load($this->groupsDir, $groupName . '.php');
        } catch (\Exception $e) {
            throw new \Exception('Не найдена группа ' . $groupName, 0, $e);
        }

        if ( ! ($result instanceof ITestGroup)) {
            throw new \Exception('Не является ' . ITestGroup::class);
        }

        return $result;
    }

    public function getTestCase($caseName): ITestCase
    {
        try {
            $result = $this->load($this->casesDir, $caseName . '.php');
        } catch (\Exception $e) {
            throw new \Exception('Не найден кейс ' . $caseName, 0, $e);
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