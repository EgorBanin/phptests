<?php declare(strict_types=1);

namespace phptests;

return new TestCase(function(TestCase $tc) {

   $result = $tc->result();

   $testCollection = new ResultCollection();

   return $result;

});