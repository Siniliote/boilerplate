## ENVIRONMENT

.PHONY: env.app
env.app: ## Environment: Print current APP_ENV in Makefile.
	@echo -e '\033[1;43mAPP_ENV=$(APP_ENV)\033[0m';

.PHONY: env.local.dev
env.local.dev: env.local.clean ## Environment: Alias of `env.local.clean`.
