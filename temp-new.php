<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- This piece of valid code tells mobile devices not to zoom out as a default. -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">



    <!--#################### TEACHES OLDER BROWSERS HTML5 ######################## -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--#################### IE BUG FIX ######################## -->
    <!--[if lt IE 9]>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->

    <!--
    Image resizer script.

    The code doesn't work in IE6 or less, so I suggest the following
    conditionally-commented code in your <head> be used to implement the
    JavaScript on your RWD website
    -->

    <!--[if ! lte IE 6]><!-->
    <script type="text/javascript" src="imgsizer.js"></script>
    <script type="text/javascript">
    addLoadEvent(function() {
    if (document.getElementById && document.getElementsByTagName) {
    var aImgs =
    document.getElementById("content").getElementsByTagName("img");
    imgSizer.collate(aImgs);
    }
    });
    </script>
    <!--<![endif]-->

    <!--
    The following script allows all browsers to support media queries in CSS.
    -->

    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueriesjs.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="/css/main.css">

    <title>Creative Angels | Template</title>
  </head>
  <body>

    <div id="site-wrapper">

      <header>

        <div class="logo">
          <h1>Creative Angels</h1>
        </div>

        <nav class="main-nav mobile">
          <ul>
            <li><a href="about.php"> About</a></li>
            <li><a href="services.php"> Services</a></li>
            <li><a href="partners.php"> Partners</a></li>
            <li><a href="testimonials.php"> Testimonials</a></li>
            <li><a href="events.php"> Events</a></li>
            <li><a href="news.php"> News</a></li>
            <li><a href="contact.php"> Contact</a></li>
          </ul>

        </nav>

      </header>

    </div>

  </body>
</html>
