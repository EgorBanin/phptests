<?php declare(strict_types=1);

namespace phptests;

return new TestCase(function(TestCase $tc) {

    return $tc->result()->assert('foo bar', true);

});