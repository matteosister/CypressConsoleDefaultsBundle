CypressCommandDefaultsBundle
============================

[![Build Status](https://travis-ci.org/matteosister/CypressConsoleDefaultsBundle.png?branch=master)](https://travis-ci.org/matteosister/CypressConsoleDefaultsBundle)

this bundle lets you define defaults parameters for your commands. If you forget to add *--symlink* every time you run *assets:install* this bundle is for you.

This bundles uses [console events](http://symfony.com/doc/current/components/console/events.html) to work. So you need at least the **2.3 LTS** version of symfony! Also, it uses Closure::bind function

### Installation

```json
{
    "require" {
        "cypresslab/console-defaults-bundle": "~0.3"
    }
}
```

register the bundle in your AppKernel.php

```php
$bundles[] = new Cypress\ConsoleDefaultsBundle\CypressConsoleDefaultsBundle();
```

### Usage

add the commands, with the defaults you want, under the *cypress_console_defaults* key. Here is an example

```yaml
cypress_console_defaults:
    commands:
        "doctrine:fixtures:load":
            params: [ "--append", "--fixtures src/NS/DataFixtures" ]

        "rabbitmq:consumer":
            params: [ "-w" ]

        "cache:clear":
            params: [ "--no-warmup", "--no-optional-warmers"]
```

the next time you will call one of the defined command the bundle will add the parameters for you

```
$ ./app/console cache:clear
$ --- ConsoleDefaultsBundle You have defined some defaults for this command
$ --- proceeding with defaults: --no-warmup, --no-optional-warmers
$ Clearing the cache for the dev environment with debug true
```