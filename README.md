### REQUIRES

- PHP 8.1 or above
- Composer
- Rename `.env-example` to `.env`
- Run `composer install`

### RUN PHP IN DOCKER

`docker run -itv C:\Projects\php\symfony-rest:/app -w /app -p 8088:8088 php -S 0.0.0.0:8088 -t public`

### RUN COMPOSER IN WINDOWS

`composer create-project symfony/skeleton project-name`

### DOCTRINE

- Migrations: 
    - `php bin\console doctrine:migrations:diff`
    - `php bin\console doctrine:migrations:migrate`

- Creations:
    - `php bin\console doctrine:database:create`

- Deletions:
    - `php bin\console doctrine:database:drop --force`

### USING MAKER

- `composer require maker "1.43"`
- `php bin\console list make`
- `php bin\console make:entity`
- `php bin\console make:migration`
- `php bin\console make:controller`

When maker find a entity that exists, there is a way to add new props. After choose the name of it, it is possible to type `relation` and follow the tips to create.

[![Maker Update Entity](https://t0pyja.dm.files.1drv.com/y4maxUlUeEhUyTvXZgbOW5cAN0xzJoIKh3YzB_HT6-CdLgBTF7cRKWA092c6-YBmB_IWn5WHk9mM2Ws_5bnyWFtMO_8PTZRsci-K8m3NIImpyFOpsOGRv13X0bc-5t-Rc8RzK1j0Te31zmUkUFI6Fvh3rhNT9Pf6IFsdPOqTGIp51sU7UNk88e-7oEfYawrAFcWAsjfFCRGdOeqI9OZ-UFjug/maker-update-entity.png?psid=1)](https://1drv.ms/u/s!Agre0RjhOj8Pg44N6FbyYW3ro8UxzQ)