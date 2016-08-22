<?php

namespace Kraken\Channel;

use Kraken\Channel\Request\Request;
use Kraken\Event\EventEmitterInterface;
use Kraken\Event\EventHandler;
use Kraken\Loop\LoopAwareInterface;
use Kraken\Throwable\Exception\Logic\Resource\ResourceUndefinedException;

/**
 * @event start : callable()
 * @event stop  : callable()
 * @event connect    : callable(string)
 * @event disconnect : callable(string)
 * @event input  : callable(string, ChannelProtocolInterface)
 * @event output : callalbe(string, ChannelProtocolInterface)
 */
interface ChannelBaseInterface extends EventEmitterInterface, LoopAwareInterface
{
    /**
     * Return Channel name.
     *
     * @return string
     */
    public function name();

    /**
     * Return model which is being used by Channel.
     *
     * @return ChannelModelInterface|null
     */
    public function model();

    /**
     * Return router which is being used by Channel.
     *
     * @return ChannelRouterCompositeInterface
     */
    public function router();

    /**
     * Return router used for input messages.
     *
     * Throws ResourceUndefinedException if input router is not found.
     *
     * @return ChannelRouterBaseInterface|ChannelRouterCompositeInterface
     * @throws ResourceUndefinedException
     */
    public function input();

    /**
     * Return router used for output messages.
     *
     * Throws ResourceUndefinedException if output router is not found.
     *
     * @return ChannelRouterBaseInterface|ChannelRouterCompositeInterface
     * @throws ResourceUndefinedException
     */
    public function output();

    /**
     * Put message into newly created protocol and return its wrapper.
     *
     * @param string|string[]|null $message
     * @return ChannelProtocolInterface
     */
    public function createProtocol($message = null);

    /**
     * Attach start event handler.
     *
     * @handle start
     * @param callable $handler
     * @return EventHandler
     */
    public function onStart(callable $handler);

    /**
     * Attach stop event handler.
     *
     * @handle stop
     * @param callable $handler
     * @return EventHandler
     */
    public function onStop(callable $handler);

    /**
     * Attach connect event handler.
     *
     * @handle connect
     * @param callable $handler
     * @return EventHandler
     */
    public function onConnect(callable $handler);

    /**
     * Attach disconnect event handler.
     *
     * @handle disconnect
     * @param callable $handler
     * @return EventHandler
     */
    public function onDisconnect(callable $handler);

    /**
     * Attach input event handler.
     *
     * @handle receive
     * @param callable $handler
     * @return EventHandler
     */
    public function onInput(callable $handler);

    /**
     * Attach output event handler.
     *
     * @handle send
     * @param callable $handler
     * @return EventHandler
     */
    public function onOutput(callable $handler);

    /**
     * Start channel.
     */
    public function start();

    /**
     * Stop channel.
     */
    public function stop();

    /**
     * Send one or multiple messages to one or more receivers.
     *
     * In comparison to push() method, this one sends messages first to output router that decides how to handle them.
     *
     * This method will send multiple messages separately. If any of the callback handlers are set, then message(s) will
     * be treated as Request(s) and Channel will asynchronously await response(s). On the other hand, if none are set,
     * then message(s) will be send without creating handler making the process faster and better memory-optimized.
     * However, in that case Channel will not be able to process any returned values.
     *
     * Timeout works only for requests and represents number of seconds after which handler will automatically cancel.
     *
     * Flags might be one of:
     * Channel::MODE_STANDARD - sends message if both sender and receiver are online.
     * Channel::MODE_BUFFER_OFFLINE - works in similar way as MODE_STANDARD, but also enables buffering messages in case
     * that sender is offline.
     * Channel::MODE_BUFFER_ONLINE - works in similar way as MODE_STANDARD, but also enables buffering messages in case
     * that receiver is offline.
     * Channel::MODE_BUFFER - sends message if both sender and receiver are online or buffers it if one of them is
     * offline.
     *
     * @see ChannelBaseInterface::sendAsync
     * @see ChannelBaseInterface::sendRequest
     *
     * @param string|string[] $name
     * @param string|string[]|ChannelProtocolInterface $message
     * @param int $flags
     * @param callable|null $success
     * @param callable|null $failure
     * @param callable|null $cancel
     * @param float $timeout
     * @return mixed|mixed[]
     */
    public function send($name, $message, $flags = Channel::MODE_DEFAULT, callable $success = null, callable $failure = null, callable $cancel = null, $timeout = 0.0);

    /**
     * Push one or multiple messages to one or more receivers.
     *
     * In comparison to send() method skips routing mechanisms and tries to push message directly to receiver, therefore
     * this method should be used with caution.
     *
     * This method will push multiple messages separately. If any of the callback handlers are set, then message(s) will
     * be treated as Request(s) and Channel will asynchronously await response(s). On the other hand, if none are set,
     * then message(s) will be send without creating handler making the process faster and better memory-optimized.
     * However, in that case Channel will not be able to process any returned values.
     *
     * Timeout works only for requests and represents number of seconds after which handler will automatically cancel.
     *
     * Flags might be one of:
     * Channel::MODE_STANDARD - sends message if both sender and receiver are online.
     * Channel::MODE_BUFFER_OFFLINE - works in similar way as MODE_STANDARD, but also enables buffering messages in case
     * that sender is offline.
     * Channel::MODE_BUFFER_ONLINE - works in similar way as MODE_STANDARD, but also enables buffering messages in case
     * that receiver is offline.
     * Channel::MODE_BUFFER - sends message if both sender and receiver are online or buffers it if one of them is
     * offline.
     *
     * @param string|string[] $name
     * @param string|string[]|ChannelProtocolInterface $message
     * @param int $flags
     * @param callable|null $success
     * @param callable|null $failure
     * @param callable|null $cancel
     * @param float $timeout
     * @return Request|Request[]|null|null[]|bool|bool[]
     */
    public function push($name, $message, $flags = Channel::MODE_DEFAULT, callable $success = null, callable $failure = null, callable $cancel = null, $timeout = 0.0);

    /**
     * Send one or multiple asynchronous messages to one or more receivers.
     *
     * This method only enables sending asynchronous messages. For more complex options use send() method.
     *
     * @see ChannelBaseInterface::send
     *
     * @param string|string[] $name
     * @param string|string[]|ChannelProtocolInterface $message
     * @param int $flags
     * @return bool|bool[]
     */
    public function sendAsync($name, $message, $flags = Channel::MODE_DEFAULT);

    /**
     * Push one or multiple asynchronous messages to one or more receivers.
     *
     * This method only enables pushing asynchronous messages. For more complex options use push() method.
     *
     * @see ChannelBaseInterface::push
     *
     * @param string|string[] $name
     * @param string|string[]|ChannelProtocolInterface $message
     * @param int $flags
     * @return bool|bool[]
     */
    public function pushAsync($name, $message, $flags = Channel::MODE_DEFAULT);

    /**
     * Send one or multiple requests to one or more receivers.
     *
     * This method only enables sending requests. For more complex options use send() method.
     *
     * @see ChannelBaseInterface::send
     *
     * @param string|string[] $name
     * @param string|string[]|ChannelProtocolInterface $message
     * @param int $flags
     * @param callable|null $success
     * @param callable|null $failure
     * @param callable|null $cancel
     * @param float $timeout
     * @return bool|bool[]
     */
    public function sendRequest($name, $message, $flags = Channel::MODE_DEFAULT, callable $success = null, callable $failure = null, callable $cancel = null, $timeout = 0.0);

    /**
     * Push one or multiple requests to one or more receivers.
     *
     * This method only enables pushing requests. For more complex options use push() method.
     *
     * @see ChannelBaseInterface::push
     *
     * @param string|string[] $name
     * @param string|string[]|ChannelProtocolInterface $message
     * @param int $flags
     * @param callable|null $success
     * @param callable|null $failure
     * @param callable|null $cancel
     * @param float $timeout
     * @return Request|Request[]|null|null[]
     */
    public function pushRequest($name, $message, $flags = Channel::MODE_DEFAULT, callable $success = null, callable $failure = null, callable $cancel = null, $timeout = 0.0);

    /**
     * Receive message from sender.
     *
     * This method uses Channel input router to validate the message and then process or do something else with it
     * depending on router rules.
     *
     * @param string $sender
     * @param ChannelProtocolInterface $protocol
     */
    public function receive($sender, ChannelProtocolInterface $protocol);

    /**
     * Pull message from sender.
     *
     * This method pulls message immediataly processing it without router usage.
     *
     * @param string $sender
     * @param ChannelProtocolInterface $protocol
     */
    public function pull($sender, ChannelProtocolInterface $protocol);

    /**
     * Check if channel is started.
     *
     * @return bool|bool[]
     */
    public function isStarted();

    /**
     * Check if channel is stopped.
     *
     * @return bool|bool[]
     */
    public function isStopped();

    /**
     * Check if specific external channel is connected.
     *
     * @param string|string[] $name
     * @return bool|bool[]
     */
    public function isConnected($name);

    /**
     * Return array of all connected external channels' IDs.
     *
     * @return string[]
     */
    public function getConnected();

    /**
     * Return array of all connected channels' IDs that matches pattern
     *
     * @param string|string[] $pattern
     * @return string[]
     */
    public function filterConnected($pattern);
}
