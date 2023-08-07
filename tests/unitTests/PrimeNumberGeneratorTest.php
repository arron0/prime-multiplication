<?php

declare(strict_types=1);

namespace unitTests;

use PHPUnit\Framework\TestCase;
use PrimeMultiplication\PrimesNumberGenerator;

class PrimeNumberGeneratorTest extends TestCase
{
	private PrimesNumberGenerator $primesGenerator;

	public function setUp(): void
	{
		$this->primesGenerator = new PrimesNumberGenerator();
		parent::setUp();
	}

	public function testGenerate(): void
	{
		$primeNumbers = $this->primesGenerator->generate(10);
		$this->assertEquals([2, 3, 5, 7, 11, 13, 17, 19, 23, 29], $primeNumbers);
	}

	public function testGenerateFromCache(): void
	{
		$primeNumbers = $this->primesGenerator->generate(2);
		$this->assertEquals([2, 3,], $primeNumbers);
	}

	/**
	 * @dataProvider generateNothingDataProvider
	 */
	public function testGenerateNothing(int $count): void
	{
		$primeNumbers = $this->primesGenerator->generate($count);
		$this->assertEquals([], $primeNumbers);
		$this->assertEmpty($primeNumbers);
	}

	public static function generateNothingDataProvider(): array
	{
		return [
			[0],
			[-1],
		];
	}
}
