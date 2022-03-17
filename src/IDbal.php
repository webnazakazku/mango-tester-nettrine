<?php declare(strict_types = 1);

/**
 * This file is part of the Nextras community extensions of Nette Framework
 *
 * @link       https://github.com/nextras/migrations
 */

namespace Webnazakazku\Tester\DatabaseCreator\Drivers;

use DateTime;

interface IDbal
{

	/**
	 * @return array<mixed> list of rows represented by assoc. arrays
	 */
	public function query(string $sql): array;

	/**
	 * @return int number of affected rows
	 */
	public function exec(string $sql): int;

	/**
	 * @return string escaped string wrapped in quotes
	 */
	public function escapeString(string $value): string;

	public function escapeInt(int $value): string;

	public function escapeBool(bool $value): string;

	public function escapeDateTime(DateTime $value): string;

	public function escapeIdentifier(string $value): string;

}
