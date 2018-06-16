<?php

/**
 * Here goes the list of your app's 'sections'
 *
 * Let's consider for example the /users/5 endpoint
 * /user would be the section and 5 the action or an argument
 *
 * Example :
 * const SECTIONS = array(
 *  'users',
 *  'products'
 *  );
 * */
const SECTIONS = array(
    'sample'
);

/**
 * This one is useful when you're working locally
 * and your project's root folder is different from
 * the server's one. You would add the path to your
 * directory below
 *
 * Example :
 * Let's say your project is located in in C:/wamp64/www/myproject
 * Whereas server root directory is C:wamp64/www then you would have
 * const BASE_DIR = myproject/
 */
const BASE_DIR = 'rest-app-skeleton/';

/**
 * Not used yet but will serve for hiding technical
 * errors when the app is deployed
 */
const DEBUG = true;

/**
 * Should the framework save logs or not
 * By default it saves the logs to the database
 */
const LOG_REQUESTS = true;

/**
 * Database setup
 *
 */
const DATABASE_CONFIG = array(
    'SGBD' => 'mysql',
    'HOST' => 'localhost',
    'DATABASE' => 'rest_api',
    'USER' => 'someuser',
    'PASSWORD' => 'securepassword'
);

/**
 * Your jwt private signature key
 * The HMAC SHA256 Algorith will be used to sign your tokens
 */
const SIGNATURE_KEY = "Put a strong key here";
