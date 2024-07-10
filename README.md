# Modern Treasury PHP Client

This project provides a PHP client for interacting with the Modern Treasury API. The client supports creating, retrieving, listing, updating, and deleting payment orders. The project is containerized using Docker, and a `Makefile` is provided to simplify running the client commands.

## Prerequisites

- Docker
- Docker Compose
- Make

## Setup

1. Clone the repository:

   git clone https://github.com/your-repo/modern-treasury-php-client.git
   cd modern-treasury-php-client

2. Create a `.env` file in the root directory and add your Modern Treasury Organization ID and API Key:

   ORGANIZATION_ID=your_organization_id_here
   API_KEY=your_api_key_here

3. Build the Docker image:

   make build

## Usage

The `Makefile` provides targets for each of the client commands. You can run these commands using the `make` command.

### Create a Payment Order

To create a payment order, use the `create` target:

   make create amount=1000 currency=USD direction=credit type=ach originating_account_id=orig_account receiving_account_id=receiving_account description="payment"

### Get a Payment Order by ID

To get a payment order by ID, use the `get` target:

   make get id=payment_order_id_here

### List All Payment Orders

To list all payment orders, use the `list` target:

   make list

### Update a Payment Order by ID

To update a payment order by ID, use the `update` target:

   make update id=payment_order_id_here amount=1000 currency=USD direction=credit type=ach originating_account_id=orig_account receiving_account_id=receiving_account description="Updated payment description"

### Delete a Payment Order by ID

To delete a payment order by ID, use the `delete` target:

   make delete id=payment_order_id_here
