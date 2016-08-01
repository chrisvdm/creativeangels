<?php
function auto_mail($eto, $ename,$efrom, $esubject, $emsg){
  //------------------------- SEND AUTO EMAIL --------------------------

  // HTML email message
  $vmessage = '
  <html>
    <head>
      <meta charset="utf-8">
      <title>Creative Angels | Reset Password </title>
    </head>
    <body>
      <table style="background-color: #ffffff; font-family: Arial, Verdana, Tahoma; font-size: 14px; letter-spacing: 0.03em; word-spacing: 0.2em; line-height: 1.6em;" cellspacing="0" width="600">
        <tr>
          <td>
            <img style="text-align: center" src="http://www.christinenyman.com/projects/creativeangels/sources/logos/creative-angels-email-logo.gif">
          </td>
        </tr>
        <tr>
          <td style="padding: 6px">
            <p><br><strong>Dear ' . $ename . '</strong></p>
            ' . $emsg . '
            <p>Yours faithfully</p>
            <p><strong>The All Powerful Webmaster</strong></p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            </td>
        </tr>
      </table>
    </body>
  </html>
  ';

  // To send HTML mail you can set the Content-type header
  // Must be in double-quotes
  $eheaders = "MIME-Version: 1.0\r\n";
  $eheaders .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $eheaders .= "From: ". $efrom . "\r\n";

  // ADDITIONAL HEADERS
  // $vheaders = 'To: Mary<mary@gmail.com>, John<john@gmail.com>\r\n';
  // $vheaders .= 'Cc: peter@gmail.com\r\n';
  // $vheaders .= 'Bcc: sue@gmail.com\r\n';

  // SEND THE MAIL
  $eresults = mail($eto, $esubject, $vmessage, $eheaders);

  return $eresults;
}
 ?>
