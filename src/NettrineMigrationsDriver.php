<?php declare(strict_types = 1);

namespace Webnazakazku\Tester\DatabaseCreator\Drivers;

use Contributte\Console\Application as ConsoleApplication;
use Exception;
use Mangoweb\Tester\DatabaseCreator\IMigrationsDriver;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;

class NettrineMigrationsDriver implements IMigrationsDriver
{

	/** @var bool */
	private $appendFixtures;

	/** @var ConsoleApplication */
	private $consoleApplication;

	public function __construct(
		bool $appendFixtures,
		ConsoleApplication $consoleApplication
	)
	{
		$this->appendFixtures = $appendFixtures;
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

		if (!$this->appendFixtures) {
			$input = new StringInput('doctrine:fixtures:load -n');
		} else {
			$input = new StringInput('doctrine:fixtures:load -n --append');
		}

		$this->consoleApplication->setAutoExit(false);
		$this->consoleApplication->run($input, $output);
	}

}
