## Lumio Test App
##### SETUP Docker
* `$ docker-compose up -d`
* For Windows please run the command below
* `$ docker-compose -f docker-compose.dev.yml up --remove-orphans`
* Go into DB `docker-compose exec db /bin/bash`
* Check where volumes are mounted `docker inspect -f '{{ .Mounts }}' containerId`

* Go into the machine with `$ docker-compose exec php bash` and run the commands below
* `$ composer install`
* `$ php bin/console doctrine:migrations:migrate`

* App available on `http://localhost:8086` on windows

#### Database
* Migrating new Migrations: `php bin/console doctrine:migrations:migrate`
* Migrating test Migrations: `APP_ENV=test php bin/console d:m:m`
* mysql -u USERNAME -pPASSWORD -h HOSTNAMEORIP DATABASENAME
* mysql -u root -pPassword -h db taskapp


##### Cache
* `php bin/console cache:clear`
* Dump ENV  `composer dump-env prod`


### Nginx
* restart `/etc/init.d/nginx restart`

### Tests
* Go into the machine with `$ docker-compose exec php bash` and run the command below
* `php bin/phpunit`
* Or Use MakeFile.mk to run tests with the command below
* `make -f Makefile.mk`

* Install [PostMan]
* Use PostMan via the link below while docker is up and running.
* `https://go.postman.co/workspace/Local-Test~b4e599bd-5a51-4b03-a852-0644133ec91d/collection/18453068-9693f690-dbec-4b13-a7aa-fbecee2b4297`

[PostMan]: <https://www.postman.com/downloads/>
