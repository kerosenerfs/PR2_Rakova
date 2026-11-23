<?php
declare(strict_types=1);

require __DIR__ . '/QueryBuilder.php';

echo "--- Основные запросы ---" . PHP_EOL;

echo QueryBuilder::table('users')
    ->select('id', 'name', 'email')
    ->where('age', '>=', 18)
    ->where('city', '=', 'Москва')
    ->orderBy('name')
    ->limit(10)
    . PHP_EOL;

echo QueryBuilder::table('products')
    ->where('price', '<', 1000)
    ->orderBy('price', 'DESC')
    . PHP_EOL;

echo QueryBuilder::table('orders')
    ->select('id', 'total')
    ->where('status', 'LIKE', 'paid')
    ->limit(5)
    . PHP_EOL;


echo PHP_EOL . "--- Перехват исключений ---" . PHP_EOL;

try {
    QueryBuilder::table('users')->orderBy('name', 'UP');
} catch (InvalidArgumentException $e) {
    echo '1) ' . $e->getMessage() . PHP_EOL;
}

try {
    QueryBuilder::table('users')->limit(0);
} catch (InvalidArgumentException $e) {
    echo '2) ' . $e->getMessage() . PHP_EOL;
}

try {
    QueryBuilder::table('users')->where('age', '==', 18);
} catch (InvalidArgumentException $e) {
    echo '3) ' . $e->getMessage() . PHP_EOL;
}


echo PHP_EOL . "--- Дополнительно: магический метод __call ---" . PHP_EOL;

echo QueryBuilder::table('users')
    ->whereCity('Москва')
    ->whereAge(25)
    . PHP_EOL;