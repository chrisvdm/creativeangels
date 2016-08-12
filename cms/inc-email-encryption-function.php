<?php
//This function can be placed on a server-include file
    function escapeHex_email($string)
    {
        $return = '';
        for ($x=0; $x < strlen($string); $x++) {
            $return .= '%' . bin2hex($string[$x]);
        }
        return $return;
    }

    function escapeHexEntity_email($string)
    {
        $return = '';
        for ($x=0; $x < strlen($string); $x++) {
            $return .= '&#x' . bin2hex($string[$x]) . ';';
        }
        return $return;
    }
?>

<?php //require_once('inc_email_encryption_function.php'); ?>
