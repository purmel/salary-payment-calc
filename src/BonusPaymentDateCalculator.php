<?php
    declare(strict_types = 1);

    namespace User\SalaryPaymentCalc;

    use DateTimeImmutable;

    final class BonusPaymentDateCalculator
    {
        public function calculate(int $year, int $month) : DateTimeImmutable
        {
            $bonusDate = new DateTimeImmutable(
                sprintf("%04d-%02d-10", $year, $month)
            );

            $dayOfWeek = (int) $bonusDate->format('N');

            if($dayOfWeek === 6)
                {
                    return $bonusDate->modify('+3 days');
                }
            if($dayOfWeek === 7)
                {
                    return $bonusDate->modify('+2 days');
                }

            return $bonusDate;
        }
    }

?>