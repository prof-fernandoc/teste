<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<?php
	include 'tools.php';
	$config = loadJSON('config.json');
	$param = strtolower($_GET['p']);
	?>
	<title><?= $config["title"]->value ?></title>


	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="pag.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-sanitize.js"></script>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style>
		img.homeblock {
			height: 340px
		}
	</style>
	<style>
		.menu {
			display: none;
		}

		a {
			color: #ff2c2c;
			font-weight: bold;
		}
	</style>
</head>

<body ng-app="myApp" ng-controller="myCtrl">
	<!-- Header -->
	<header id="header">
		<div class="logo"><a href="index.php">{{config.title.value}}</span></a></div>
		<a href="#menu">Menu</a>
	</header>
	<!-- Nav -->
	<?php include 'menu.php'; ?>
	<!-- One -->
	<section id="One" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
				<p>{{config.title.value}}</p>
				<h2>{{config.<?= $param ?>.value}}</h2>
			</header>
		</div>
	</section>
	<!-- Main -->
	
	
	
	<div id="main" class="container">
		<!-- Elements -->
		<h2 id="elements">Fotos</h2>
		<div class="row 100%">
			<div>
			
				<span class="image fit">
				   <?php require_once('album_img_destaque.php'); ?>
				   <!-- <img src="{{config.<?= $param ?>img1.value}}" alt="{{config.<?= $param ?>img1.description}}" /> -->
				</span>

				<div class="box alt">
				    <div div class="row 100% uniform">
					<?php require_once('album_list.php'); ?>
					</div>	
				</div>
				
				
				<?php require_once('album_desc.php'); ?>
				
				<!--
				<h4>Povo Borum</h4>
				<p><span class="image left"><img src="{{config.<?= $param ?>img5.value}}" alt="{{config.<?= $param ?>img5.description}}" /></span>{{config.<?= $param ?>text1.value}}</p>
				<p><span class="image right"><img src="{{config.<?= $param ?>img6.value}}" alt="{{config.<?= $param ?>img6.description}}" /></span>{{config.<?= $param ?>text2.value}}</p>
				-->
				<br/><br/>
				<h3>Solicitação das fotos</h3>
				<div class="box">
					<p>Caso queira alguma foto especifica do site, preencha o formulário de solicitação nesta pagina: <a href="elements.php" style="color:black" ;>Formulário</a></p>
				</div>

			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer id="footer">
		<div class="container">
			<ul class="icons">
				<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
				<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
			</ul>
			<ul class="icons">
				<li><img src="images/jequibay.jpeg" alt="jequibay logo" style="width: 8rem"></li>
				<li><img src="images/instito_pesquisa.jpeg" alt="ifnmg logo" style="width: 22rem"></li>
				<li><img src="images/cnpq.jpeg" alt="cnpq logo" style="width: 12rem"></li>
				<li><img src="images/instituto_aracauai.jpeg" alt="ifnmg aracuai logo" style="width: 18rem"></li>
			</ul>
		</div>
		<div class="copyright">
			&copy; {{config.title.value}}. All rights reserved.
		</div>
	</footer>

	<script>
		var app = angular.module('myApp', []);
		app.controller('myCtrl', function($scope, $http) {
			$http.get("config.json").then(function(response) {
				$scope.config = response.data;
			});
		});
	</script>
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script>
		var coll = document.getElementsByClassName("collapsible");
		var i;

		for (i = 0; i < coll.length; i++) {
			coll[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var content = this.nextElementSibling;
				if (content.style.display === "block") {
					content.style.display = "none";
				} else {
					content.style.display = "block";
				}
			});
		}
	</script>

</body>

</html>