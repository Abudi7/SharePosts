<?php
// APP ROOT 
// i use the magic method __File__ to get the path from the file 
//dirname( Returns a parent directory's path)
//define(Defines a named constant);
define('APPROOT', dirname(dirname(__FILE__)));

//URL ROOT
define('URLROOT', 'http://localhost/SharePosts/traversymvc');

// Site Name 
define('SITENAME','SharePosts');

// DB Paramters 
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','sharepost');

// APP version 
define('APPVERSION' ,'1.0.0');

