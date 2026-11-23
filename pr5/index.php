<?php
declare(strict_types=1);

require __DIR__ . '/Employee.php';
require __DIR__ . '/Manager.php';
require __DIR__ . '/Developer.php';

$employees = [
    new Employee('Ракова Мария', 50000, '1234 567890'),
    new Manager('Кристофер Света', 70000, '2345 678901', 3),
    new Developer('Горбатенко Вова', 60000, '3456 789012', 'senior'),
    new Developer('Мехренина Даша', 45000, '4567 890123', 'junior'),
];

echo 'Сотрудники:' . PHP_EOL;

foreach ($employees as $e) {
    $salary = $e->getSalary();
    $tax = $salary * 0.13;
    $className = get_class($e); 
    
    echo "{$e->name} ({$className}): зарплата до налога = " . number_format($salary, 2) . 
         ", после налога = " . number_format($salary - $tax, 2) . PHP_EOL;
}

echo PHP_EOL . 'Маскировка паспорта: ' . $employees[1]->getMaskedPassport() . PHP_EOL;