<?php declare(strict_types = 1);

namespace Webnazakazku\Tester\DatabaseCreator\Drivers;

use DateTime;
use Doctrine;
use Mangoweb\Tester\DatabaseCreator\IDbal;

class MySqlNettrineMigrationsDbalAdapter implements IDbal
{

	/** @var Doctrine\DBAL\Connection */
	private $conn;

	public function __construct(Doctrine\DBAL\Connection $conn)
	{
		$this->conn = $conn;
	}

	/**
	 * @return array<mixed>
	 */
	public function query(string $sql): array
	{
		return $this->conn->fetchAllAssociative($sql);
	}

	public function exec(string $sql): int
	{
		return (int) $this->conn->executeStatement($sql);
	}

	public function escapeString(string $value): string
	{
		return $this->conn->quote($value, Doctrine\DBAL\Types\Type::STRING);
	}

	public function escapeInt(int $value): string
	{
		return $this->conn->quote($value, Doctrine\DBAL\Types\Type::INTEGER);
	}

	public function escapeBool(bool $value): string
	{
		return $this->conn->quote($value, Doctrine\DBAL\Types\Type::BOOLEAN);
	}

	public function escapeDateTime(DateTime $value): string
	{
		return $this->conn->quote($value, Doctrine\DBAL\Types\Type::DATETIME);
	}

	public function escapeIdentifier(string $value): string
	{
		return $this->conn->quoteIdentifier($value);
	}

	public function connectToDatabase(string $name): void
	{
		$this->conn->executeStatement(sprintf(
			'DROP DATABASE %s; CREATE DATABASE %s; USE %s',
			$this->escapeIdentifier($name),
			$this->escapeIdentifier($name),
			$this->escapeIdentifier($name)
		));
	}

}
