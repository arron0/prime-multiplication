<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';


use PrimeMultiplication\MultiplicationTableGenerator;
use PrimeMultiplication\PrimeMultiplicationTableCommand;
use PrimeMultiplication\PrimeMultiplicationTableGenerator;
use PrimeMultiplication\PrimesNumberGenerator;
use Symfony\Component\Console\Application;

$application = new Application();

$primeNumbersGenerator = new PrimesNumberGenerator();
$multiplicationTableGenerator = new MultiplicationTableGenerator();

$primeMultiplicationTableGenerator = new PrimeMultiplicationTableGenerator($primeNumbersGenerator, $multiplicationTableGenerator);

$application->add(new PrimeMultiplicationTableCommand($primeMultiplicationTableGenerator));

$application->run();
