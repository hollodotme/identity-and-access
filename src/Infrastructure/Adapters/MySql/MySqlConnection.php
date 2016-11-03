<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql;

/**
 * Class MySqlConnection
 * @package hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql
 */
final class MySqlConnection
{
	const CHARSET_DEFAULT = 'utf8';

	/** @var string */
	private $host;

	/** @var int */
	private $port;

	/** @var string */
	private $database;

	/** @var string */
	private $username;

	/** @var string */
	private $password;

	/** @var string */
	private $charset;

	public function __construct(
		string $host, int $port, string $database,
		string $username, string $password,
		string $charset = self::CHARSET_DEFAULT
	)
	{
		$this->host     = $host;
		$this->port     = $port;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
		$this->charset  = $charset;
	}

	public function getDsn() : string
	{
		return sprintf(
			"mysql:host=%s;port=%d;dbname=%s",
			$this->host, $this->port, $this->database
		);
	}

	public function getUsername() : string
	{
		return $this->username;
	}

	public function getPassword() : string
	{
		return $this->password;
	}

	public function getCharset() : string
	{
		return $this->charset;
	}

	public function getOptions() : array
	{
		return [
			\PDO::ATTR_CURSOR                   => \PDO::CURSOR_FWDONLY,
			\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
			\PDO::MYSQL_ATTR_INIT_COMMAND       => "SET CHARACTER SET {$this->charset}",
		];
	}
}
