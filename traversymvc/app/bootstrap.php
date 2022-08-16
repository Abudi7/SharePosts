<?php
 // Load Config file 
  require_once 'config/config.php';
  // Load Libraries
  // require_once 'libaries/core.php';
  // require_once 'libaries/controller.php';
  // require_once 'libaries/database.php';

  //load Helpers 
  require_once 'helpers/urlHelper.php';
  
  require_once 'helpers/sessionHelper.php';

  //AUTOLOADER Core Libraries
  spl_autoload_register(function($className){
    require_once 'libaries/'. $className . '.php';
  });