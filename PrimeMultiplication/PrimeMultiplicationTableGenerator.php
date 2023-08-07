<?php

declare(strict_types=1);

namespace PrimeMultiplication;

use RuntimeException;

class PrimeMultiplicationTableGenerator
{
	public function __construct(
		private PrimesNumberGenerator $primeNumberGenerator,
		private MultiplicationTableGenerator $multiplicationTableGenerator,
	) {
	}

	public function generate(int $size): MultiplicationTable
	{
		if ($size < 1) {
			throw new RuntimeException("Can't generate table smaller than 1");
		}
		$primeNumbers = $this->primeNumberGenerator->generate($size);
		return $this->multiplicationTableGenerator->generate($primeNumbers);
	}
}
