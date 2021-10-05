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