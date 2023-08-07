<?php

declare(strict_types=1);

namespace unitTests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PrimeMultiplication\MultiplicationTable;
use PrimeMultiplication\PrimeMultiplicationTableCommand;
use PrimeMultiplication\PrimeMultiplicationTableGenerator;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PrimeMultiplicationTableCommandTest extends TestCase
{
	use ProphecyTrait;

	private ObjectProphecy $tableGenerator;
	private CommandTester $command;

	public function setUp(): void
	{
		$application = new Application();

		$this->tableGenerator = $this->prophesize(PrimeMultiplicationTableGenerator::class);
		$application->add(new PrimeMultiplicationTableCommand($this->tableGenerator->reveal()));

		$command = $application->find('app:prime-multiplication-table');
		$this->command = new CommandTester($command);
		parent::setUp();
	}

	public function testExecute(): void
	{
		$size = 5;
		$generatedTable = new MultiplicationTable([1, 2], [[3, 4]]);

		$this->tableGenerator->generate($size)->willReturn($generatedTable);

		$this->command->execute(
			['size' => $size]
		);

		$this->assertEquals("X\t1\t2\n1\t3\t4\n", $this->command->getDisplay());
	}

	/**
	 * @dataProvider executeWrongInputTestDataProvider
	 */
	public function testExecuteWrongInput($input): void
	{
		$this->expectException(InvalidArgumentException::class);

		$this->command->execute(
			['size' => $input]
		);
	}

	public static function executeWrongInputTestDataProvider(): array
	{
		return [
			[
				'a',
			],
			[
				0,
			],
		];
	}
}
