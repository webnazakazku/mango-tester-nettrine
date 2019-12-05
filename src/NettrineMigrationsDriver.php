<?php

namespace Webnazakazku\Tester\DatabaseCreator\Drivers;

use Contributte\Console\Application as ConsoleApplication;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Mangoweb\Tester\DatabaseCreator\IMigrationsDriver;
use Nette;
use Nettrine\Fixtures\Command\LoadDataFixturesCommand;
use Symfony;

class NettrineMigrationsDriver implements IMigrationsDriver
{

	/** @var bool */
	private $appendFixtures;

	/** @var Nette\DI\Container */
	private $container;

	/** @var ConsoleApplication */
	private $consoleApplication;

	/** @var LoadDataFixturesCommand */
	private $loadDataFixturesCommand;

	/** @var MigrateCommand */
	private $migrateCommand;

	public function __construct(
		$appendFixtures = false,
		Nette\DI\Container $container,
		ConsoleApplication $consoleApplication,
		LoadDataFixturesCommand $loadDataFixturesCommand,
		MigrateCommand $migrateCommand
	)
	{
		$this->appendFixtures = $appendFixtures;
		$this->container = $container;
		$this->consoleApplication = $consoleApplication;
		$this->loadDataFixturesCommand = $loadDataFixturesCommand;
		$this->migrateCommand = $migrateCommand;
	}

	public function continue(): void
	{
		throw new Nette\Application\AbortException('Continue strategy is not implement');
	}

	public function getMigrationsHash(): string
	{
		return '';
	}

	public function reset(): void
	{
		$input = new Symfony\Component\Console\Input\StringInput('migrations:migrate');
		$output = new Symfony\Component\Console\Output\BufferedOutput();

		$this->consoleApplication->add($this->migrateCommand);
		$this->consoleApplication->setAutoExit(false);
		$this->consoleApplication->run($input, $output);

		if (!$this->appendFixtures) {
			$input = new Symfony\Component\Console\Input\StringInput('doctrine:fixtures:load');
		} else {
			$input = new Symfony\Component\Console\Input\StringInput('doctrine:fixtures:load --append');
		}

		$this->consoleApplication->add($this->loadDataFixturesCommand);
		$this->consoleApplication->setAutoExit(false);
		$this->consoleApplication->run($input, $output);
	}
}
