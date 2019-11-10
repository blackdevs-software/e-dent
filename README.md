# E-dent

## Instructions

### Running with Docker

```bash
docker-compose up -d
```

### Running appart (requires a web server and MySQL)

> To import data run the following command in terminal/shell;

```bash
mysql -u root -p -h 127.0.0.1 -P 3306 < ./migrations/data.sql
```

* Execution

> The project must be executed in na web server, like Apache, Nginx, or even in the embedded PHP web server with the command:

```bash
php -S 0.0.0.0:80
```
