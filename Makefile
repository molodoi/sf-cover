# Variables
DOCKER = docker
DOCKER_COMPOSE = docker compose
EXEC = $(DOCKER) exec -w /var/www/ www_sfcover
PHP = $(EXEC) php
COMPOSER = $(EXEC) composer
NPM = $(EXEC) npm
SYMFONY_CONSOLE = $(PHP) bin/console
SYMFONY = php bin/console
VENDOR = php vendor/bin/

## —— 📊 Database ——
database-create: ## Create database
	$(SYMFONY_CONSOLE) d:d:c
.PHONY: database-create

database-remove: ## Drop database
	$(SYMFONY_CONSOLE) d:d:d --force --if-exists
.PHONY: database-remove

database-migration: ## Make migration
	$(SYMFONY_CONSOLE) make:migration
.PHONY: database-migration

migration: ## Alias : database-migration
	$(MAKE) database-migration
.PHONY: migration

database-migrate: ## Migrate migrations
	$(SYMFONY_CONSOLE) d:m:m --no-interaction
.PHONY: database-migrate

migrate: ## Alias : database-migrate
	$(MAKE) database-migrate
.PHONY: database-migrate

## —— Messenger Webmail ——
messenger-c: ## Messenger:consume
	$(SYMFONY_CONSOLE) messenger:consume -vv
.PHONY: messenger-c

webmail: ## Messenger:consume
	$(SYMFONY_CONSOLE) open:local:webmail
.PHONY: webmail

## —— 🐳 Docker ——
start: ## Start app
	$(MAKE) docker-start 
.PHONY: start

docker-start: 
	$(DOCKER_COMPOSE) up -d
.PHONY: docker-start

stop: ## Stop app
	$(MAKE) docker-stop
.PHONY: stop

docker-stop: 
	$(DOCKER_COMPOSE) stop
	@$(call GREEN,"The containers are now stopped.")
.PHONY: docker-stop

prune:
	$(DOCKER) system prune -a
.PHONY: prune

vprune:
	$(DOCKER) volume prune
.PHONY: vprune

redocker:
	$(MAKE) docker-stop prune start
.PHONY: redocker

container-exec: ## (make container-exec cmd="vendor/bin/bdi detect drivers").
	$(EXEC) $(cmd)
.PHONY: container-exec