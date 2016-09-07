<?php
if(!function_exists('escapestring')) {
	// Checks whether the function has been called before

	// This function removes the harmful characters in strings
	function escapestring($vconn_creativeangels, $value, $datatype) {

		//require('inc-conn.php');

		// This function removes the harmful characters in strings
		$value = function_exists('mysqli_real_escape_string') ? mysqli_real_escape_string($vconn_creativeangels, $value) : mysqli_escape_string($vconn_creativeangels, $value);

		//mysqli_close($vconn_creativeangels);

		// modifies the value according to the defined $datatype
		switch ($datatype) {

			case 'text':

				// if the datatype is 'text' then concatenate with ''
				$value = ($value != '') ? "'" . $value . "'" : "'na'";
				break;

			case 'int':

				$value = ($value != '') ? intval($value) : "'na'";
				break;

			case 'float':

				$value = ($value != '') ? floatval($value) : "'na'";
				break;

			case 'date':

				$value = ($value != '') ? "'" . $value . "'" : "'na'";
				break;

			}

			return $value;
		}

	}
?>
