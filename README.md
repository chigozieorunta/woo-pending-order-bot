# WooCommerce Pending Order Reminder Bot

Send SMS messages to buyers notifying them of abandoned cart orders. It makes use of your Twilio API account to send SMS messages to your customers.

## Requirements

- WordPress 5.0+
- PHP 7.2 or later
- WooCommerce
- Twilio
- Carbon Fields
- [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org) for dependency management.
- [Docker](https://docs.docker.com/install/) or [Vagrant](https://www.vagrantup.com) with [VirtualBox](https://www.virtualbox.org) for a local development environment.

I suggest using a software package manager for installing the development dependencies such as [Homebrew](https://brew.sh) on MacOS:

```
brew install php composer node docker docker-compose
```

or [Chocolatey](https://chocolatey.org) for Windows:

```
choco install php composer node nodejs docker-compose
```

## Development

This repository includes a WordPress development environment based on [Docker](https://docs.docker.com/install/) that can be run on your computer or inside a [Vagrant](https://www.vagrantup.com/) and [VirtualBox](https://www.virtualbox.org/) wrapper for network isolation and simple `.local` domain names.

1. Clone the plugin repository.

2. Setup the development environment and tools using [Node.js](https://nodejs.org) and [Composer](https://getcomposer.org):

```
npm install
```

Note that both Node.js and PHP 7.2 or later are required on your computer for running the `npm` scripts. Use `npm run docker -- npm install` to run the installer inside a Docker container if you don't have the required version of PHP installed locally.

3. To use the Vagrant based environment, run:

```
vagrant up
```

which will make it available at [slack-bot.local](http://wporb.local).

Use the included wrapper command for running scripts inside the Docker container running inside Vagrant:

```
npm run vagrant -- npm run test:php
```

where `npm run test:php` is any of the scripts you would like to run.

Visit [wporb.local:8025](http://wporb.local:8025) to check all emails sent by WordPress.