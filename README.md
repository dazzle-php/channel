# Dazzle Async IPC Abstraction

[![Build Status](https://travis-ci.org/dazzle-php/channel.svg)](https://travis-ci.org/dazzle-php/channel)
[![Code Coverage](https://scrutinizer-ci.com/g/dazzle-php/channel/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/channel/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/dazzle-php/channel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/channel/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dazzle-php/channel/v/stable)](https://packagist.org/packages/dazzle-php/channel) 
[![Latest Unstable Version](https://poser.pugx.org/dazzle-php/channel/v/unstable)](https://packagist.org/packages/dazzle-php/channel) 
[![License](https://poser.pugx.org/dazzle-php/channel/license)](https://packagist.org/packages/dazzle-php/channel/license)

<br>
<p align="center">
<img src="https://avatars0.githubusercontent.com/u/29509136?v=3&s=150" />
</p>

## Description

Dazzle Channel is an event-based component that allows sending and receiving messsages asynchronously. It provides abstraction for various IPC models and is designed to be used in multi-threaded, multi-processed systems. It provides complex routing mechanisms, protocols, message encoders and extends behaviour of decorated IPC models by implementing hearbeat mechanisms, reconnect mechanisms and allowing usage of both async and request-reply messaging patterns.

## Feature Highlights

Dazzle sChannel features:

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

## Requirements

* PHP-5.6 or PHP-7.0+,
* UNIX or Windows OS.

## Installation

```
$> composer require dazzle-php/channel
```

## Tests

```
$> vendor/bin/phpunit -d memory_limit=1024M
```

## Contributing

Thank you for considering contributing to this repository! The contribution guide can be found in the [contribution tips][1].

## License

Dazzle Framework is open-sourced software licensed under the [MIT license][2].

[1]: https://github.com/dazzle-php/channel/blob/master/CONTRIBUTING.md
[2]: http://opensource.org/licenses/MIT
