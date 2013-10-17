CypressCommandDefaultsBundle
============================

[![Build Status](https://travis-ci.org/matteosister/CypressConsoleDefaultsBundle.png?branch=master)](https://travis-ci.org/matteosister/CypressConsoleDefaultsBundle)

this bundle lets you define defaults parameters for your commands. It makes use of [console events](http://symfony.com/doc/current/components/console/events.html) to work. So you need at least the **2.3 LTS** version of symfony

to install just require the **cypresslab/console-defaults-bundle** at **~0.3** version. [Read the complete instructions here](https://github.com/matteosister/CypressConsoleDefaultsBundle/blob/master/INSTALL.md)

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

### Use cases

1. default to *--symlink* for assets install

```yaml
cypress_console_defaults:
    commands:
        "assets:install":
            params: [ "--symlink" ]
```

2. change the folder where the fixtures are loaded

```yaml
cypress_console_defaults:
    commands:
        "doctrine:fixtures:load":
            params: [ "--fixtures my/personal/folder" ]
```

3. disable cache warmup

```yaml
cypress_console_defaults:
    commands:
        "cache:clear":
            params: [ "--no-warmup", "--no-optional-warmers" ]
```

other ideas?