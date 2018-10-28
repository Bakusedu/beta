<?php
// Pass class name to function for autoload
function __autoload($classname) {
  $classname = strtolower($classname);
  require_once APP_ROOT . 'scripts/core/class/'.$classname.'.class.php';
}
