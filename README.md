### RUN PHP IN DOCKER

`docker run -itv C:\Projects\php\symfony-rest:/app -w /app -p 8088:8088 php -S 0.0.0.0:8088 -t public`

### RUN COMPOSER IN WINDOWS

`composer create-project symfony/skeleton project-name`