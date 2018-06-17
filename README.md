# PHP RestFul App skeleton

The goal of this project is to build a _simple and easy to use_ framework that'd facilitate RESFul app building with PHP.
Basically, it's just a set of libraries gathered to create a simple framework based on the MVC pattern. It uses [Klein](https://github.com/klein/klein.php) library as it's internal router and also integrates a bunch of features such as [jwt](https://jwt.io/) management.

## Getting started
1. PHP 5.3.x is required
2. [composer](https://getcomposer.org/download/) is required
3. Change to your working directory and run `git clone https://github.com/dabrahim/php-rest-app-skeleton.git your-project-name`
4. Change to __your-project-name__ and run `composer install` to download all the required depencies of the project


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
The `SECTION` constant lists the __sections__ of your application, each of which representing the upper _level_ or _block_ of an endpoint (e.g given the **_/users/5/edit_** endpoint, **_users_** would represent one section of your application).
When you add a new section (e.g admin), the framework automatically generates the controller file under **_/controllers/_** folder named _your-section-name.php_. By convention, all your controllers should be named the same as your section otherwise they'll be ignored.

The default content of a controller looks like this
```php
$this->respond('[*]?', function ($request, $response) {
   return 'This is the default controller';
});
```

As mentioned ealier, the framework uses [Klein](https://github.com/klein/klein.php) as it's internal controller. Fell free to check their documentation for more detailled informations.
Basically what it says it to return _this is the default controller_ to every request to the given endpoint.


The `BASE_DIR` constant is used to indicate the path to your project directory if it's not located into the root folder (which is served by default by the server). If for example your project is under **_/somefolder/anotherfolder_** then that would be your _BASE_DIR_ value.
Is the project is ready to be deployed, then leave it's value to an empty string.


The `DEBUG` constant which is by default true tells to the framework wether you're in developpement mode or in deployement mode. It prevents from giving sensitive informations to the user when the API is deployed.


The `LOG_REQUESTS` indicates wether all the received requests should be logged to the database (if it's correctly set up) or not. It defaults to true and automatically creates the required tables into the database.


The `DATABASE_CONFIG` indicates the database configuration. You should provide all the required informations if you want to connect a database to your application. 
The framework uses PDO as it's API for database access. To get an instance of it, just call **CustomPDO::getInstance()** from any controller.


Finally, the `SIGNATURE_KEY` constant represents the secret key used to sign your **JSON Web Tokens**. Choose a strong one and keep it secret.

## Persistency management
The framework has no _ORM tool_ yet so it uses **DAO/DTO** pattern to handle persistency. The following explains how to organize your persistence layer, we asume that you already have a basic understanding of the pattern mentionned earlier otherwise we recommand you to learn more about it before using this framework.

To create and persist objects of your model, you should follow a set of simple rules :

1. Every PHP class should end with .class.php
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
        // Class implementation
    }
}
```

Then, you can for instanciate the `User` class from any controller. The framework automatically handles the imports so you won't have to do it manually anymore.

## Examples
Let's consider this controller under the **users** section
```php
$this->respond('POST', '/login', function ($request, $response, $service) {
    $result = array(
      'success' => false
    );

    extract( $request->params() );

    if ( isset($login) && isset($password) ){
        if($login === 'guest' && $password === 'secret') {
            $result['success'] = true;

            /**
            * Setting up the payload
            */
            $payload = array(
              'login' => $login,
              'role' => 'simple-user'
            );

            /**
            * Generating the signed token
            */
            $result['token'] = $service->generateToken( $payload );
        } else {
            $result['message'] = "Login or password incorrect";
        }
    } else {
        $result['message'] = "login and password mandatory";
    }

    $response->json( $result );
});
```
A bad request to **your-hostname/users/login** would give
```json
{
    "success": false,
    "message": "Login or password incorrect"
}
```

## Contribution
The project is still under developpement so feel free to send a fork request for adding new features.
