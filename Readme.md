# php-gitlab-client

A modern, strictly typed PHP client for the GitLab REST API built on PSR standards.

## Why this library?

Most existing GitLab clients rely heavily on loosely structured arrays and mirror the API 1:1.
This project takes a different approach:

* **Typed DTOs instead of raw arrays**
* **Resource-based API for better developer experience**
* **PSR-18 compatible HTTP layer**
* **Explicit authentication strategies**
* **Focused on maintainability and testability**

---

## Key Concept: Resource-Based API

Instead of working with raw arrays or deeply nested API calls, this client introduces **resource objects**.

You can start with a project and continue working within its context:

```php
$project = $client->projects()->get('nusphere/nuclub');

$branches = $project->branches()->list();
$commits = $project->commits()->list();
$file = $project->files()->getRaw('composer.json', 'main');
```

This allows a more natural and expressive workflow compared to traditional API clients.

---

## Features

* Supports multiple authentication strategies:

  * Private Token
  * Bearer Token
  * Job Token
  * Sudo (as decorator)

* Clean separation of concerns:

  * HTTP layer
  * API modules
  * DTOs
  * Resource objects

* Strong typing:

  * `ProjectResource`, `ProjectDetails`, etc.
  * No raw array handling required

* Strong error handling via domain-specific exceptions

* Designed for testing:

  * Mockable HTTP client (PSR-18)
  * Fixture-based testing

---

## Installation

```bash
composer require nutoolbox/php-gitlab-client
```

---

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
    echo $project->details()->pathWithNamespace . PHP_EOL;
}
```

---

### Working with Project Resources

```php
$project = $client->projects()->get('nusphere/nuclub');

// Access project details
echo $project->details()->name;

// Work with related resources
$branches = $project->branches()->list();
$commits = $project->commits()->list();

// Access repository files
$content = $project->files()->getRaw('composer.json', 'main');
```

---

### Direct API Access (Alternative)

You can still use the flat API if preferred:

```php
$branches = $client->branches()->list('nusphere/nuclub');
$file = $client->repositoryFiles()->getRaw('nusphere/nuclub', 'composer.json', 'main');
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

Example:

```php
$mockHttpClient = new MockHttpClient($response);
```

Integration tests can use environment variables:

```bash
GITLAB_BASE_URL=https://gitlab.example.com
GITLAB_TOKEN=glpat-xxxxxxxx
```

Example integration test usage:

---

## Requirements

* PHP 8.1+
* PSR-18 compatible HTTP client

---

## Philosophy

This library focuses on:

* strict typing over loosely structured data
* explicit behavior over magic
* resource-oriented design over endpoint mirroring
* small, composable building blocks
* long-term maintainability over quick wrappers

---

## License

Apache License 2.0
