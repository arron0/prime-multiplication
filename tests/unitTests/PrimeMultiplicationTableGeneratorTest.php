<?php

declare(strict_types=1);

namespace unitTests;

use PHPUnit\Framework\TestCase;
use PrimeMultiplication\MultiplicationTable;
use PrimeMultiplication\MultiplicationTableGenerator;
use PrimeMultiplication\PrimeMultiplicationTableGenerator;
use PrimeMultiplication\PrimesNumberGenerator;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use RuntimeException;

class PrimeMultiplicationTableGeneratorTest extends TestCase
{
	use ProphecyTrait;

	private PrimeMultiplicationTableGenerator $generator;
	private ObjectProphecy $primesNumberGenerator;
	private ObjectProphecy $multiplicationTableGenerator;

	public function setUp(): void
	{
		$this->primesNumberGenerator = $this->prophesize(PrimesNumberGenerator::class);
		$this->multiplicationTableGenerator = $this->prophesize(MultiplicationTableGenerator::class);

		$this->generator = new PrimeMultiplicationTableGenerator(
			$this->primesNumberGenerator->reveal(),
			$this->multiplicationTableGenerator->reveal(),
		);
		parent::setUp();
	}

	public function testGenerate(): void
	{
		$count = 10;
		$primesGenerated = [2, 3, 5,];
		$generatedData = [6, 7, 8,];
		$generatedTable = new MultiplicationTable($primesGenerated, $generatedData);
		$this->primesNumberGenerator->generate($count)->willReturn($primesGenerated);
		$this->multiplicationTableGenerator->generate($primesGenerated)->willReturn($generatedTable);

		$result = $this->generator->generate($count);
		$this->assertEquals($generatedTable, $result);
	}

	public function testGenerateSizeTooSmall()
	{
		$this->expectException(RuntimeException::class);
		$this->generator->generate(0);
	}
}
