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
parameters:
    appendFixtures: true

mango.tester.databaseCreator:
    driver: mysql
    dbal: Webnazakazku\Tester\DatabaseCreator\Drivers\MySqlNettrineMigrationsDbalAdapter
    migrations: Webnazakazku\Tester\DatabaseCreator\Drivers\NettrineMigrationsDriver(%appendFixtures%)
    strategy: reset
```
