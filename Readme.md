# php-gitlab-client

A modern, strictly typed PHP client for the GitLab REST API built on PSR standards.

## Why this library?

Most existing GitLab clients rely heavily on loosely structured arrays and mirror the API 1:1.
This project takes a different approach:

* **Typed DTOs instead of raw arrays**
* **Clear and predictable API design**
* **PSR-18 compatible HTTP layer**
* **Explicit authentication strategies**
* **Focused on developer experience and maintainability**

## Features

* Supports multiple authentication strategies:

    * Private Token
    * Bearer Token
    * Job Token
    * Sudo (as decorator)
* Clean separation of concerns (HTTP, API, DTO, Auth)
* Strong error handling via domain-specific exceptions
* Designed for testing (mockable HTTP client, fixture-based testing)

## Installation

```bash
composer require nutoolbox/php-gitlab-client
```

## Usage

### Basic Example

```php
use NuToolbox\Gitlab\Client;
use NuToolbox\Gitlab\Auth\GitlabAuthentication;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Component\HttpClient\Psr18Client;

$client = new Client(
    psrHttpClient: new Psr18Client(),
    requestFactory: new Psr17Factory(),
    authentication: GitlabAuthentication::privateToken('glpat-xxxxxxxx'),
    baseUrl: 'https://gitlab.example.com',
);

$projects = $client->projects()->list();

foreach ($projects as $project) {
    echo $project->pathWithNamespace . PHP_EOL;
}
```

---

### Authentication

```php
GitlabAuthentication::privateToken('glpat-...');
GitlabAuthentication::bearer('token');
GitlabAuthentication::jobToken('token');

GitlabAuthentication::sudo(
    GitlabAuthentication::privateToken('admin-token'),
    'root'
);
```

---

## Testing

This library is designed to be testable.

* HTTP layer is fully mockable (PSR-18)
* Supports fixture-based testing
* No real API calls required for unit tests

Example test approach:

```php
$mockHttpClient = new MockHttpClient($response);
```

For integration tests, environment variables can be used:

```bash
GITLAB_BASE_URL=https://gitlab.example.com
GITLAB_TOKEN=glpat-xxxxxxxx
```

---

## Requirements

* PHP 8.1+
* PSR-18 compatible HTTP client

---

## Philosophy

This library focuses on:

* strict typing over loosely structured data
* explicit behavior over magic
* small, composable building blocks
* long-term maintainability over quick wrappers

---

## License

Apache License 2.0
