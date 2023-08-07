<?php

declare(strict_types=1);

namespace PrimeMultiplication;

use InvalidArgumentException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
	name: 'app:prime-multiplication-table',
	description: 'Generate multiplication table of given number of prime numbers.',
	hidden: false,
)]
class PrimeMultiplicationTableCommand extends Command
{
	public function __construct(
		private PrimeMultiplicationTableGenerator $generator,
	) {
		parent::__construct(null);
	}

	protected function configure(): void
	{
		$this->addArgument('size', InputArgument::REQUIRED, 'How many rows (prime numbers) should be the table made of');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$size = $input->getArgument('size');

		if (!is_numeric($size) || (int)$size <= 0) {
			throw new InvalidArgumentException('The "size" argument must be an integer greater than 0.');
		}
		$size = (int)$size;

		$multiplicationTable = $this->generator->generate($size);

		foreach ($multiplicationTable->getData() as $data) {
			$output->writeln(implode("\t", $data));
		}

		/*
		$table = new Table($output);
		$table->setHeaders($multiplicationTable->getRows());
		$table->setRows($multiplicationTable->getData());
		$table->render();
		*/

		return Command::SUCCESS;
	}
}
