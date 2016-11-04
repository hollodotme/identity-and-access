<?php declare(strict_types = 1);

/**
 * @author: hollodotme
 */
class Test
{
	public function getTests()
	{
		yield from [ '1', '2', '3' ];
	}
}

$test = new Test();
foreach ( $test->getTests() as $t )
{
	echo $t, "\n";
}
