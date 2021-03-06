SHELL := /bin/bash

tests: export APP_ENV=test
tests:
	php bin/console doctrine:database:drop --force || true
	php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate -n
	php bin/phpunit --testdox $@
.PHONY: tests
