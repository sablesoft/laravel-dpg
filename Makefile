# import ENV
cnf ?= .env
include $(cnf)
export $(shell sed 's/=.*//' $(cnf))

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

zip: ## Zip archive with all public media files from storage
	zip -r media.zip storage/app/public

unzip: ## Unzip archive with media files to public storage
	unzip media.zip -d .

upload: ## Upload media files to remote host
	scp media.zip root@"${REMOTE_HOST}":/root/projects/dpg

remote: ## Connect to remote server by ssh
	ssh root@"${REMOTE_HOST}"

make fresh: ## Drop database and run migrations with seeds
	php artisan migrate:fresh --seed
