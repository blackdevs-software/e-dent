# E-dent

## Instructions

### Running with Docker

```bash
docker-compose up -d
```

### Running appart (requires a web server and MySQL)

> To import data run the following command in terminal/shell;

```bash
mysql -u ${MYSQL_USER} -p${MYSQL_PASS} -h ${MYSQL_HOST} -P ${MYSQL_PORT} < ./migrations/data.sql
```

* Execution

> The project must be executed in na web server, like Apache, Nginx, or even in the embedded PHP web server with the command:

```bash
php -S 0.0.0.0:80
```
