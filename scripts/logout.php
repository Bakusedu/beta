<?php
require_once 'core/init.php';

if ($student->logout()) {
  redirectTo('login.php');
}
redirectTo('scripts/login.php');
?>
