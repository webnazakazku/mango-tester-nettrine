<?php declare(strict_types = 1);

namespace Webnazakazku\Tester\DatabaseCreator\Drivers;

use Contributte\Console\Application as ConsoleApplication;
use Exception;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Webnazakazku\MangoTester\DatabaseCreator\IMigrationsDriver;

class NettrineMigrationsDriver implements IMigrationsDriver
{

	/** @var ConsoleApplication */
	private $consoleApplication;

	public function __construct(ConsoleApplication $consoleApplication)
	{
		$this->consoleApplication = $consoleApplication;
	}

	public function continue(): void
	{
		throw new Exception('Continue strategy is not implement');
	}

	public function getMigrationsHash(): string
	{
		return '';
	}

	public function reset(): void
	{
		$input = new StringInput('migrations:migrate -n');
		$output = new BufferedOutput();

		$this->consoleApplication->setAutoExit(false);
		$this->consoleApplication->run($input, $output);

		$input = new StringInput('doctrine:fixtures:load -n');

		$this->consoleApplication->run($input, $output);
	}

}
