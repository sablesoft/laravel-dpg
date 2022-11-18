# import ENV
#cnf ?= .env
#include $(cnf)
#export $(shell sed 's/=.*//' $(cnf))

# grep the version from the mix file
#VERSION=$(shell ./version.sh)

# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

bash:  ## Run bash inside container
	docker exec -it dpg bash
