<?php declare(strict_types=1);

namespace phptests;

require __DIR__ . '/../vendor/autoload.php';

//$groups = $argv;
//array_shift($groups);

$testManager = new TestManager(__DIR__ . '/../tests/suites', __DIR__ . '/../tests/cases');
$suite = $testManager->getSuite('all');
$results = [];
foreach ($suite->getTestCases() as $testCaseId) {
    $testCase = $testManager->getTestCase($testCaseId);
    $results[] = $testCase->run();
}

/** @var ITestCaseResult $result */
foreach ($results as $result) {
    fprintf(STDOUT, '%s', $result->isOk()? '.' : 'F');
}
echo "\n";

//$results = $testManager->runSuite('all', new TestRunner());
//$printer = new ResultPrinter(STDOUT);
//array_walk($results, function (ITestCaseResult $result) use($printer) {
//    $printer->print($result);
//});
//echo "\n";