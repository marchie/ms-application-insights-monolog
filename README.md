Microsoft Application Insights for Monolog
==========================================

Monolog Handler connection to [Microsoft Application Insights](http://azure.microsoft.com/en-gb/services/application-insights/)

Installation
------------
Via Composer:
Add the following to your composer.json:
```js
  "require": {
        "marchie/ms-application-insights-monolog": "dev-master"
    }
```

Usage
-----

A handler is provided that wraps up a Microsoft Application Insights Telemetry client. By default the handler will grab anything at
Logger::ERROR and above and send it to Microsoft Application Insights.

```php

$logger  = new Monolog\Logger("Example");

$telemetryClient = new \ApplicationInsights\Telemetry_Client();
$telemetryClient->getContext()->setInstrumentationKey('YOUR INSTRUMENTATION KEY');

$msApplicationInsightsHandler = new \Marchie\MSApplicationInsightsMonolog\MSApplicationInsightsHandler($telemetryClient);

$logger->pushHandler($msApplicationInsightsHandler);

// The following error will get sent automatically to Microsoft Application Insights
$logger->addError("oh no!", array('exception' => new \Exception("ohnoception")));

```

Credits
-------
This package is based on the [MonoSnag](https://github.com/meadsteve/MonoSnag) package.  Thanks to Steve Brazier and other contributors to that package.

The package also relies on Microsoft's [ApplicationInsights-PHP](https://github.com/Microsoft/ApplicationInsights-PHP) package.