<?php declare(strict_types=1);

namespace phptests;

return new Suite(
    basename(__FILE__),
    'Все тесты',
    [
        'Result/assert',
    ]
);