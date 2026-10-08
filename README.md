# Salary Payment Calculator

A PHP 8 application that generates a 12-month payroll payment schedule and exports the results to a CSV file.

The application calculates salary and bonus payment dates according to the following rules:

  1. **Base salary:** Paid on the last working day (Monday - Friday) of the month. If the last falls on a weekend, Saturday or Sunday, the date is moved to the previous Friday.

  2. **Bonus:** Paid on the 10th of each month for the previous month's work. If the 10th falls on a weekend, the date is moved to the first Tuesday after the 10th.

The application uses object-oriented programming, separates responsibilities into dedicated classes, and includes automatic unit tests using PHPUnit.

## Requirements

    - PHP 8.3 or newer
    - Composer

## Installation

 1. **Clone the repository:**
```bash
git clone https://github.com/purmel/salary-payment-calc.git
```
 2. **Navigate to the project directory:**
```bash
cd salary-payment-calc
```
 3. **Install the dependencies:**
```bash
composer install
```

## Usage
Run the application from the project root

```bash
php generate-final.php
```
The application generates a CSV file containing the payment dates for the next 12 months.

The file is saved at: **output/payment-schedule.csv**

The CSV contains 3 collumns:
  1. month - the month in which the payments are made.
  2. salary date - the base salary payment date.
  3. bonus date - the date on which the previous month's bonus is paid.

The dates are formatted as YYYY-MM-DD.

**Note:** Each row represents a payment month. The bonus payment date shown for that month corresponds to the bonus earned during the previous month.

## Testing

The project uses PHPUnit for automated unit testing.

To run the tests, execute the following command from the project root:

```bash
vendor/bin/phpunit tests
```

The tests verify:
- Salary payment dates, including weekend adjustments.
- Bonus payment dates, including weekend adjustments.
- Payroll schedule generation for 12 consecutive months.

## Project Structure

- `src/SalaryPaymentDateCalculator.php` - Calculates base salary payment dates.
- `src/BonusPaymentDateCalculator.php` - Calculates bonus payment dates.
- `src/PayrollScheduleGenerator.php` - Generates the 12-month payment schedule.
- `src/CsvExporter.php` - Exports the schedule to a CSV file.
- `tests/` - Contains the PHPUnit tests.
- `generate-final.php` - Application entry point.
- `output/` - Directory containing the generated CSV file.