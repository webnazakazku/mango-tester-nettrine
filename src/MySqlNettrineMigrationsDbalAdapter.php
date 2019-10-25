<?php

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

	public function query($sql): array
	{
		return $this->conn->fetchAll($sql);
	}

	public function exec($sql): int
	{
		return $this->conn->exec($sql);
	}

	public function escapeString($value): string
	{
		return $this->conn->quote($value, Doctrine\DBAL\Types\Type::STRING);
	}

	public function escapeInt($value): string
	{
		return $this->conn->quote($value, Doctrine\DBAL\Types\Type::INTEGER);
	}

	public function escapeBool($value): string
	{
		return $this->conn->quote($value, Doctrine\DBAL\Types\Type::BOOLEAN);
	}

	public function escapeDateTime(DateTime $value): string
	{
		return $this->conn->quote($value, Doctrine\DBAL\Types\Type::DATETIME);
	}

	public function escapeIdentifier($value): string
	{
		return $this->conn->quoteIdentifier($value);
	}

	public function connectToDatabase(string $name): void
	{
		$this->conn->exec(sprintf(
				'DROP DATABASE %s; CREATE DATABASE %s; USE %s',
				$this->escapeIdentifier($name), $this->escapeIdentifier($name), $this->escapeIdentifier($name)
		));
	}
}
