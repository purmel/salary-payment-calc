<?php
    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;
    use User\SalaryPaymentCalc\BonusPaymentDateCalculator;

    final class BonusPaymentDateCalculatorTest extends TestCase
    {
        public function testReturnsFollowingTuesdayWhenTenthIsSaturday() : void
        {
            $calculator = new BonusPaymentDateCalculator();

            $result = $calculator->calculate(2026, 1);

            self::assertSame(
                '2026-01-13',
                $result->format('Y-m-d')
            );
        }

        public function testReturnsFollowingTuesdayWhenTenthIsSunday() : void
        {
            $calculator = new BonusPaymentDateCalculator();

            $result = $calculator->calculate(2026, 5);

            self::assertSame(
                '2026-05-12',
                $result->format('Y-m-d')
            );
        }

        public function testReturnsTenthWhenIsWeekday() : void
        {
            $calculator = new BonusPaymentDateCalculator();

            $result = $calculator->calculate(2026, 2);

            self::assertSame(
                '2026-02-10',
                $result->format('Y-m-d')
            );
        }
    }