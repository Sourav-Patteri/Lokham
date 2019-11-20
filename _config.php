<?php
  define('ROOT', dirname(__FILE__));
 
 $intersect = str_replace(dirname(__DIR__), '/COMP-1006', ROOT);
  // $base_path = str_replace(dirname(__DIR__), '\COMP-1006', ROOT);


  define('base_path', $intersect);
  // echo __DIR__;
  // echo $intersect;
  // echo __FILE__ ."<br>";
  // echo dirname(__FILE__);
  // echo $base_path;
  ?>