default: help

# Perl Colors, with fallback if tput command not available
GREEN  := $(shell command -v tput >/dev/null 2>&1 && tput -Txterm setaf 2 || echo "")
BLUE   := $(shell command -v tput >/dev/null 2>&1 && tput -Txterm setaf 4 || echo "")
WHITE  := $(shell command -v tput >/dev/null 2>&1 && tput -Txterm setaf 7 || echo "")
YELLOW := $(shell command -v tput >/dev/null 2>&1 && tput -Txterm setaf 3 || echo "")
RESET  := $(shell command -v tput >/dev/null 2>&1 && tput -Txterm sgr0 || echo "")

# Add help text after each target name starting with '\#\#'
# A category can be added with @category
HELP_FUN = \
    %help; \
    while(<>) { push @{$$help{$$2 // 'options'}}, [$$1, $$3] if /^([a-zA-Z\-]+)\s*:.*\#\#(?:@([a-zA-Z\-]+))?\s(.*)$$/ }; \
    print "usage: make [target]\n\n"; \
    for (sort keys %help) { \
    print "${WHITE}$$_:${RESET}\n"; \
    for (@{$$help{$$_}}) { \
    $$sep = " " x (32 - length $$_->[0]); \
    print "  ${YELLOW}$$_->[0]${RESET}$$sep${GREEN}$$_->[1]${RESET}\n"; \
    }; \
    print "\n"; }

help:
	@perl -e '$(HELP_FUN)' $(MAKEFILE_LIST)

SHELL=/bin/bash

########################################
#                APP                   #
########################################
back: ##@App run back
	symfony serve --document-root=www

front: ##@App run front
	npm start

########################################
#               TOOLS                  #
########################################
install: ##@Tools install deps
	composer install
	npm ci

update: ##@Tools update deps
	composer update

########################################
#                 QA                   #
########################################
cs-check: ##@QA run fixer (check)
	vendor/bin/php-cs-fixer fix --dry-run

cs-fix: ##@QA run fixer
	vendor/bin/php-cs-fixer fix

test: ##@QA run tests
	vendor/bin/phpunit --testdox

test-i: ##@QA run integration tests
	vendor/bin/phpunit --testdox --testsuite integration

test-u: ##@QA run unit tests
	vendor/bin/phpunit --testdox --testsuite unit
