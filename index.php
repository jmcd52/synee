<?php

	include( "./includes/class.functions.php");

	$fn = new Functions( $db );

?>
<!DOCTYPE html>
<html lang="en">

  <head>
	<link rel="stylesheet" href="https://use.typekit.net/hjm7uyh.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="As a design agency (coming soon), we are experienced with the Web and graphic design, we can help you create your online presence or realise your next marketing campaign.">

    <title>Synee.</title>

    <?php include ( "includes/header.php" ); ?>

  </head>

  <body>

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
    


      <!-- Page Heading -->
      <!--<h1 class="pageTitle">Recent Work</h1>
	  <p>Here are my most recent projects! </p>-->
	  <!-- /Page Heading -->
	  <hr>

	<!-- carousel -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="/images/hero5.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/images/hero3.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/images/hero2.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	<!-- /carousel -->

	<!-- Section 1 -->
	  <section class="bodyText bodyText--initial">
		<div class="container-fluid">
		
			<div class="row">
				<div class="col-md">
      			<h1>Who we are.</h1>
    			</div>
    			<div class="col-md">
					<h2>Synee is a design agency that works with traditional and digital media to bring your brand to life.</h2>
					<p>From logos and business cards to complete brochures and campaigns, we can help you get yourself across.</p>
					<p>We can also get you online, with our experience building beautiful websites and  optimising your site for search.</p>
					<strong>So, if you're looking to get yourself out there, we're here to help.</strong>
    			</div>
			</div>
		</div>
	  </section>
	<!-- /Section 1 -->
		
	
		
	<!-- Divider 1 -->
			
	  	<img class="divImg" id="divider1" src="images/divider1.png">
	<!-- /Divider 1 -->
		
	<!-- Section 2 -->
	 <section class="bodyText">
	  <div  class="container-fluid">
		  <div class="row">
				<div class="col-md">
      			<h1>Printworks</h1>
    			</div>
    			<div class="col-md">
					<h2>Despite technology, printed media is still a key component of any organisations marketing strategy.</h2>
					<p></p>
					<p>From logos and collateral, to flyers, brochures and even billboards, we've done it all.</p>
    			</div>
			</div>
	  </div>
	</section>	
	<!-- /Section 2 -->
  
    <!-- Divider 2 -->
			
	  	<img class="divImg" id="divider2" src="images/divider2.png">
	<!-- /Divider 2 -->
	  
	<!-- Section 3 -->
	 <section class="bodyText bodyText--final">
	  <div  class="container-fluid">
		  <div class="row">
				<div class="col-md">
      			<h1>Digital Marketing.</h1>
    			</div>
    			<div class="col-md">
					<h2>Your online presence.</h2>
					<p>Any business or organisation nowadays need a website. Thats where we come in.</p>
					<p>With knowledge about all aspects of the Web today, we can build beautiful websites that work well across a broad range of modern devices.</p>
					<p>We also posess search engine know-how to get you to the top of the list, increasing the impact of your business.</p>
    			</div>
			</div>
	  </div>
	</section>	
	<!-- /Section 3 -->

	<div id="footContact" class="d-md-none">
		  	<span class="carousel-control-next-icon" id="numArrow"></span>
		  		<h2 id="phone">01295 123456</h2>
		  	<h3 id="mail">contact@synee.co.uk</h3>
		  </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white"><a class="btn btn-primary" id="contactLink" href="contact.php">Get in touch today!</a></p>
      </div>
      <!-- /.container -->
    </footer>

<?php include ( "./includes/footer.php" ); ?>

  </body>

</html>
