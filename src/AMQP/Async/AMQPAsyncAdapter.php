<?php

namespace Infra\AMQP\Async;

use Domain\Async\AsyncAdapter;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class AMQPAsyncAdapter
 */
final class AMQPAsyncAdapter implements AsyncAdapter
{
    /**
     * @var AMQPChannel
     */
    private $channel;

    /**
     * @var string
     */
    private $queueName;

    /**
     * AMQPAsyncAdapter constructor.
     *
     * @param AMQPChannel $channel
     * @param string $queueName
     */
    public function __construct(
        AMQPChannel $channel,
        string $queueName
    )
    {
        $this->channel = $channel;
        $this->queueName = $queueName;
    }

    /**
     * Create queue
     */
    public function createQueue() : void
    {
        $this
            ->channel
            ->queue_declare($this->queueName, false, true);
    }

    /**
     * @inheritDoc
     */
    public function enqueueCommand($command): void
    {
        $properties = array(
            'content_type' => 'text/plain',
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
        );

        $message = new AMQPMessage(serialize($command), $properties);
        $this->channel->basic_publish($message, '', $this->queueName);
    }

    /**
     * Consume command
     *
     * @param Callback $callback
     */
    public function consumeCommand($callback)
    {
        $channel = $this->channel;
        $channel->basic_qos(0, 1, true);
        $channel->basic_consume($this->queueName, '', false, true, false, false, function(AMQPMessage $message) use ($callback) {
            $command = unserialize($message->body);
            $callback($command);
        });

        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}