# thatsup-php
A PHP wrapper for the Thatsup API.

## Installation

Install the library using Composer. Please read the [Composer Documentation](https://getcomposer.org/doc/01-basic-usage.md) if you are unfamiliar with Composer or dependency managers in general.

```json
"require": {
    "thatsup/thatsup-php": "~1.0"
}
```

## Example usage

Create a Thatsup instance and get place by id.

```php
$thatsup = new Thatsup($apiKey);
$place = $thatsup->get('/place', [ 'id' => $placeId ])->data();
```