<?php
namespace Marchie\MSApplicationInsightsMonolog;

use ApplicationInsights\Telemetry_Client;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class MSApplicationInsightsHandler extends AbstractProcessingHandler
{

    /**
     * @var Telemetry_Client
     */
    protected $client;

    public function __construct(Telemetry_Client $client, $level = Logger::ERROR, $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->client = $client;
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     *
     * @return void
     */
    protected function write(array $record)
    {
        if (isset($record['context']['exception'])) {
            $this->client->trackException($record['context']['exception'], $record);
        }
        else {
            $this->client->trackMessage((string) $record['message'], $record);
        }

        $this->client->flush();
    }}