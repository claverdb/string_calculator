<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function should_respond_zero_of_empty_string()
    {
        $string_calculator = new StringCalculator();

        $result = $string_calculator->add("");

        $this->assertEquals("0", $result);
    }
}
