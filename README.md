# Nettrine Migrations and Fixtures for Mango Tester

Install:
========

```
composer require webnazakazku/mango-tester-nettrine
```

Usage
=====

`tests/config/tests.neon`

```yaml
extensionns:
    console: Contributte\Console\DI\ConsoleExtension(%consoleMode%)
    migrations: Nettrine\Migrations\DI\MigrationsExtension
    fixtures: Nettrine\Fixtures\DI\FixturesExtension

migrations:
    directory: %appDir%/../migrations

fixtures:
    paths:
      - %appDir%/Model/Fixtures

mango.tester.databaseCreator:
    driver: mysql
    dbal: Webnazakazku\Tester\DatabaseCreator\Drivers\MySqlNettrineMigrationsDbalAdapter
    migrations: Webnazakazku\Tester\DatabaseCreator\Drivers\NettrineMigrationsDriver
    strategy: reset
```
