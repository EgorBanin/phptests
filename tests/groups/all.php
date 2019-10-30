<?php declare(strict_types=1);

namespace phptests;

return new TestGroup(
    basename(__FILE__),
    'Все тесты',
    [
        'Result/assert',
        'ResultCollection/addResult',
    ]
);