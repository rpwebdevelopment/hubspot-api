
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# Package designed to allow easy Laravel integrationwith Hupspot API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rpwebdevelopment/hubspot-api.svg?style=flat-square)](https://packagist.org/packages/rpwebdevelopment/hubspot-api)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rpwebdevelopment/hubspot-api/run-tests?label=tests)](https://github.com/rpwebdevelopment/hubspot-api/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/rpwebdevelopment/hubspot-api/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/rpwebdevelopment/hubspot-api/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rpwebdevelopment/hubspot-api.svg?style=flat-square)](https://packagist.org/packages/rpwebdevelopment/hubspot-api)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/hubspot-api.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/hubspot-api)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require rpwebdevelopment/hubspot-api
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="hubspot-api-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="hubspot-api-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="hubspot-api-views"
```

## Usage

```php
$hubspotApi = new RpWebDevelopment\HubspotApi();
echo $hubspotApi->echoPhrase('Hello, RpWebDevelopment!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/rpwebdevelopment/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rich Porter](https://github.com/rpwebdevelopment)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
