# Laravel Google Analytics

[![Latest Version on Packagist](https://img.shields.io/packagist/v/backstage/laravel-google-analytics-v4.svg?style=flat-square)](https://packagist.org/packages/backstage/laravel-google-analytics-v4)
[![Tests](https://github.com/backstagephp/laravel-google-analytics-v4/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/backstagephp/laravel-google-analytics-v4/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/backstage/laravel-google-analytics-v4.svg?style=flat-square)](https://packagist.org/packages/backstage/laravel-google-analytics-v4)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/backstage/laravel-google-analytics-v4)](https://packagist.org/packages/backstage/laravel-google-analytics-v4)
[![PHPStan](https://github.com/backstagephp/laravel-google-analytics-v4/actions/workflows/phpstan.yml/badge.svg?branch=main)](https://github.com/backstagephp/laravel-google-analytics-v4/actions/workflows/phpstan.yml)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/backstagephp/laravel-google-analytics-v4)

## About Laravel Google Analytics v4

Retrieve all data like pageviews, events, ecommerce transactions and more from Google Analytics version 4 using the Google API.

## Installation

You can install the package via composer:

```bash
composer require backstage/laravel-google-analytics-v4
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="google-analytics-config"
```

This is the contents of the published config file:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Google Analytics ID
    |--------------------------------------------------------------------------
    |
    | The Google Analytics ID of the website you want to track.
    |
    */
    'property_id' => env('GOOGLE_ANALYTICS_PROPERTY_ID', null),

    /*
    |--------------------------------------------------------------------------
    | Google Analytics Client Secret
    |--------------------------------------------------------------------------
    |
    | The Google Analytics Client Secret of the website you want to track.
    |
    */
    'credentials' => env('GOOGLE_ANALYTICS_CREDENTIALS', storage_path('app/analytics/google-credentials.json')),
];
```

## Usage

First you need to create a service account in the Google Cloud Console. You can find the instructions here: https://developers.google.com/analytics/devguides/reporting/core/v4/quickstart/service-php.

After you have created the service account, you need to download the credentials and save them in the `storage/app/analytics` folder. You can change the location of the credentials in the config file if you want.

After you have done this, you can use the package like this:

```php
use Backstage\Analytics\Facades\Analytics;
use Backstage\Analytics\Period;

// Get the average session duration for the last 7 days:
$averageSessionDuration = Analytics::averageSessionDuration(Period::days(7));
```

### Available periods

```php
// Set the period to the last x minutes:
Period::minutes(30);

// Set the period to the last x hours:
Period::hours(1);

// Set the period to the last x days:
Period::days(2);

// Set the period to the last x weeks:
Period::weeks(3);

// Set the period to the last x months:
Period::months(4);

// Set the period to the last x years:
Period::years(5);

// Set the period to a custom date range using a Carbon object:
$startDate = Carbon::now()->subDays(7);
$endDate = Carbon::now();

Period::create($startDate, $endDate);

// Set the period to since the given date:
Period::since(Carbon::now()->subDays(7));
```

> **Note:** Using multiple Carbon objects in the `Period::create()` method may possibly result in unexpected behaviour. It is recommended to pass the start and end date as a separate Carbon instance. For example: `Period::create(Carbon::instance($startDate), Carbon::instance($endDate))`. This will ensure that the start and end date are set correctly.

## Available methods

### Demographic Analytics

Methods to retrieve demographic analytics data for your website or application. You can use these methods to get information such as the top used languages, total users by city or country and total users per gender. All of the methods take a Period object as a parameter to specify the time range for the analytics data.

Here are some examples of how to use the methods:

```php
use Backstage\Analytics\Facades\Analytics;
use Backstage\Analytics\Period;

// Get the top users by language for the last 7 weeks, limit to top 10:
$data = Analytics::topUsersByLanguage(period: Period::weeks(7), limit: 10);

// Get the total users by language for the last 7 weeks:
$data = Analytics::totalUsersByLanguage(Period::weeks(7));

// Get the top users by city for the last 7 weeks, limit to top 5:
$data = Analytics::topUsersByCity(period: Period::weeks(7), limit: 5);

// Get the total users by city for the last 7 weeks:
$data = Analytics::totalUsersByCity(Period::weeks(7));

// Get the top users by country for the last 7 weeks, limit to top 10:
$data = Analytics::topUsersByCountry(period: Period::weeks(7), limit: 10);

// Get the total users by country for the last 7 weeks:
$data = Analytics::totalUsersByCountry(Period::weeks(7));

// Get the total users by gender for the last 7 weeks:
$data = Analytics::totalUsersByGender(Period::weeks(7));

// Get the total users by age group for the last 7 weeks
$data = Analytics::totalUsersByAgeGroup(Period::weeks(7));

// Get the total users by date per page for the last 7 weeks:
$data = Analytics::totalUsersByDatePerPage(Period::weeks(7));
```

### Device and OS Analytics

Methods to retrieve device and operating system analytics data for your website or application. You can use these methods to get information such as the top popular browsers, screen resolutions, and mobile devices used by your visitors. All of the methods take a Period object as a parameter to specify the time range for the analytics data.

Here are some examples of how to use the methods:

```php
use Backstage\Analytics\Facades\Analytics;
use Backstage\Analytics\Period;

// Get the top users by device category for the last 1 year:
$data = Analytics::topUsersByDeviceCategory(Period::years(1));

// Get the top users by operating system for the last 1 year:
$data = Analytics::topUsersByOperatingSystem(Period::years(1));

// Get the top users by browser for the last 1 year, limit to top 10:
$data = Analytics::topUsersByBrowser(period: Period::years(1), limit: 10);

// Get the total users by browser for the last 1 year:
$data = Analytics::totalUsersByBrowser(Period::years(1));

// Get the top users by screen resolution for the last 1 year, limit to top 5:
$data = Analytics::topUsersByScreenResolution(period: Period::years(1), limit: 5);

// Get the total users by operating system for the last 1 year:
$data = Analytics::totalUsersByOperatingSystem(Period::years(1));

// Get the total users by device category for the last 1 year:
$data = Analytics::totalUsersByDeviceCategory(Period::years(1));

// Get the top users by mobile device branding for the last 1 year, limit to top 10:
$data = Analytics::topUsersByMobileDeviceBranding(period: Period::years(1), limit: 10);

// Get the total users by mobile device branding for the last 1 year:
$data = Analytics::totalUsersByMobileDeviceBranding(Period::years(1));

// Get the top users by mobile device model for the last 1 year, limit to top 10:
$data = Analytics::topUsersByMobileDeviceModel(period: Period::years(1), limit: 10);

// Get the total users by mobile device model for the last 1 year:
$data = Analytics::totalUsersByMobileDeviceModel(Period::years(1));

// Get the top users by mobile input selector for the last 1 year, limit to top 10:
$data = Analytics::topUsersByMobileInputSelector(period: Period::years(1), limit: 10);

// Get the total users by mobile input selector for the last 1 year:
$data = Analytics::totalUsersByMobileInputSelector(Period::years(1));

// Get the top users by mobile device info for the last 1 year, limit to top 10:
$data = Analytics::topUsersByMobileDeviceInfo(period: Period::years(1), limit: 10);

// Get the total users by mobile device info for the last 1 year:
$data = Analytics::totalUsersByMobileDeviceInfo(Period::years(1));

// Get the top users by mobile device marketing name for the last 1 year, limit to top 10:
$data = Analytics::getTopUsersByMobileDeviceMarketingName(period: Period::years(1), limit: 10);

// Get the total users by mobile device marketing name for the last 1 year:
$data = Analytics::getTotalUsersByMobileDeviceMarketingName(Period::years(1));
```

### Pageviews Analytics

Methods to retrieve pageview analytics data for your website or application. You can use these methods to get information such as the total views or by page from your visitors. All of the methods take a Period object as a parameter to specify the time range for the analytics data.

Here are some examples of how to use the methods:

```php
use Backstage\Analytics\Facades\Analytics;
use Backstage\Analytics\Period;

// Get the total pageviews for the last 14 days:
$data = Analytics::totalViews(Period::days(14));

// Get the total pageviews for the last 14 days, grouped by date:
$data = Analytics::totalViewsByDate(Period::days(14));

// Get the total pageviews for the last 14 days, grouped by page:
$data = Analytics::totalViewsByPage(Period::days(14));

// Get the top viewed pages for the last 14 days:
$data = Analytics::topViewsByPage(Period::days(14));

// Get the least viewed pages for the last 14 days:
$data = Analytics::leastViewsByPage(Period::days(14));

// Get the total views for the last 14 days, grouped by page path:
$data = Analytics::totalViewsByPagePath(Period::days(14));

// Get the top viewed pages for the last 14 days, grouped by page path:
$data = Analytics::topViewsByPagePath(Period::days(14));

// Get the total views for the last 14 days, grouped by page title:
$data = Analytics::totalViewsByPageTitle(Period::days(14));

// Get the top viewed pages for the last 14 days, grouped by page title:
$data = Analytics::topViewsByPageTitle(Period::days(14));

// Get the total views for the last 14 days, grouped by page url:
$data = Analytics::totalViewsByPageUrl(Period::days(14));

// Get the top viewed pages for the last 14 days, grouped by page url:
$data = Analytics::topViewsByPageUrl(Period::days(14));

// Get the total views for the last 14 days, grouped by country:
$data = Analytics::totalViewsByCountry(Period::days(14));

// Get the top viewed pages for the last 14 days, grouped by country:
$data = Analytics::topViewsByCountry(Period::days(14));

// Get the total views for the last 14 days, grouped by city:
$data = Analytics::totalViewsByCity(Period::days(14));

// Get the top viewed pages for the last 14 days, grouped by city:
$data = Analytics::topViewsByCity(Period::days(14));
```

### Realtime Analytics

Methods to retrieve realtime analytics data for your website or application. You can use these methods to get information such as the current active visitors on your website. All of the methods take a Period object as a parameter to specify the time range for the analytics data. The default time range is set to 30 minutes when no Period object is passed.

Here are some examples of how to use the methods:

```php
use Backstage\Analytics\Facades\Analytics;
use Backstage\Analytics\Period;

// Get the total active users for the last 30 minutes:
$data = Analytics::activeUsers();
```

### Resource Analytics

Methods to retrieve resource analytics data for your website or application. You can use these methods to get information such as the top landing pages, exit pages and referrers but also your most important social media

Here are some examples of how to use the methods:

```php
use Backstage\Analytics\Facades\Analytics;
use Backstage\Analytics\Period;

// Get the top 10 referrals for the last 14 days:
$data = Analytics::getTopReferrers(period: Period::days(14), limit: 10);

// Get the top 10 referrals for the last 14 days, by page path:
$data = Analytics::getTopReferrersByPagePath(period: Period::days(14), limit: 10);

// Get the top 10 referrals for the last 14 days, grouped by page title:
$data = Analytics::getTopReferrersByPageTitle(period: Period::days(14), limit: 10);

// Get the top 20 landing pages by page title for the last 14 days:
$data = Analytics::getTopLandingPagesByPageTitle(period: Period::days(14), limit: 20);

// Get the top 20 landing pages for the last 14 days:
$data = Analytics::getTopLandingPages(period: Period::days(14), limit: 20);

// Get the top 20 landing pages with query string by page title for the last 14 days, grouped by page title:
$data = Analytics::getLandingPagesPlusQueryStringAByPageTitle(period: Period::days(14), limit: 20);

// Get the top 5 traffic sources for the last 14 days:
$data = Analytics::getTopTrafficSources(period: Period::days(14), limit: 5);

// Get the top 10 backlinks for the last 14 days:
$data = Analytics::getTopBacklinks(period: Period::days(14), limit: 10);
```

### Sessions Analytics

Methods to retrieve session duration analytics data for your website or application. You can use these methods to get information such as the average session time from your visitors. All of the methods take a Period object as a parameter to specify the time range for the analytics data.

Here are some examples of how to use the methods:

```php
use Backstage\Analytics\Facades\Analytics;
use Backstage\Analytics\Period;

// Get total sessions for the last 7 days:
$data = Analytics::sessions(Period::days(7));

// Get total sessions for the last 7 days per page:
$data = Analytics::sessionsPerPage(Period::days(7));

// Get the average session duration for the last 7 days:
$data = Analytics::averageSessionDuration(Period::days(7));

// Get the average session duration for the last 7 days, grouped by date:
$data = Analytics::averageSessionDurationByDate(Period::days(7));

// Get the average session duration in seconds for the last 7 days, grouped by page:
$data = Analytics::averageSessionDurationInSecondsByPage(Period::days(7));

// Get the average page views per session for the last 7 days:
$data = Analytics::averagePageViewsPerSession(Period::days(7));

// Get the average page views per session for the last 7 days, grouped by date:
$data = Analytics::averagePageViewsPerSessionByDate(Period::days(7));

// Get the average session duration in seconds for the last 7 days:
$data = Analytics::averageSessionDurationInSeconds(Period::days(7));

// Get the average session duration in seconds for the last 7 days, grouped by date:
$data = Analytics::averageSessionDurationInSecondsByDate(Period::days(7));

// Get bounce rate for the last 7 days:
$data = Analytics::bounceRate(Period::days(7));

// Get bounce rate for the last 7 days, grouped by date:
$data = Analytics::bounceRateByDate(Period::days(7));

// Get bounce rate by page for the last 7 days:
$data = Analytics::bounceRateByPage(Period::days(7));
```

### Users Analytics

Methods to retrieve user analytics data for your website or application. You can use these methods to get information such as the total visitors or amount of visitors per device. All of the methods take a Period object as a parameter to specify the time range for the analytics data.

Here are some examples of how to use the methods:

```php
use Backstage\Analytics\Facades\Analytics;
use Backstage\Analytics\Period;

// Get the total users for the last 5 weeks:
$data = Analytics::totalUsers(Period::weeks(5));

// Get the total users for the last 5 weeks, grouped by date:
$data = Analytics::totalUsersByDate(Period::weeks(5));

// Get the total users for the last 5 weeks, grouped by session source:
$data = Analytics::totalUsersBySessionSource(Period::weeks(5));

// Get the total users for the last 5 weeks, grouped by session medium:
$data = Analytics::totalUsersBySessionMedium(Period::weeks(5));

// Get the total users for the last 5 weeks, grouped by session device:
$data = Analytics::totalUsersBySessionDevice(Period::weeks(5));
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Bas van Dinther](https://github.com/backstagephp)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
