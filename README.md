# foodsharing-api

This is a foodsharing API backend. It is meant to operate on the same database as the legacy foodsharing.de software, so to keep it simple, it must not modify the schema.

This software is build on symfony 3 with some bundles to simplify providing a json API.

# Installing

## Requirements

* PHP (>=5.6, 7 recommended)
* composer
* MySQL
* PDO MySQL module
* PHP modules to satisfy symfony

## Install

To install, just clone the repository and run `composer update`.

## Database

This application is not able to run without having a properly initialized database. While the structure for a test setup can be build with `bin/symfony doctrine:schema:update`, the necessary data is not (yet) included and cannot be generated by the application itself (e.g. user registration). It should still be easy for you to manually create some users etc.
A pull request with some test data is highly appreciated.

So far, running in parallel to the legacy foodsharing.de software is suggested. That is available including a development setup after requesting access to https://gitlab.com/foodsharing-dev.
Configure the database access accordingly:

|Option|Value|
|----|----|
|User|root|
|Passwort|root|
|Host|127.0.0.1|
|Port|13306|
|Database|foodsharing|

# Running

Fire up a symfony dev server by running `bin/symfony server:run`.
