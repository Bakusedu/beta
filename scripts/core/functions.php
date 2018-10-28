<?php
// Helper functions

// Redirect to specified page
function redirectTo($page) {
  header("Location: " . $page);
  exit;
}

function sanitize($value) {
	if (!empty($value)) {
		return htmlentities(strip_tags(trim($_POST[$value])));
	}
	return false;
}

// function to keep values on form after page reload
function stickyForm($value) {
	return isset($_POST[$value]) ? $_POST[$value] : '';
}

function stickyUpdate($formfield='', $dbfield='') {
  if (!empty($formfield) || !empty($dbfield)) {
    return isset($_POST[$formfield]) ? $_POST[$formfield] : $dbfield;
  }
  return false;
}


// Radio button handler
function stickyRadio($field='', $label=''){
	if (!empty($field) && !empty($label))
		return (isset($_POST[$field]) && $_POST[$field] == $label) ? "checked='checked'" : '';
}
function stickyRadioUpdate($formfield='', $dbfield='', $formvalue=''){
  if (isset($_POST[$formfield])){
    if ($_POST[$formfield] == $formvalue){
      return " checked='checked'";
    }
  }
  else {
    if ($dbfield == $formvalue){
      return " checked='checked'";
    }
  }
}

// Select/menu handler
function stickySelect($value='', $query=''){
	if (!(strcmp(stickyForm($value), $query))){
      return " selected='selected'";
    }
}
function stickySelectUpdate($formfield='', $dbfield='', $choice=''){
  if (isset($_POST[$formfield])) {
    if (!(strcmp(stickyForm($formfield), $choice))){
        echo " selected='selected'";
      }
  }
  else {
    if (!(strcmp($dbfield, $choice))){
        echo " selected='selected'";
      }
  }
}
function checkPassword($password,$cpassword){
  if($password == $cpassword){
    return true;
  }else{
    return false;
  }
}
// Server messages
function error($errors){
    if (!empty($errors)){
      echo "<div class='alert alert-danger'>";
      foreach ($errors as $error){
        echo " - ".$error."<br>";
      }
      echo "</div>";
    }
}

function success($message){
    if (!empty($message)){
    	$output = "<div class='alert alert-success'>";
    	$output .= $message;
    	$output .= "</div>";

    	echo $output;
    }
}

// User Authentication
function loggedIn(){
	return isset($_SESSION['us3rid']) ? true : false;
}

function restricted(){
	if (!loggedIn()){
		redirectTo('../user/login.php');
	}
}

function administrator(){
	if (!isAdmin()){
		redirectTo('../user/login.php');
	}
}

 function isAdmin(){
 	if($_SESSION['priviledges'] == '3'){
    return true;
  }
  return false;
 }

function admin() {
  if (loggedIn()) {
    if (isAdmin()) {
      return true;
    }
    return false;
  }
  return false;
}

function user() {
  if (loggedIn()) {
    if (!isAdmin()) {
      return true;
    }
    return false;
  }
  return false;
}

/* Working with Dates */
function datetime_to_text($date="") {
  if (!empty($date)) {
    $unixtimestamp = strtotime($date);
    // Format date
    return strftime("%B %d, %Y %I:%M %p", $unixtimestamp);
  }
}
function date_to_text($date=""){
  $unixdatetime = strtotime($date);
  return strftime("%B %d, %Y", $unixdatetime);
}
function point_adder($grade,$credithrs){
      if($grade == 'A'){
        $point = 5;
      }
      elseif($grade == 'B'){
        $point = 4;
      }
      elseif($grade == 'C'){
        $point = 3;
      }
      elseif($grade = 'D'){
        $point = 2;
      }
      elseif($grade == 'E'){
        $point = 1;
      }
      else{
        $point = '0';
    }
    $total_point = $point * $credithrs;
    return $total_point;
}
?>
