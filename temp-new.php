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

    <!--<![endif]-->

    <!--
    The following script allows all browsers to support media queries in CSS.
    -->

    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueriesjs.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <script src="js/hamburger-icon-animate.js" charset="utf-8"></script>
    <link rel="stylesheet" href="css/hamburger-icon-animate.css">
    <link rel="stylesheet" href="css/main.css">

    <title>Creative Angels | Template</title>
  </head>
  <body>

    <div id="site-wrapper">

      <!--======================= HEADER CONTAINER =========================-->
      <header class="base-container">

        <!-- Site name and logo -->
        <div class="logo">
          <h1>Creative Angels</h1>
        </div>

        <!-- Hamburger trigger and icon -->
        <div class="hamburger-trigger">

          <div class="hia-hamburger">
            <div data-bar="1" class="hia-bar"></div>
            <div data-bar="2" class="hia-bar"></div>
            <div data-bar="3" class="hia-bar"></div>
          </div>
        </div>

        <div class="clearfloat"></div>

      </header>

      <!--======================= MOBILE NAVIGATION =========================-->
      <nav class="mobile-nav">
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

      <!--==================== MAIN CONTENT CONTAINER ======================-->
      <section class="main-content-container">

        <!--==================== MAIN CONTENT LEFT =========================-->
        <section class="main-content-right col-4-6 base-container">

          <!-- Article 1 -->
          <article class="main-article">

            <!-- Article title -->
            <h2>Article 1</h2>

          </article>

          <!-- Article 2 -->
          <article class="main-article">

            <!-- Article title -->
            <h2>Article 2</h2>

          </article>

          <!-- Article 3 -->
          <article class="main-article">

            <!-- Article title -->
            <h2>Article 3</h2>

          </article>



        </section>

        <!--====================== SIDEBAR CONTAINER =======================-->
        <section class="sidebar col-2-6">

        </section>

        <div class="clear-flaot"></div>
      </section>

    </div>

    <script src="js/jquery.min.js" charset="utf-8"></script>
    <script>
      hamburgerIcon({
        showMenu: function() {
          $('nav.mobile-nav').slideDown();
        },
        hideMenu: function() {
          $('nav.mobile-nav').slideUp();
        }
      });

    </script>

  </body>
</html>
