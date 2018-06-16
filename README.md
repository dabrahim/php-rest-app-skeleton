# PHP RestFul App skeleton

The goal of this project is to build a _simple and easy to use_ framework that'd facilitate RESFul app building with PHP.
It uses [Klein](https://github.com/klein/klein.php) library as it's internal router and also integrates a bunch of features such as [jwt](https://jwt.io/) management.  

## Getting started
1. PHP 5.3.x is required
2. [composer](https://getcomposer.org/download/) is required
3. cd to your working directory and run `git clone https://github.com/dabrahim/php-rest-app-skeleton.git your-project-name`
4. cd to your-project-name and run `composer install` to download all the required depencies of the project


## Basic configurations
Before you start using this framework, you sould edit the configuration file under /core/config.php
With all the comments removed, the default content looks like this : 
```php
const SECTIONS = array(
    'sample'
);

const BASE_DIR = 'rest-app-skeleton/';

const DEBUG = true;

const LOG_REQUESTS = true;

const DATABASE_CONFIG = array(
    'SGBD' => 'mysql',
    'HOST' => 'localhost',
    'DATABASE' => '',
    'USER' => '',
    'PASSWORD' => ''
);

const SIGNATURE_KEY = "Put a strong key here";

```
The `SECTION` constant lists the __sections__ of your application, each one representing the upper level of each endpoint e.g given the **_/users/5/edit_** endpoint, **_users_** would represent one section of your application.
When you add a new section (e.g admin), the framework automatically generates the controller file under **_/controllers/_** folder named _your-section-name.php_. By convention, all your controllers should be named the same as your section otherwise they'll be ignored.

The default content of a controller looks like this
```php
$this->respond('[*]?', function ($request, $response) {
   return 'This is the default controller';
});
```

As mentioned ealier, the framework uses [Klein](https://github.com/klein/klein.php) as it's internal controller. Fell free to check their documentation for detailled informations.


