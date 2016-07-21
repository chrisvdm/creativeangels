<?php
if(isset($_GET['btnCreate']) && $_GET['btnCreate'] === 'Create') {

  $sql_tblcms = "CREATE TABLE IF NOT EXISTS tblcms (
    cid int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
    ccreated date NOT NULL DEFAULT '0000-00-00',
    cupdated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    cusername char(14) NOT NULL DEFAULT 'na',
    cpassword char(40) NOT NULL DEFAULT 'na',
    caccesslevel enum('a','b') NOT NULL DEFAULT 'a',
    cname varchar(24) NOT NULL DEFAULT 'na',
    csurname varchar(24) NOT NULL DEFAULT 'na',
    cemail varchar(100) NOT NULL DEFAULT 'na',
    cmobile char(13) NOT NULL DEFAULT 'na',
    PRIMARY KEY (cid)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

	//Call in config file...
  require('config.php');

  //connect to the mysql
  require (PATH . '/includes/inc-conn.php');

  //execute the sql statement returns true
  $result_created = mysqli_query($vconn_creativeangels, $sql_tblcms);

	if ($result_created) {

		//formulate the sql statement
		$sql_record ="INSERT INTO tblcms (ccreated, cupdated, cusername, cpassword, caccesslevel, cname, csurname, cemail, cmobile) VALUES ('2016-06-02', '2016-06-02 10:07:41', 'cnyman', sha1('ramfest'), 'a', 'Christine', 'Nyman', 'nymanchristine@gmail.com', '0767653942')";

		// execute the sql statement
		$record_created = mysqli_query($vconn_creativeangels, $sql_record);
	}

} elseif (isset($_GET['btnDrop']) && $_GET['btnDrop'] === 'Drop') {

  //Call in config file...
  require('config.php');

  $tbl_tblcms = "DROP TABLE tblcms";

  //connect to the mysql SoapServer
  require (PATH . '/includes/inc-conn.php');

  $result_dropped = mysqli_query($vconn_creativeangels, $tbl_tblcms);

}

?>
<!DOCTYPE html>
<html>

<head>

	<title>Creative Angels | template</title>

</head>

<body>

	<!-- extracts the current page path -->
  <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">

	  <input type="submit" value="Create" name="btnCreate">
    <input type="submit" value="Drop" name="btnDrop">

  </form>

  <p>
    <?php

    if(isset($result_dropped)) {

      echo 'Table dropped';

    } elseif (isset($result_created)) {

      echo 'Table created';

    }


    ?>
  </p>

	<!-- Declares whether a record has been created -->
	<p>
		<?php

			if(isset($record_created)) {
				echo 'Record added';
			}

		?>
	</p>

</body>

</html>
