<?php
declare(strict_types=1);

require __DIR__ . '/Employee.php';
require __DIR__ . '/Manager.php';
require __DIR__ . '/Developer.php';

$manager = new Manager('Тест', 70000, '9999 123456', 2);
$developer = new Developer('Тест2', 60000, '8888 654321', 'middle');

echo '1) Чтение $name снаружи: ' . $manager->name . PHP_EOL;

try {
    echo $manager->baseSalary;
} catch (Error $e) {
    echo '2) Чтение $baseSalary снаружи: ' . $e->getMessage() . PHP_EOL;
}

echo '3) Чтение $baseSalary в Manager (через getSalary): ' . $manager->getSalary() . PHP_EOL;

try {
    $manager->testPrivatePassport();
} catch (Error $e) {
    echo '4) Чтение $passport в Manager: ' . $e->getMessage() . PHP_EOL;
}

try {
    $manager->calculateTax(1000);
} catch (Error $e) {
    echo '5) Вызов calculateTax() снаружи: ' . $e->getMessage() . PHP_EOL;
}

try {
    $developer->testPrivateValidate();
} catch (Error $e) {
    echo '6) Вызов validatePercent() в Developer: ' . $e->getMessage() . PHP_EOL;
}