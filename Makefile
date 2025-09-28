# Makefile for PHP OOP MVC CLI App with Docker

.PHONY: help install run test up down

help:
	@echo "Usage: make [target]"
	@echo "Targets:"
	@echo "  install   Install PHP dependencies using Composer in Docker"
	@echo "  run ARGS=abc   Run the CLI app with argument"
	@echo "  test      Run PHPUnit tests in Docker"
	@echo "  up        Start Docker containers"
	@echo "  down      Stop Docker containers"
	@echo "  help      Show this help message"

install:
	docker compose run php composer install

run:
	docker compose run php php src/cli.php $(ARGS)

test:
	docker compose run php ./vendor/bin/phpunit tests

up:
	docker compose up -d

down:
	docker compose down

# Default target
.DEFAULT_GOAL := help
