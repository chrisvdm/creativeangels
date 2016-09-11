<?php
// returns object based on whether or not a keyvalue pair from array validate according to type(string, int or email)
function sanitize($name, $type = 'string', $method = 'post') {
  
    if(exists($name, $method)){
      $input = pluck($name, $method);
      return ugh($input, $type);
    }
}

// validates and sanitizes
function ugh($input, $type){

  switch ($type) {

    case 'string':
      $input = filter_var($input, FILTER_SANITIZE_STRING);

      if ($input === ''){
        return false;
      } else {
        return $input;
      }
    break;

    case 'int':
      $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);

      if ($input === ''){
        return false;
      } else {
        return $input;
      }
    break;

    case 'email':
      $input = filter_var($input, FILTER_SANITIZE_EMAIL);

      if ($input !== ''){
        if(!filter_var($input, FILTER_VALIDATE_EMAIL)) {
          return false;
        } else {
          return $input;
        }
      }
    break;

    default:
      return false;
    break;

  }
} // end of reduce fn

// Checks whether the key value pair exists and has a value
function exists($name, $method) {

  if(strtolower($method) === 'post'){

    if(isset($_POST[$name]) && $_POST[$name] !== ''){
      return true;
    } else {
      return false;
    }

  } elseif (strtolower($method) === 'get') {

    if(isset($_GET[$name]) && $_GET[$name] !== ''){
      return true;
    } else {
      return false;
    }
  }
} // end of exists fn

// retrieves the value from array
function pluck($name, $method){

  if(strtolower($method) === 'post'){

    return trim($_POST[$name]);

  } elseif (strtolower($method) === 'get') {

    return trim($_POST[$name]);

  }

} // end of pluck fn
?>
