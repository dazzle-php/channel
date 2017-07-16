# Dazzle Async IPC Abstraction

[![Build Status](https://travis-ci.org/dazzle-php/channel.svg)](https://travis-ci.org/dazzle-php/channel)
[![Code Coverage](https://scrutinizer-ci.com/g/dazzle-php/channel/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/channel/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/dazzle-php/channel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/channel/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dazzle-php/channel/v/stable)](https://packagist.org/packages/dazzle-php/channel) 
[![Latest Unstable Version](https://poser.pugx.org/dazzle-php/channel/v/unstable)](https://packagist.org/packages/dazzle-php/channel) 
[![License](https://poser.pugx.org/dazzle-php/channel/license)](https://packagist.org/packages/dazzle-php/channel/license)

> **Note:** This repository is part of [Dazzle Project](https://github.com/dazzle-php/dazzle) - the next-gen library for PHP. The project's purpose is to provide PHP developers with a set of complete tools to build functional async applications. Please, make sure you read the attached README carefully and it is guaranteed you will be surprised how easy to use and powerful it is. In the meantime, you might want to check out the rest of our async libraries in [Dazzle repository](https://github.com/dazzle-php) for the full extent of Dazzle experience.

<br>
<p align="center">
<img src="https://raw.githubusercontent.com/dazzle-php/dazzle/master/media/dazzle-x125.png" />
</p>

## Description

Dazzle Channel is an event-based component that allows sending and receiving messsages asynchronously. It provides abstraction for various IPC models and is designed to be used in multi-threaded, multi-processed systems. It provides complex routing mechanisms, protocols, message encoders and extends behaviour of decorated IPC models by implementing hearbeat mechanisms, reconnect mechanisms and allowing usage of both async and request-reply messaging patterns.

## Feature Highlights

Dazzle Channel features:

* Message-driven communication,
* IPC models abstraction,
* Support for sending asynchronous messages,
* Support for request-reply pattern,
* Built-in offline and online message buffers,
* Built-in configurable protocol-based routing mechanisms,
* Separation of input and output routers,
* Heartbeat mechanism,
* Reconnect mechanism,
* Event-based & Promise-based API,
* ...and more.

## Provided Example(s)

### Quickstart

TODO

### Additional

TODO

## Requirements

Dazzle Channel requires:

* PHP-5.6 or PHP-7.0+,
* UNIX or Windows OS.

## Installation

To install this library make sure you have [composer](https://getcomposer.org/) installed, then run following command:

```
$> composer require dazzle-php/channel
```

## Tests

Tests can be run via:

```
$> vendor/bin/phpunit -d memory_limit=1024M
```

## Versioning

Versioning of Dazzle libraries is being shared between all packages included in [Dazzle Project](https://github.com/dazzle-php/dazzle). That means the releases are being made concurrently for all of them. On one hand this might lead to "empty" releases for some packages at times, but don't worry. In the end it is far much easier for contributors to maintain and -- what's the most important -- much more straight-forward for users to understand the compatibility and inter-operability of the packages.

## Contributing

Thank you for considering contributing to this repository! 

- The contribution guide can be found in the [contribution tips](https://github.com/dazzle-php/channel/blob/master/CONTRIBUTING.md). 
- Open tickets can be found in [issues section](https://github.com/dazzle-php/channel/issues). 
- Current contributors are listed in [graphs section](https://github.com/dazzle-php/channel/graphs/contributors)
- To contact the author(s) see the information attached in [composer.json](https://github.com/dazzle-php/channel/blob/master/composer.json) file.

## License

Dazzle Channel is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

<hr>
<p align="center">
<i>"Everything is possible. The impossible just takes longer."</i> ― Dan Brown
</p>
