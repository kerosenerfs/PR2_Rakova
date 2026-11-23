<?php
declare(strict_types=1);

require __DIR__ . '/Student.php';

$s1 = new Student(101, 'Ракова', 'Мария', 1);
$s1->email = 'maria@example.com';
$s1->grades = [4, 5, 4, 5];

$s2 = new Student(102, 'Горбатенко', 'Вова', 2);
$s2->email = 'vova@example.com';
$s2->grades = [5, 5, 5, 4];

$s3 = new Student(103, 'Кристофер', 'Света', 3);
$s3->grades = [3, 4, 3, 4];

$s4 = new Student(104, 'Мехренина', 'Дарья', 4);
$s4->email = 'dasha@example.com';
$s4->grades = [5, 4, 5, 5];

$students = [$s1, $s2, $s3, $s4];

echo 'Билет | ФИО | Курс | Почта | Средний балл' . PHP_EOL;
echo str_repeat('-', 70) . PHP_EOL;
foreach ($students as $s) {
    $avg = $s->getAverageGrade();
    $avgStr = $avg === null ? 'нет оценок' : number_format($avg, 2);
    echo "{$s->id} | {$s->getFullName()} | {$s->course} | " .
         ($s->email ?? 'не указана') . " | {$avgStr}" . PHP_EOL;
}

echo 'Всего студентов: ' . Student::$totalStudents . PHP_EOL;
