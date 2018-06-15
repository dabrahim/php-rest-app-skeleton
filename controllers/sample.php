<?php

/**
 * Is the example we show how yo make use of the
 * jwt integrated tool of this mini framework to
 * generate a jwt signed token.
 *
 * Please note that this is just a sample demo,
 * never use this method to authenticate your users.
 * Refer to login guidelines and best practices to see
 * how to authenticate properly your users
 *
 * You can try this example by sending a simple HTTP request
 * to hostname/sample/login with two body parameters named 'login' & 'password'
 *
 * The correct values are respectively 'guest' and 'secret'
 *
 * DON'T FORGET TO UPDATE THE SIGNATURE_KEY in /core/config.php file
 */

$this->respond('POST', '/login', function ($request, $response, \Klein\ServiceProvider $service) {
    $result = array(
      'success' => false
    );

    extract( $request->params() );

    if ( isset($login) && isset($password) ){
        if($login === 'guest' && $password === 'secret') {
            $result['success'] = true;

            $payload = array(
              'login' => $login,
              'role' => 'simple-user'
            );

            $result['token'] = $service->generateToken( $payload );
        } else {
            $result['message'] = "Login or password incorrect";
        }
    } else {
        $result['message'] = "login and password mandatory";
    }

    $response->json( $result );
});