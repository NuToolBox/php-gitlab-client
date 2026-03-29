# php-gitlab-client

A modern, type-safe PHP client for the GitLab REST API built on PSR standards.

## Features

- PSR-18 HTTP client support
- Type-safe DTOs instead of raw arrays
- Clean and predictable API design
- Strong error handling with domain-specific exceptions
- Designed for extensibility and long-term maintainability

## Installation

```bash
composer require nutoolbox/php-gitlab-client
```

## Usage

```php
use NuToolbox\Gitlab\Client;
use NuToolbox\Gitlab\Auth\GitlabCredentials;

$client = Client::create(
    new GitlabCredentials(
        baseUrl: 'https://gitlab.example.com',
        token: 'your-token'
    )
);

$projects = $client->projects()->list();

foreach ($projects as $project) {
    echo $project->pathWithNamespace . PHP_EOL;
}
```

## Requirements

* PHP 8.3+
* PSR-18 compatible HTTP client

## Philosophy

This library focuses on:

* strict typing over loosely structured arrays
* clear abstractions over API mirroring
* long-term maintainability over quick wrappers

## License

Apache License 2.0
