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
<script src='https://www.google.com/recaptcha/api.js'></script>
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


<link href="stylesheets/public.css" rel="stylesheet" type="text/css">
