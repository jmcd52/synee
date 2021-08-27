<?php

	include( "./includes/class.functions.php");

	$fn = new Functions( $db );

?>
<!DOCTYPE html>
<html lang="en">

  <head>
	<link rel="stylesheet" href="https://use.typekit.net/hjm7uyh.css">
	<link rel="stylesheet" href="css/form.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Got a project in mind? Contact us here.">
    <meta name="author" content="">
	
    <title>Contact Us - Synee.</title>
	
    <?php include ( "includes/header.php" ); ?>
  </head>

  <body style="background-color: gray;">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">
			<!--<img width="200" height="100" src="images/Logo1.png"> -->
			<h1 id="logoText">Synee.</h1>
		  </a>
		  <div id="navContact" class="d-none d-md-block">
		  	<span class="carousel-control-next-icon" id="numArrow"></span>
		  		<h2 id="phone">01295 123456</h2>
		  	<h3 id="mail">contact@synee.co.uk</h3>
		  </div>
		 <!-- 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link btn btn-primary active" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-primary" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-primary" href="portfolio.php">Portfolio</a>
            </li>
			  
			<li class="nav-item">
				<form id="searchForm" action="search.php" method="POST">
					<input class="btn btn-primary" type="text" name="search" id="search" placeholder="Search term" value="<?php echo $searchTerm; ?>" />
					<button class="btn btn-primary" id="searchButton" name="searchButton">Search</button>
				</form>
             </li>	-->
          </ul>
        </div>
		  
      </div>
    </nav> <!-- Navigation ends -->
	  
	  

    <!-- Page Content -->
<div class="container" style="margin-top: 100px;">
<div id="wufoo-z7xzadw07u9n8g"> Fill out my <a href="https://j4mm3r201.wufoo.com/forms/z7xzadw07u9n8g">online form</a>. </div> <script type="text/javascript"> var z7xzadw07u9n8g; (function(d, t) { var s = d.createElement(t), options = { 'userName':'j4mm3r201', 'formHash':'z7xzadw07u9n8g', 'autoResize':true, 'height':'800', 'async':true, 'host':'wufoo.com', 'header':'show', 'ssl':true }; s.src = ('https:' == d.location.protocol ?'https://':'http://') + 'secure.wufoo.com/scripts/embed/form.js'; s.onload = s.onreadystatechange = function() { var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return; try { z7xzadw07u9n8g = new WufooForm(); z7xzadw07u9n8g.initialize(options); z7xzadw07u9n8g.display(); } catch (e) { } }; var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr); })(document, 'script'); </script>
</div>


      <!-- Page Heading -->
      <!--<h1 class="pageTitle">Recent Work</h1>
	  <p>Here are my most recent projects! </p>-->
	  <!-- /Page Heading -->
	  <hr>


    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white"><a class="btn btn-primary" id="contactLink" href="index.php">Return to homepage</a></p>
      </div>
      <!-- /.container -->
    </footer>

<?php include ( "./includes/footer.php" ); ?>


  </body>



</html>
