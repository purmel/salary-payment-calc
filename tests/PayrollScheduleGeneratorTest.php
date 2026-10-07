<?php
    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;
    use User\SalaryPaymentCalc\SalaryPaymentDateCalculator;
    use User\SalaryPaymentCalc\BonusPaymentDateCalculator;
    use User\SalaryPaymentCalc\PayrollScheduleGenerator;

    final class PayrollScheduleGeneratorTest extends TestCase
    {
        public function testGeneratesScheduleForAMonth() : void
        {
            $generator = new PayrollScheduleGenerator(
                new SalaryPaymentDateCalculator(),
                new BonusPaymentDateCalculator()
            );

            $result = $generator->generateMonth(new DateTimeImmutable('2026-10-01'));

            self::assertSame(
                [
                    'month' => 'October 2026',
                    'salary_date' => '2026-10-30',
                    'bonus_date' => '2026-10-13',
                ],
                $result
            );
        }
        
        public function testGeneratesTwelveMonths() : void
        {
            $generator = new PayrollScheduleGenerator(
                new SalaryPaymentDateCalculator(),
                new BonusPaymentDateCalculator()
            );

            $result = $generator->generate(new DateTimeImmutable('2026-10-06'));

            self::assertCount(12, $result);

            self::assertSame('October 2026', $result[0]['month']);
            self::assertSame('September 2027', $result[11]['month']);
        }
    }