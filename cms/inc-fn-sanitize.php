<?php
// returns object based on whether or not a keyvalue pair from array validate according to type(string, int or email)
function $sanitize($name, $type, $method) {

  // Checks whether the name exists and has a value
  function $exists($name, $method) {

    if(strtolower($method) === 'post'){

      if(isset($_POST[$name]) && $_POST[$name] !== ''){
        return $_POST[$name];
      } else {
        echo 'Key value pair not found';
        exit();
      }

    } elseif (strtolower($method) === 'get') {

      if(isset($_GET[$name]) && $_GET[$name] !== ''){
        return $_GET[$name];
      } else {
        echo 'Key value pair not found';
        exit();
      }
    }
  } // end of exits fn

  function $reduce($input, $type){

    switch $type {

      case 'string':
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if ($input === ''){
          return false;
        } else {
          return $input;
        }
      break;

      case 'int':
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);

        if ($input === ''){
          return false;
        } else {
          return $input;
        }
      break;

      case 'email':
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_EMAIL);

        if ($input !== ''){
          // Validate email address (Check that email has correct structure)
          if(!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            // If email does not validate
            return false;
          } else {
            return $input;
          }
        }
      break;

      default:
        return 'Variable type does not exist';
      break;
    }
  } // end of reduce fn

  function $act($name, $type, $method){
    reduce(exists($name, $method), $type);
  }

  act($name, $type, $method);
}
?>
