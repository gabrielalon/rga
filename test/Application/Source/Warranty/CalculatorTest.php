<?php

namespace Module\RGA\Test\Application\FinalDate;

use PHPUnit\Framework\TestCase;
use RGA\Application\Source\Warranty\Calculator;
use RGA\Test\Mock\Config;

class CalculatorTest extends TestCase
{
	/**
	 * @dataProvider dataForReturns
	 * @param $daysToReturns
	 * @param $monthsToComplaints
	 * @param $creationDate
	 * @param $expected
	 */
	public function testFinalDateOfReturn($daysToReturns, $monthsToComplaints, $creationDate, $expected)
	{
		$config = new Config($daysToReturns, $monthsToComplaints);
		$calculator = new Calculator($config);
		$finalDateOfReturn = $calculator->getFinalDateOfReturn($creationDate);
		$this->assertEquals($expected, $finalDateOfReturn);
	}

	/**
	 * @dataProvider dataForComplaint
	 * @param $daysToReturns
	 * @param $monthsToComplaints
	 * @param $creationDate
	 * @param $warranty
	 * @param $expected
	 */
	public function testFinalDateOfComplaint($daysToReturns, $monthsToComplaints, $creationDate, $warranty, $expected)
	{
		$config = new Config($daysToReturns, $monthsToComplaints);
		$calculator = new Calculator($config);
		$finalDateOfComplaint = $calculator->getFinalDateOfComplaint($creationDate, $warranty);
		$this->assertEquals($expected, $finalDateOfComplaint);

	}

	public function dataForComplaint(): array
	{
		return [
			[
				'daysToReturns'      => 7,
				'monthsToComplaints' => 1,
				'creationDate'       => 1535698292, //2018-08-31 08:51:32
				'warranty'           => 1,
				'expected'           => 1538376692, //2018-10-01 08:51:32
			],
			[
				'daysToReturns'      => 7,
				'monthsToComplaints' => 1,
				'creationDate'       => 1530427892, //2018-07-01 08:51:32
				'warranty'           => 2,
				'expected'           => 1535784692, //2018-09-01 08:51:32
			],
		];
	}

	public function dataForReturns(): array
	{
		return [
			[
				'daysToReturns'      => 7,
				'monthsToComplaints' => 1,
				'creationDate'       => 1535698292, //2018-08-31 08:51:32
				'expected'           => 1536303092, //2018-09-07 08:51:32
			],
			[
				'daysToReturns'      => 7,
				'monthsToComplaints' => 1,
				'creationDate'       => 1535998297, //2018-09-03 20:11:37
				'expected'           => 1536603097, //2018-09-10 20:11:37
			],
		];
	}
}