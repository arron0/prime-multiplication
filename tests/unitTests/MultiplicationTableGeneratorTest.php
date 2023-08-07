<?php

declare(strict_types=1);

namespace unitTests;

use PHPUnit\Framework\TestCase;
use PrimeMultiplication\MultiplicationTableGenerator;

class MultiplicationTableGeneratorTest extends TestCase
{
	private MultiplicationTableGenerator $tableGenerator;

	public function setUp(): void
	{
		$this->tableGenerator = new MultiplicationTableGenerator();
		parent::setUp();
	}

	/**
	 * @dataProvider generateTestDataProvider
	 */
	public function testGenerate(array $rows, array $expectedTable): void
	{
		$generatedTable = $this->tableGenerator->generate($rows);

		$this->assertEquals($rows, $generatedTable->getRows());
		$this->assertEquals($expectedTable, $generatedTable->getData());
	}

	public static function generateTestDataProvider(): array
	{
		return [
			[
				'rows' => [1, 2],
				'expectedData' => [
					[1, 2],
					[2, 4],
				],
			],
		];
	}
}
