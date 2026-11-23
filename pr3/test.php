<?php
declare(strict_types=1);

require __DIR__ . '/Student.php';

$s1 = new Student(101, 'Иванов', 'Иван', 1);
$s2 = new Student(102, 'Петров', 'петр', 2);

try {
    $s1->id = 999;
} catch (Error $e) {
    echo '1) Изменение $id: ' . $e->getMessage() . PHP_EOL;
}

try {
    $s1->course = 'два';
} catch (TypeError $e) {
    echo '2) Строка в $course: ' . $e->getMessage() . PHP_EOL;
}

try {
    new Student(105, 'Тестов', 'Тест', 7);
} catch (InvalidArgumentException $e) {
    echo '3) Курс 7: ' . $e->getMessage() . PHP_EOL;
}

echo '4) До изменения: ' . $s2::$university . PHP_EOL;
Student::$university = 'СПбГУ';
echo '   После изменения: ' . $s2::$university . ' (у всех объектов)' . PHP_EOL;

echo '5) var_dump:' . PHP_EOL;
var_dump($s1);
echo '   get_object_vars:' . PHP_EOL;
print_r(get_object_vars($s1));

$s = new Student(101, 'Иванов', 'Иван', 1);
$s->nonexistent = 'значение';
$s->another = 123;

var_dump(get_object_vars($s));