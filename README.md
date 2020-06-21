# E-dent

[![Build Status](https://travis-ci.org/julio-cesar-development/e-dent.svg)](https://travis-ci.org/julio-cesar-development/e-dent)
[![GitHub Status](https://badgen.net/github/status/julio-cesar-development/e-dent)](https://github.com/julio-cesar-development/e-dent)

## Instructions

### Running with Docker Compose

```bash
docker-compose up -d
```

### Running with Kubernetes

```bash
# require kubectl and helm installed
chmod +x ./deploy.sh && bash deploy.sh
# get objects
kubectl get deploy,svc,pod,ingress,pv,pvc,hpa,configmap -n edent
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
