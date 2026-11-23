<?php
declare(strict_types=1);

class Developer extends Employee
{
    private string $level;

    public function __construct(string $name, float $baseSalary, string $passport, string $level)
    {
        parent::__construct($name, $baseSalary, $passport);
        $this->level = $level;
    }

    private function getCoefficient(): float
    {
        return match ($this->level) {
            'junior' => 1.0,
            'middle' => 1.5,
            'senior' => 2.0,
            default => throw new InvalidArgumentException("Неизвестный уровень: {$this->level}"),
        };
    }

    public function getSalary(): float
    {
        return $this->baseSalary * $this->getCoefficient();
    }

}