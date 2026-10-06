<?php
    declare(strict_types = 1);

    namespace User\SalaryPaymentCalc;

    use DateTimeImmutable;

    final class SalaryPaymentDateCalculator
    {
        public function calculate(int $year, int $month) : DateTimeImmutable
        {
            $lastDayOfMonth = new DateTimeImmutable(
                sprintf('%04d-%02d-01', $year, $month)
            );

            $lastDayOfMonth = $lastDayOfMonth->modify('last day of this month');

            $dayOfWeek = (int) $lastDayOfMonth->format('N');

            if($dayOfWeek == 6){
                return $lastDayOfMonth->modify('-1 day');
            }

            if($dayOfWeek == 7){
                return $lastDayOfMonth->modify('-2 days');
            }
                
            return $lastDayOfMonth;

        }
    }
?>