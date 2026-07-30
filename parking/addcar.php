<!DOCTYPE html>
<html>
<head>
	<title>Add Car</title>

	<!-- DEFINING THE CHAR SET-->
	<meta charset="utf-8">

	<!--WEB FONTS REFERENCES-->
	<!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet">

	<!-- SETTING VIEWPORT-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS REFERENCE TO BOOTSTRAP -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" >
	
	<!-- EXTERNAL STYLES REFERENCE-->
	<link rel="stylesheet" type="text/css" href="/cars website/carstyle.css">
	<link rel="stylesheet" type="text/css" href="/cars website/global.css">
	<link rel="stylesheet" type="text/css" href="/cars website/addcar.css">
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
	<script type="text/javascript" src="js/script.js"></script>

	
</head>
<body>

	<!-- STICKY HEADER -->
	<div class="header">
		<div class="Navbar">
	    	<div class="logo-img-new">
				<img id="logo-new" src="image/logo-3.png" style="height: 2rem; width: 10rem;">
			</div>
			<div></div>
		    <div class="Navbar__Link Navbar__Link-toggle">
		      	<i class="fas fa-bars fa-2x"></i>
		    </div>
		    <div class="Navbar__Items">
			    	<div class="Navbar__Link">
			      		<a class="a-header" href="index.php">HOME</a>
			    	</div>
			    	<div class="Navbar__Link">
			      		<a class="a-header" href="#vehicles">USED CARS</a>
			    	</div>
			    	<div class="Navbar__Link">
			      		<a class="a-header" href="#services">SERVICES</a>
			    	</div>
			    	<div class="Navbar__Link">
			      		<a class="a-header" href="#featured">CAR RENTAL</a>
			    	</div>
			    	<div class="Navbar__Link">
			      		<a class="a-header" href="Contact Us/contact_us.html">SUPPORT</a>
			    	</div>
					
			</div>
	  	</div>
  	</div>
	<!-- END OF STICKY HEADER -->


	<div class="g-bg-color--blue-lagoon box"><br><br>
	<h1 class="heading g-font-weight--500">
		Book Your Car
	</h1>
	<div class="car-details">
		<form action="newVersion_usertable.html" onsubmit="return validateCar()" method="POST">

			<!-- CAR MODEL NAME -->
			<div class="line-form">
				<div class="label-all">
					<label for="carName">Pick Up Place</label>
				</div>
				<div>
					<input type="text" name="carName" id="carName" placeholder="Pick Up Place" required>
				</div>
			</div>

			<!-- CAR NUMBER -->
			<div class="line-form">
				<div class="label-all">
					<label for="carNumber">Destination Place</label>
				</div>
				<div>
					<input type="text" name="carNumber" id="carNumber" placeholder="Destination Place" title="Should be actual eg GA06B5109" required>
				</div>
			</div>

			<!-- CAR AGE -->
			<div class="line-form">
				<div class="label-all">
					<label for="years"><b>Duration</b></label>
				</div>
				<div>
					<input type="number" name="years" min="0" max="10" step="1" placeholder="Duration" required>
				</div>
			</div>

			<!-- DATE OF CAR DEAL -->
			<div class="line-form">
				<div class="label-all">
					<label for="dateAvailable">Date of pick up</label>
				</div>
				<div>
					<input type="date" id="dateAvailable" name="dateAvailable" min="1899-01-01" max="2020-13-13" id="dateAvailable" placeholder="Enter date here" required>
				</div>
			</div>

			<!-- END OF CAR DEAL -->
			<div class="line-form">
				<div class="label-all">
					<label for="tillDate">Till Date</label>
				</div>
				<div>
					<input type="date" id="tillDate" name="tillDate" min="10-11-2018" id="tillDate" placeholder="Enter Till date here" required>
				</div>
			</div>

			<!-- AMOUNT -->
			<div class="line-form">
				<div class="label-all">
					<label for="price">Rent Price for 4 hrs</label>
				</div>
				<div>
					<input type="number" name="price" min="500" max="3000" step="100" placeholder="How much Hrs do you want" required>
				</div>
			</div>

			<!-- CAR IMAGE -->
			<div class="line-form">
				<div class="label-all">
					<label for="upload">Upload an image of car</label>
				</div>
				<div>
					<input type="file" class="upload" name="pic" accept=".jpg,.png|image/*" required>
				</div>
			</div>

			<!-- I AGREE -->
			<div class="agree">
				<input type="checkbox" name="agree" value="agreement" id="agree-tick" required>"I AGREE" By clicking this you agree to our terms and condition<br>
			</div>

			<!-- SUBMIT BUTTON -->
			<div style="padding-top: 1rem" class="submit-btn">
				<input type="submit" class="btn g-color--dark g-bg-color--white" value="SUBMIT">
			</div>
			
		</form>
		<br>
	<br>
	</div>
	</div>

	<!-- FOOTER-->
	
	<footer class="g-bg-color--dark-light g-color--white-opacity">
		<div class="foot">
			<div class="padd__needed">
				<img id="logo" src="/image/logo-3.png">
			</div>
			<div class="connectivity padd__needed">
				<div class="connect">
					<i class="fab fa-facebook-square"></i>
					<a class="a-footer" href="#">FACEBOOK</a>
				</div>
				<div class="connect">
					<i class="fab fa-linkedin"></i>
					<a class="a-footer" href="#">LINKED IN</a>
				</div>
				<div class="connect">
					<i class="fab fa-twitter-square"></i>
					<a class="a-footer" href="#">TWITTER</a>
				</div>
				<div class="connect">
					<i class="fab fa-instagram"></i>
					<a class="a-footer" href="#">INSTAGRAM</a>
				</div>
			</div>
			<div class="padd__needed">
				<h6 class="g-color--primary">&copy CAR RENTERS</h6>
			</div>
		</div>
	</footer>
	<!--END OF FOOTER-->

	<!-- SCRIPT REFERENCES -->
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>