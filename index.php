<!DOCTYPE html>
<html>

<head>
  <title>Teuse Pi</title>
  <meta name="description" content="Just a little homepage to display my stuff">
  <meta name="keywords" content="Teuse, Raspberry Pi, Mathi Radler">
  <meta http-equiv="content-type" content="text/html">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <script src="js/flotr2.min.js"></script>
  <!--[if lt IE 9]>
  <script type="text/javascript" src="js/flashcanvas.js"></script>
  <![endif]-->
</head>

<body>
<div id="main">
<div id="header">

<!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++ LOGO	 			                  					 +++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
<div id="logo">
	<div id="logo_text">
	<!-- class="logo_colour", allows you to change the colour of the text -->
		<h1><a href="index.php">Mathi<span class="logo_colour">Radler</span></a></h1>
		<h2>Why the hell a own Homepage?</h2>
	</div>
</div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++ MENU	 					                  			 +++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
<div id="menubar">
      <ul id="menu">
        <?php
        	$curSite = $_GET["id"];
        	$sites   = array("<a href='index.php'>Brewing</a>",
                           "<a href='index.php?id=1'>Statistics</a>",
        	                 "<a href='index.php?id=2'>HTML Examples</a>",
        	                 "<a href='index.php?id=3'>Kontakt</a>");

        	for ($i = 0; $i < count($sites); $i++) {
  			$tapStr  = ($curSite == $i) ? "<li class='selected'>" : "<li>";
  			$tapStr .= $sites[$i];
  			$tapStr .= "</li>";
  			echo $tapStr;
		}
 		 ?>
      </ul>
  </div>

</div> <!-- End header -->

<div id="content_header"></div>

<div id="site_content">

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- +++ SIDEBAR 								 +++ -->
    <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="sidebar">
    <!-- <?php
      if ($_GET["id"] == 0) {
    	   include 'sidebar.php';
     }
    ?> -->
    </div>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- +++ CONTENT 								 +++ -->
    <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div id="content">

    <?php
      	switch ($_GET["id"])
      	{
         case 1:  include 'statistics.php'; break;
         case 2:  include 'html_examples.php'; break;
      	 case 3:  include 'kontakt.php'; break;
      	 default: include 'brewing.php'; break;
      	}
    ?>

    </div>

</div> <!-- End site_content -->

<div id="content_footer"></div>

	  <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- +++ FOOTER 				                				 +++ -->
    <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div id="footer">
    <!--
      <p><a href="index.php">Home</a> | <a href="examples.php">Examples</a> | <a href="page.php">A Page</a> | <a href="another_page.php">Another Page</a> | <a href="contact.php">Contact Us</a></p>
      <p>Copyright &copy; shadowplay_2 | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.html5webtemplates.co.uk">design from HTML5webtemplates.co.uk</a></p>
    </div>
    -->
</div> <!-- End content_footer -->
</body>
</html>
