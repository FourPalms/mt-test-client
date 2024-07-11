# Modern Treasury PHP Client

This project provides a PHP client for interacting with the Modern Treasury API. The client supports creating, retrieving, listing, updating, and deleting payment orders. The project is containerized using Docker, and a `Makefile` is provided to simplify running the client commands.

## Prerequisites

- Docker
- Docker Compose
- Make

## Setup

1. Clone the repository:

   ```
   git clone https://github.com/your-repo/modern-treasury-php-client.git
   cd modern-treasury-php-client
   ```

2. Create a `.env` file in the root directory and add your Modern Treasury Organization ID and API Key:

   ```
   ORGANIZATION_ID=your_organization_id_here
   API_KEY=your_api_key_here
   ```

4. Build the Docker image:

   `make build`

## Usage

The `Makefile` provides targets for each of the client commands. You can run these commands using the `make` command.

