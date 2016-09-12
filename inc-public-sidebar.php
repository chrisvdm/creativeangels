<aside class="sidebar col-1-3">

  <?php
  // Create SQL statement to fetch all records from tblcontactdetails
  $sql_news = "SELECT * FROM tblnews ORDER BY nid DESC limit 3";

  //Connect to MYSQL Server
  require(PATH . '/inc-conn.php');

  //Execute SQL statement
  $rs_news = mysqli_query($vconn_creativeangels, $sql_news);

  //Create associative Array
  $rs_news_rows = mysqli_fetch_assoc($rs_news);

  $rs_news_rows_total = mysqli_num_rows($rs_news);

  ?>

  <section>
<h3>Latest News</h3>
    <?php do {?>


   <article>
     <h4><?php echo $rs_news_rows['nheading']; ?></h4>
     <p><?php echo $rs_news_rows['nsummary']; ?></p>
   </article>
   <?php } while ($rs_news_rows = mysqli_fetch_assoc($rs_news)) ?>

  </section>
</aside>
