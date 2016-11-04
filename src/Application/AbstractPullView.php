<?php declare(strict_types = 1);
/**
 * Copyright (c) 2016 Holger Woltersdorf & Contributors
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

namespace hollodotme\IdentityAndAccess\Application;

use hollodotme\EventStore\EventStore;
use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;

/**
 * Class AbstractPullView
 * @package hollodotme\IdentityAndAccess\Application
 */
abstract class AbstractPullView
{
	/** @var EventStore */
	private $eventStore;

	public function __construct( EventStore $eventStore )
	{
		$this->eventStore = $eventStore;
	}

	final protected function pullNamedStream( StreamName $streamName ) : EventStream
	{
		return $this->eventStore->retrieveNamedStream( $streamName );
	}

	final protected function pullEntityStream(
		StreamName $streamName, StreamId $streamId, StreamSequence $fromSequence
	): EventStream
	{
		return $this->eventStore->retrieveEntityStream( $streamName, $streamId, $fromSequence );
	}

	final protected function pullFullStream() : EventStream
	{
		return $this->eventStore->retrieveFullStream();
	}
}
