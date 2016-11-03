<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql;

use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\Exceptions\BeginningTransationFailed;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\Exceptions\CommittingTransactionFailed;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\Exceptions\RollingBackTransactionFailed;
use PDO;

/**
 * Class MySqlManager
 * @package hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql
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

		if ( !parent::beginTransaction() )
		{
			throw new BeginningTransationFailed();
		}
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

		if ( !parent::commit() )
		{
			throw new CommittingTransactionFailed();
		}
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

		if ( !parent::rollBack() )
		{
			throw new RollingBackTransactionFailed();
		}
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
