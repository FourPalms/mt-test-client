# Define the Docker Compose command
DOCKER_COMPOSE = docker-compose run --rm php-app
RUN_PHP = php run.php

# Target to build the Docker image
build:
	@docker-compose build
	@$(MAKE) install

install:
	@$(DOCKER_COMPOSE) composer install

# Target to create a payment order
create_payment_order:
	@$(DOCKER_COMPOSE) $(RUN_PHP) create_payment_order $(amount) $(currency) $(direction) $(type) $(originating_account_id) $(receiving_account_id) "$(description)"

# Target to get a payment order by ID
get_payment_order:
	@$(DOCKER_COMPOSE) $(RUN_PHP) get_payment_order $(id)

# Target to list all payment orders
list_payment_orders:
	@$(DOCKER_COMPOSE) $(RUN_PHP) list_payment_orders

# Target to update a payment order by ID
update_payment_order:
	@$(DOCKER_COMPOSE) $(RUN_PHP) update_payment_order $(id) $(amount) $(currency) $(direction) $(type) $(receiving_account_id) "$(description)"

# Target to delete a payment order by ID
delete_payment_order:
	@$(DOCKER_COMPOSE) $(RUN_PHP) delete_payment_order $(id)

# Target to create an internal account
create_internal_account:
	@$(DOCKER_COMPOSE) $(RUN_PHP) create_internal_account $(connection_id) $(name) $(party_name) $(currency) $(parent_account_id) $(counterparty_id) $(metadata) $(party_address)

# Target to list all internal accounts
list_internal_accounts:
	@$(DOCKER_COMPOSE) $(RUN_PHP) list_internal_accounts $(currency) $(payment_type) $(payment_direction) $(after_cursor) $(per_page) $(metadata) $(counterparty_id) $(legal_entity_id)

# Target to get an internal account by ID
get_internal_account:
	@$(DOCKER_COMPOSE) $(RUN_PHP) get_internal_account $(id)

# Target to update an internal account by ID
update_internal_account:
	@$(DOCKER_COMPOSE) $(RUN_PHP) update_internal_account $(id) $(name) $(metadata) $(parent_account_id) $(counterparty_id) $(ledger_account_id)
