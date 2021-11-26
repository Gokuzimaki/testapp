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
