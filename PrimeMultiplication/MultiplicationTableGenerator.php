<?php

declare(strict_types=1);

namespace PrimeMultiplication;

class MultiplicationTableGenerator
{
	public function generate(array $rows): MultiplicationTable
	{
		$table = array();
		$length = count($rows);
		for ($i = 0; $i < $length; $i++) {
			for ($j = $i; $j < $length; $j++) {
				$table[$i][$j] = $table[$j][$i] = $rows[$i] * $rows[$j];
			}
		}
		return new MultiplicationTable($rows, $table);
	}
}
