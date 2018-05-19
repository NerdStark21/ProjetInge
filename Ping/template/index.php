
<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>

<!DOCTYPE html>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html><head>
	<title>Projet ingé</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/historique.css">
	<link rel="stylesheet" type="text/css" href="assets/css/addflag.css">
	<link rel="stylesheet" type="text/css" href="assets/css/infos.css">
  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
	<body class="">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
							<header id="header">

							</header>

							<!-- Section -->
							<section id="body">
								<script>
									$.ajax({
										url : "historique.php",
										type : 'GET',
										dataType : 'html',
										success : function(code_html, statut){
						     $("#body").empty();
						     $(code_html).appendTo("#body"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
										},
										error : function(resultat, statut, erreur){
										  
										},
										complete : function(resultat, statut){
			
										}
									});
								</script>
							</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar" class="inactive">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
									<form method="post" action="#">
										<input type="text" name="query" id="query" placeholder="Search">
									</form>
								</section>

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<u1><a id="userConnected"><?php echo "Connecté sous : $last_name "?></a></u1>
									<ul>
										<li><a id="page_historique">Historique</a></li>
										
										<li><a id="page_astuces">Astuces</a></li>
										<li><a id="page_comparaison">Comparaison (WIP)</a></li>
										<li>
											<span class="opener">Paramètres</span>
											<ul>
												<li><a href="#">Mon compte</a></li>
												<li><a id="page_infos">Mes infos</a></li>
											</ul>
										</li>
									</ul>
								</nav>
								<section>
									<header class="major">
										<h2>Get in touch</h2>
									</header>
									<p>Peut-être qqc ici</p>
									<ul class="contact">
										<li class="fa-envelope-o"><a href="#">information@untitled.tld</a></li>
										<li class="fa-phone">(000) 000-0000</li>
										<li class="fa-home">1234 Somewhere Road #8254<br>
										Nashville, TN 00000-0000</li>
									</ul>
								</section>

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">© Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
    <p> Il ne faudra pas oublier de mentionner les licences ici !</p>
								</footer>

						</div>
					<a href="#sidebar" class="toggle">Toggle</a></div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

</body></html>