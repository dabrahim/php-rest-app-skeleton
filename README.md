# PHP RESTFul App skeleton

The goal of this project is to provide a _simple and easy to use_ framework to facilitate RESTFul app development with PHP.
In a nutshell, it's a set of libraries gathered together to create a simple framework based on the MVC pattern. It uses [Klein](https://github.com/klein/klein.php) library as it's internal router and also integrates a bunch of features such as [jwt](https://jwt.io/) management.

## Getting started
1. PHP 5.3.x is required
2. [composer](https://getcomposer.org/download/) is required
3. Change to your working directory and run `git clone https://github.com/dabrahim/php-rest-app-skeleton.git your-project-name`
4. Change to __your-project-name__ and run `composer install` to download all the required dependencies of the project


## Basic configurations
Before you start using this framework, you should edit the configuration file under **_/core/config.php_**
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
The `SECTION` constant allows you to list the different _sections_ of your application, each of which representing the upper _level_ or _block_ of an endpoint (or route).
When you add a new section, the framework automatically generates the controller file under **_/controllers_** folder and names it **_your-section-name.php_**. By convention, all your controllers should be named the same as your section otherwise they'll be ignored.

The default content of a controller looks like this
```php
$this->respond('[*]?', function ($request, $response) {
   return 'This is the default controller';
});
```

As mentioned ealier, the framework uses [Klein](https://github.com/klein/klein.php) as it's internal router so we highly recommend to go and check their documentation to get a basic understanding of how the routing is done.
Basically what the sample code above does is returning **_this is the default controller_** to every request to the **/users** endpoint regardless of what follows (e.g **/users/login**, **/users/some/path**, etc.).


The `BASE_DIR` constant is used to indicate the path to your project directory if it's not located into the root folder served by default by your web server. If for example your project is under **_/somefolder/anotherfolder_** then that would write that as your _BASE_DIR_ value.
If the project is ready to be deployed, then leave it to an empty string.


The `DEBUG` constant which is true by default tells to the framework whether you're in development mode or in deployment mode. It prevents from returning sensitive error messages to the API client. Once in production mode, leave it to false.


The `LOG_REQUESTS` tells to the framework if the received requests should be logged to the database (if it's correctly set up) or not. It defaults to true and automatically creates the needed table into the database.


The `DATABASE_CONFIG` constant is an associative array which holds the database configuration. You should provide all the required information if you want to connect a database to your application. 
The framework uses PDO API for database access. To get an instance of it, just call **CustomPDO::getInstance()** from any controller.


Finally, the `SIGNATURE_KEY` constant holds the secret key that'll be used to sign your **JSON Web Tokens**. Choose a strong one and keep it secret.

## Persistence management
The framework has no [_ORM tool_](https://www.tutorialspoint.com/design_pattern/data_access_object_pattern.htm) yet so it uses the **DAO/DTO** pattern to handle persistence. The following explains how to organize your persistence layer, we assume that you already have a basic understanding of [this](https://www.tutorialspoint.com/design_pattern/data_access_object_pattern.htm) pattern otherwise we recommend you to learn more about it before using this framework.

To create and persist objects of your model, you should follow a set of simple rules :

1. Every PHP class should end with **.class.php**
2. All your model objects (DTO) should be under **/persistence/model** directory
3. Your DAO objects should go under **/persistence/interface** and end with _DAO_
4. Your DAO implementations should go under **/persistence/service** and end with _Service_

### Example
_User.class.php_
```php
class User {
    private $_nom;
    
    public function getNom () {
        return $this->_nom;
    }
    
    public function setNom ($nom) {
        $this->_nom = $nom;
    }
}
```

_UserDAO.class.php_
```php
interface UserDAO {
    public function create (User $user);
}
```

_UserService.class.php_
```php
class UserService implements UserDAO {
    public function create (User $user) {
        // Method implementation
    }
}
```

Then, you can for instantiate the `User` class from any controller. The framework automatically handles the imports so you won't have to do it manually.

## Contribution
The project is still under development so feel free to send a fork request for adding new features.
