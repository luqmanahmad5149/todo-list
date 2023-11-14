setup:
	@make build
	@make up 
	@make composer-update
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec todo-list bash -c "composer update"
	docker exec todo-list bash -c "npm install"
	docker exec todo-list bash -c "npm run build"
data:
	docker exec todo-list bash -c "php artisan migrate:fresh --seed"