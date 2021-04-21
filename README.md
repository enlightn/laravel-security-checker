# Enlightn Security Checker for Laravel

![tests](https://github.com/enlightn/laravel-security-checker/workflows/Tests/badge.svg?branch=main)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Stable Version](https://poser.pugx.org/enlightn/laravel-security-checker/v/stable?format=flat-square)](https://packagist.org/packages/enlightn/laravel-security-checker)

This package includes an Artisan command that checks if your application uses dependencies with known security vulnerabilities. It is a wrapper around the [Enlightn Security Checker](https://github.com/enlightn/security-checker).

## Installation

You may use Composer to install the package on your Laravel application:

```bash
composer require --dev enlightn/laravel-security-checker
```

## Usage

To check for security vulnerabilities in your dependencies, you may run the `security:check` Artisan command: 

```bash
php artisan security:check
```

![sec-checker](https://user-images.githubusercontent.com/16099046/115501322-a4466800-a290-11eb-9242-ba1ac41912a0.png)


## Options & Arguments

### Composer Lock File

You may specify a custom location for your `composer.lock` file, using the optional argument:

```bash
php artisan security:check /path/to/composer.lock
```

### Format

By default, this command displays the result in ANSI. You may use the `--format` option to display the result in JSON instead:

```bash
php artisan security:check --format=json
```

### Exclude Dev Dependencies

If you would like to exclude dev dependencies from the vulnerabilities scanning, you may use the `--no-dev` option (defaults to false):

```bash
php artisan security:check --no-dev
```

### Custom Directory for Caching Advisories Database

By default, the `security:check` command uses the directory returned by the `sys_get_temp_dir` PHP function for storing the cached advisories database. If you wish to modify the directory, you may use the `--temp-dir` option:

```bash
php artisan security:check --temp-dir=/tmp
```

## Contribution Guide

Thank you for considering contributing to the Enlightn security checker project! The contribution guide can be found [here](https://www.laravel-enlightn.com/docs/getting-started/contribution-guide.html).

## License

The Enlightn security checker for Laravel is licensed under the [MIT license](LICENSE.md).
