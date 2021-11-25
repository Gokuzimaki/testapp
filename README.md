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
* `php bin/console doctrine:schema:create --dump-sql`
* `php bin/console make:migration`
* Generate a new Migration: `php bin/console doctrine:migrations:generate`
* Migrating new Migrations: `php bin/console doctrine:migrations:migrate`
* `php bin/console doctrine:schema:update --force`
* mysql -u USERNAME -pPASSWORD -h HOSTNAMEORIP DATABASENAME
* mysql -u root -pPassword -h db afrilence


##### Cache
* `php bin/console cache:clear`
* Dump ENV  `composer dump-env prod`


### Nginx
* restart `/etc/init.d/nginx restart`
