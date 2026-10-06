<?php
    declare (strict_types = 1);

    use PHPUnit\Framework\TestCase;
    use User\SalaryPaymentCalc\SalaryPaymentDateCalculator;

    final class SalaryPaymentDateCalculatorTest extends TestCase
    {
        public function testReturnsPreviousFridayWhenMonthEndsSaturday() : void
        {
            $calculator = new SalaryPaymentDateCalculator();

            $result = $calculator->calculate(2026, 10);

            self::assertSame(
                '2026-10-30',
                $result->format('Y-m-d')
            );
        }

        public function testReturnsPreviousFridayWhenMonthEndsSunday() : void
        {
            $calculator = new SalaryPaymentDateCalculator();

            $result = $calculator->calculate(2026, 5);

            self::assertSame(
                '2026-05-29',
                $result->format('Y-m-d')
            );
        }

        public function testReturnsLastDayWhenMonthEndsWeekday() : void
        {
            $calculator = new SalaryPaymentDateCalculator();

            $result = $calculator->calculate(2026,9);

            self::assertSame(
                '2026-09-30',
                $result->format('Y-m-d')
            );
        }
    }
