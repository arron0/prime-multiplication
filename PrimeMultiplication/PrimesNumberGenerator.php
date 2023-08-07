<?php

declare(strict_types=1);

namespace PrimeMultiplication;

class PrimesNumberGenerator
{
	private static array $PrimesCache = [
		2, 3,
	];

	private function isPrime(int $number): bool
	{
		if ($number <= 1) {
			return false;
		}
		if ($number == 2) {
			return true;
		}
		if ($number % 2 == 0) {
			return false;
		}
		for ($i = 3; $i <= ceil(sqrt($number)); $i += 2) {
			if ($number % $i == 0) {
				return false;
			}
		}
		return true;
	}

	public function generate(int $count): array
	{
		if ($count <= 0) {
			return [];
		}

		if ($count <= count(self::$PrimesCache)) {
			return array_slice(self::$PrimesCache, 0, $count);
		}

		$primes = self::$PrimesCache;
		for ($i = end(self::$PrimesCache) + 2; count($primes) < $count; $i += 2) {
			if ($this->isPrime($i)) {
				$primes[] = $i;
			}
		}
		return $primes;
	}
}
