<?php declare(strict_types=1);

namespace phptests;

require __DIR__ . '/../vendor/autoload.php';

//$groups = $argv;
//array_shift($groups);

$testManager = new TestManager(__DIR__ . '/../tests/groups', __DIR__ . '/../tests/cases');
$results = $testManager->runGroup('all', new TestRunner());
$printer = new ResultPrinter(STDOUT);
array_walk($results, function (IResult $result) use($printer) {
    $printer->print($result);
});
echo "\n";