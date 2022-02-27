<?php 
require_once ('../resources/config.php');
require_once('../resources/libs/pdoDB.php');
require_once ('../resources/data.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once('includes/metadata.php'); ?>
	<title>Coderonald | Be the first one to receive the latest tech news.</title>
	<style type="text/css">
		.navbar{
			background: #1181b2;
		}
		.logo h3 span{
			color: #fff;
		}
		.navbar.sticky{
			background: var(--main-color);
		}
		.navbar.sticky .logo h3 span{
			color: #1181b2;
		}
	</style>
</head>
<body>
<main>
<div class="scroll-up-button">
	<i class="fas fa-angle-up"></i>
</div>
<header>
	<div class="scroll-up-button">
			<i class="fas fa-angle-up"></i>
	</div>
	<nav class="navbar">
	<div class="max-width">
		<div class="logo"><a href="home"><h3>Code<span>ronald</span></h3></a></div>
		<ul class="menu">
			<li><a href="home" class="menu-btn">Home</a></li>
			<li><a href="home#about" class="menu-btn">About</a></li>
			<li><a href="home#services" class="menu-btn">Services</a></li>
			<li><a href="home#skills" class="menu-btn">Skills</a></li>
			<li><a href="home#teams" class="menu-btn">Teams</a></li>
			<li><a href="home#contact" class="menu-btn">Contact</a></li>
			<li><a href="newsfeeds" class="menu-btn">News</a></li>
			<li><a href="videos" class="menu-btn">Watch</a></li>
		</ul>
		<div class="icon">
			<!-- <a href="login.php" class="fas fa-user"></a>; -->
			<p><?=$greetings;?></p>
		</div>
		<div class="menu-btn">
			<i class="fas fa-bars"></i>
		</div>
	</div>
</nav>
</header>
<section class="blogPostContent">
<div class="blog-img">
	<div class="coverImage">
		<div>
			<img src="../resources/images/homepic.jpg" class="img" alt="Cover Image">
		</div>
		<div class="moreinfo">
			<p class="text-gray">Posted on 25th January 2022&nbsp; By <strong style="color: #000;">Ronald</strong></p>
		</div>
		<div class="share">
			<div class="social text-gray">
				<i class="fab fa-facebook-f">Share</i>
				<a href="#"><i class="fab fa-facebook-f">F</i></a>
				<a href="#"><i class="fab fa-instagram">I</i></a>
				<a href="#"><i class="fab fa-twitter">T</i></a>
			</div>	
		</div>
	</div>
</div>
<div class="blog-content">
	<div class="post">
		<p class="blogTitle">Ye annouces Yeezy inc went bankrupt.</p>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
	<div class="ad">
		<p>Ad</p>
	</div>
	<div class="checkAlso">
		<h2 class="moreTitle">More related topics</h2>
		<div class="relatedTopics">
			<div class="box">
				<div class="image">
					<a href="postcontent.php" ><img src="../resources/images/sokev.JPG" alt="Blog Post Image"></a>
				</div>
				<div class="blogTitle">
					<a href="">Elon Musk pays tax worth 11Billion!</a>
				</div>
			</div>
			<div class="box">
				<div class="image">
					<a href="postcontent.php" ><img src="../resources/images/sokev.JPG" alt="Blog Post Image"></a>
				</div>
				<div class="blogTitle">
					<a href="">Elon Musk pays tax worth 11Billion!</a>
				</div>
			</div>
			<div class="box">
				<div class="image">
					<a href="postcontent.php" ><img src="../resources/images/sokev.JPG" alt="Blog Post Image"></a>
				</div>
				<div class="blogTitle">
					<a href="">Elon Musk pays tax worth 11Billion!</a>
				</div>
			</div>
			<div class="box">
				<div class="image">
					<a href="postcontent.php" ><img src="../resources/images/sokev.JPG" alt="Blog Post Image"></a>
				</div>
				<div class="blogTitle">
					<a href="">Elon Musk pays tax worth 11Billion!</a>
				</div>
			</div>
			<div class="box">
				<p>Ad</p>
			</div>
		</div>
	</div>
	<div class="ad">
		<p>Ad</p>
	</div>
</div>
</section>
</main>
<section class="footer">
	<div class="share">
		<a href="https://www.facebook.com/matekwaronald" target="_blank" class="fab fa-facebook-f"></a>
		<a href="https://www.twitter.com/matekwaronald" target="_blank"  class="fab fa-twitter"></a>
		<a href="https://www.instagram.com/coderonald/" target="_blank"  class="fab fa-instagram"></a>
		<a href="https://www.linkedin.com/in/matekwa-ronald-91838420b/" target="_blank"  class="fab fa-linkedin"></a>
		<a href="https://www.pinterest.com/matekwaronald/" class="fab fa-pinterest"></a>
		<a href="https://www.youtube.com/channel/UCuf92UqN4inUmf0-3VUuVRA" target="_blank"  class="fab fa-youtube"></a>
		<a href="https://www.tiktok.com/@coderonald?lang=en" target="_blank"  class="fab fa-tiktok"></a>
		<a href="https://www.github.com/matekwa" target="_blank" class="fab fa-github"></a>
	</div>
	<div class="info">
		<div class="infobox">
			<i class="fas fa-phone"></i>
			<span>O713490657</span>
		</div>
		<div class="infobox">
			<i class="fas fa-envelope"></i>
			<span>helpdesk@coderonald.com</span>
		</div>
	</div>
	<div class="links">
		<a href="newsfeeds">News</a>
		<a href="home">home</a>
		<a href="home#about">about</a>
		<a href="home#services">services</a>
		<a href="home#skills">skills</a>
		<a href="home#teams">team</a>
		<a href="home#contact">contact</a>
		<!-- <a href="support.php" class="supportme">Support Me&nbsp;<img src="../resources/images/heart.png"></a> -->
	</div>
	<div class="terms">
		<a href="terms">Terms and Conditions</a>
	</div>
	<div class="copy">
		&copy; 2022
	</div>
	<div class="credits">
		 all rights reserved.
	</div>
</section>
<script type="text/javascript">
		$(document).ready(function () {
	$(window).scroll(function () {
		if(this.scrollY > 20){
			$('.navbar').addClass('sticky');
		} else{
			$('.navbar').removeClass('sticky');
		}
		if (this.scrollY > 500) {
			$('.scroll-up-button').addClass('show');
		} else{
			$('.scroll-up-button').removeClass('show');
		}
	});

	// scroll up script
	$('.scroll-up-button').click(function(){
		$('html').animate({scrollTop:0})
	});

	$('.menu-btn').click(function(){
		$('.navbar .menu').toggleClass("active");
		$('.menu-btn i').toggleClass("active");
	})

	});
</script>
</body>
</html>