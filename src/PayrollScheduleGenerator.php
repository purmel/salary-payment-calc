<?php
    declare(strict_types = 1);

    namespace User\SalaryPaymentCalc;

    use DateTimeImmutable;

    final class PayrollScheduleGenerator
    {
        public function __construct(
            private SalaryPaymentDateCalculator $salaryCalculator,
            private BonusPaymentDateCalculator $bonusCalculator
        ){
        }

        public function generateMonth(DateTimeImmutable $month) : array
        {
            $year = (int) $month->format('Y');
            $monthNum = (int) $month->format('m');
            
            $salaryDate = $this->salaryCalculator->calculate($year, $monthNum);
            $bonusDate = $this->bonusCalculator->calculate($year, $monthNum);

            return
            [
                'month' => $month->format('F Y'),
                'salary_date' => $salaryDate->format('Y-m-d'),
                'bonus_date' => $bonusDate->format('Y-m-d'),
            ];
        }

        public function generate(DateTimeImmutable $startDate) : array
        {
            $schedule = [];

            $currentMonth = $startDate->modify('first day of this month');

            for($i = 0; $i < 12; $i++)
            {
                $schedule[] = $this->generateMonth($currentMonth);

                $currentMonth = $currentMonth->modify('+1 month');
            }
            
            return $schedule;
        }
    }
?>