USER=nginx

up:
	env UID=$$(id -u) GID=$$(id -g)  docker-compose up --build

stop:
	docker-compose stop

down:
	docker-compose down

sh:
	docker-compose exec --user=${USER} application bash

sh\:db:
	docker-compose exec database bash

