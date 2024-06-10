# Trip App with Symfony and Reactjs

this application created by symfony backend and reactjs frontend

## Installation

Require this package with docker using the following command:

in docker folder you use this command
```bash
docker compose ud -d
```


## How to Setup DB

go to app contaner

```bash
docker exec -it containerid /bin/bash
```

for create tables for this app , please run this command

```bash

php bin/console doctrine:migrations:migrate


php bin/console doctrine:fixtures:load
```


## Request Rest Api

load following file into postman and run request

```bash
trips.postman_collection.json
```



