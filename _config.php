<?php
  define('ROOT', dirname(__FILE__));
 
 $base_path = str_replace(dirname(__DIR__), '\COMP-1006', ROOT);
  

  define('base_path', $base_path);

include_once(ROOT . "/includes/_helpers.php");
// include authentication and helper files and define any constants needed.
include_once(ROOT . "/includes/_auth_helpers.php");
define('ADMIN', is_admin());
define('AUTH', is_auth());
// Include our common helpers
