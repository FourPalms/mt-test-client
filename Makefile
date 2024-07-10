# Define the Docker Compose command
DOCKER_COMPOSE = docker-compose run --rm php-app

# Target to build the Docker image
build:
	@docker-compose build

# Target to create a payment order
create:
	@$(DOCKER_COMPOSE) create $(amount) $(currency) $(direction) $(type) $(originating_account_id) $(receiving_account_id) "$(description)"

# Target to get a payment order by ID
get:
	@$(DOCKER_COMPOSE) get $(id)

# Target to list all payment orders
list:
	@$(DOCKER_COMPOSE) list

# Target to update a payment order by ID
update:
	@$(DOCKER_COMPOSE) update $(id) $(amount) $(currency) $(direction) $(type) $(receiving_account_id) "$(description)"

# Target to delete a payment order by ID
delete:
	@$(DOCKER_COMPOSE) delete $(id)

