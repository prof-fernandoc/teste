<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php include 'tools.php';
	$config = loadJSON('config.json'); ?>
	<title><?= $config["title"]->value ?></title>


	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="pag.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
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
	<header id="header" class="alt">
		<div class="logo"><a href="./">{{config.title.value}}</a></div>
		<a href="#menu">Menu</a>
	</header>

	<!-- Nav -->
	<?php include 'menu.php'; ?>
	<!-- Banner -->
	<section class="banner full" s>
		<?php foreach ($config["menu"]->value as $item) { ?>
			<article>
				<img src="images/p_inicial.jpg" />
				<div class="inner">
					<header>
						<p style='font-weight:bold; color: white;'>{{config.title.value}}</p>
						<h2 style="font-size: 48pt"><?= $item->label ?></h2>
					</header>
				</div>
			</article>
		<?php } ?>
	</section>

	<!-- One -->
	<section id="one" class="wrapper style2">
		<div class="inner">
			<div class="grid-style">
				<div>
					<div class="box">
						<div class="image fit">
							<img class="homeblock" src="{{config.homeimg1.value}}" alt="{{config.homeimg1.description}}" />
						</div>
						<div class="content">
							<header class="align-center">
								<p></p>
								<h2></h2>
							</header>
							<p></p>
							<footer class="align-center">
								<a href="#" class="button alt">Ler mais</a>
							</footer>
						</div>
					</div>
				</div>

				<div>
					<div class="box">
						<div class="image fit">
							<img class="homeblock" src="{{config.homeimg2.value}}" alt="{{config.homeimg2.description}}" />
						</div>
						<div class="content">
							<header class="align-center">
								<p></p>
								<h2></h2>
							</header>
							<p></p>
							<footer class="align-center">
								<a href="#" class="button alt">Ler mais</a>
							</footer>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Two -->
	<section id="two" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
				<p></p>
				<h2>{{config.title.value}}</h2>
			</header>
		</div>
	</section>

	<!-- Three -->
	<section id="three" class="wrapper style2">
		<div class="inner">
			<header class="align-center">
				<p class="special">{{config.title.value}}</p>
				<h2>{{config.subtitle.value}}</h2>
			</header>
			<div class="gallery">
				<div>
					<div class="image fit">
						<a href="#"><img class="homeblock" src="{{config.homeimg1.value}}" alt="{{config.homeimg1.description}}" /></a>
					</div>
				</div>
				<div>
					<div class="image fit">
						<a href="#"><img class="homeblock" src="{{config.homeimg2.value}}" alt="{{config.homeimg2.description}}" /></a>
					</div>
				</div>
				<div>
					<div class="image fit">
						<a href="#"><img class="homeblock" src="{{config.homeimg3.value}}" alt="{{config.homeimg3.description}}" /></a>
					</div>
				</div>
				<div>
					<div class="image fit">
						<a href="#"><img class="homeblock" src="{{config.homeimg4.value}}" alt="{{config.homeimg4.description}}" /></a>
					</div>
				</div>
			</div>
		</div>
	</section>


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