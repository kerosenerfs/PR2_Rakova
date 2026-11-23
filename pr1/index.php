<?php
declare(strict_types=1);

require __DIR__ . '/Book.php';
require __DIR__ . '/Library.php';

$b1 = new Book('Мастер и Маргарита', 'М. Булгаков', 1967, 480);
$b2 = new Book('Преступление и наказание', 'Ф. Достоевский', 1866, 671);
$b3 = new Book('Война и мир', 'Л. Толстой', 1869, 1274);
$b4 = new Book('Приют Грез', 'Э. М. Ремарк', 1920, 224);
$b5 = new Book('Мёртвые души', 'Н. Гоголь', 1842, 352);

$library = new Library();
$library->addBook($b1);
$library->addBook($b2);
$library->addBook($b3);
$library->addBook($b4);
$library->addBook($b5);

echo 'Все книги:' . PHP_EOL;
$library->printAll();

echo 'Количество книг: ' . $library->count() . PHP_EOL;

echo 'Поиск по автору М. Булгаков:' . PHP_EOL;
foreach ($library->findByAuthor('М. Булгаков') as $book) {
    echo $book->getInfo() . PHP_EOL;
}

echo 'Возраст книги ' . $b1->title . ': ' . $b1->getAge() . ' лет' . PHP_EOL;

$b1 = new Book('Мастер и Маргарита', 'М. Булгаков', 1967, 480);
$b2 = $b1;
$b3 = clone $b1;

$b1->title = 'Изменённое название';

echo 'b1: ' . $b1->getInfo() . PHP_EOL;
echo 'b2: ' . $b2->getInfo() . PHP_EOL;
echo 'b3: ' . $b3->getInfo() . PHP_EOL;

$oldest = $library->getOldest();
echo 'Самая старая книга: ' . $oldest->getInfo() . PHP_EOL;