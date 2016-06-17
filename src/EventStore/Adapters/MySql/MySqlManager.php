<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Adapters\MySql;

use hollodotme\EventStore\Adapters\MySql\Exceptions\BeginningTransationFailed;
use hollodotme\EventStore\Adapters\MySql\Exceptions\CommittingTransactionFailed;
use hollodotme\EventStore\Adapters\MySql\Exceptions\RollingBackTransactionFailed;
use PDO;

/**
 * Class MySqlManager
 * @package hollodotme\EventStore\Adapters\MySql
 */
final class MySqlManager extends \PDO
{
	public function __construct( MySqlConnection $connection )
	{
		parent::__construct(
			$connection->getDsn(),
			$connection->getUsername(),
			$connection->getPassword(),
			$connection->getOptions()
		);
	}

	/**
	 * @throws BeginningTransationFailed
	 */
	public function beginTransaction()
	{
		$this->guardCanBeginTransaction();

		parent::beginTransaction();
	}

	/**
	 * @throws BeginningTransationFailed
	 */
	private function guardCanBeginTransaction()
	{
		if ( $this->inTransaction() )
		{
			throw new BeginningTransationFailed();
		}
	}

	/**
	 * @throws CommittingTransactionFailed
	 */
	public function commit()
	{
		$this->guardCanCommitTransaction();

		parent::commit();
	}

	/**
	 * @throws CommittingTransactionFailed
	 */
	private function guardCanCommitTransaction()
	{
		if ( !$this->inTransaction() )
		{
			throw new CommittingTransactionFailed();
		}
	}

	/**
	 * @throws RollingBackTransactionFailed
	 */
	public function rollBack()
	{
		$this->guardCanRollBackTransaction();

		parent::rollBack();
	}

	/**
	 * @throws RollingBackTransactionFailed
	 */
	private function guardCanRollBackTransaction()
	{
		if ( !$this->inTransaction() )
		{
			throw new RollingBackTransactionFailed();
		}
	}
}