<?php
    declare(strict_types = 1);

    require __DIR__ . '/vendor/autoload.php';

    use User\SalaryPaymentCalc\SalaryPaymentDateCalculator;
    use User\SalaryPaymentCalc\BonusPaymentDateCalculator;
    use User\SalaryPaymentCalc\PayrollScheduleGenerator;
    use User\SalaryPaymentCalc\CsvExporter;

    $generator = new PayrollScheduleGenerator(
        new SalaryPaymentDateCalculator(),
        new BonusPaymentDateCalculator()
    );

    $schedule = $generator->generate(new DateTimeImmutable('now'));

    $outputDirectory = __DIR__ . '/output';

    if (!is_dir($outputDirectory))
    {
        mkdir($outputDirectory, 0777, true);
    }

    $filePath = $outputDirectory . '/payment-schedule.csv';

    $exporter = new CsvExporter();

    $exporter->export($schedule, $filePath);

    echo "Payment schedule generated successfully." . PHP_EOL;
    echo "File: " . $filePath . PHP_EOL;