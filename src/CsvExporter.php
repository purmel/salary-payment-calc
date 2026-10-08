<?php

    declare(strict_types = 1);

    namespace User\SalaryPaymentCalc;

    use RuntimeException;

    final class CsvExporter
    {
        public function export(array $schedule, string $filePath) : void
        {
            $file = fopen($filePath, 'w');

            if($file === false)
            {
                throw new RuntimeException(
                    sprintf('Could not open file %s for running', $filePath)
                );
           }
            
            fputcsv(
                $file,
                ['month' , 'salary_date', 'bonus_date'],
                ',',
                '"',
                ''
            );

            foreach ($schedule as $row)
            {
                fputcsv(
                    $file,
                    [
                        $row['month'], 
                        $row['salary_date'], 
                        $row['bonus_date'],
                    ],
                    ',',
                    '"',
                    ''
                );
            }

            fclose($file);
        }
    }
?>