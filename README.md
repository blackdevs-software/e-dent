# E-dent

* Instructions

> To import data run the following command in terminal/shell;

```bash
mysql -u root -p -h 127.0.0.1 -P 3306 -e "CREATE SCHEMA IF NOT EXISTS db_odontologia;"
mysql -u root -p -h 127.0.0.1 -P 3306 db_odontologia < data.sql
```

* Execution

> The project must be executed in na web server, like Apache, Nginx, or even in the embedded PHP web server with the command:

```bash
php -S 0.0.0.0:80
```
