<?php

declare(strict_types=1);

namespace PrimeMultiplication;

class MultiplicationTable
{
	public function __construct(
		private array $rows,
		private array $data,
	) {
	}

	public function getRows(): array
	{
		return $this->rows;
	}

	public function getData(): array
	{
		return $this->data;
	}
}
