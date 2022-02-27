<?php 
require_once ('../resources/config.php');
require_once('../resources/libs/pdoDB.php');
require_once ('../resources/data.php');
$data = new Data;

$services = $data->getServices();
$about = $data->getAbout();
$team = $data->getTeam();
$creativeSkills = $data->getSkills();
$servicecard = $data->getServiceCard();
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once('includes/metadata.php'); ?>
</head>
<body>
	<div class="scroll-up-button">
		<i class="fas fa-angle-up"></i>
	</div>
	<?php require_once('includes/header.php'); ?>
	<title>Coderonald | Hire Website & App Developer For Any Business Project/Startup</title>

	<!-- Home section stars -->
	<section class="home" id="home">
		<div class="max-width">
			<div class="home-content flex">
				<div class="text1">What's good, my name is</div>
				<div class="text2">Matekwa Ronald</div>
				<div class="text3">And I am a <span class="typing"></span></div>
				<button class="btn" id="myBtn">Hire Me</button>
				<!-- The modal -->
				<div class="modal" id="myModal">
					<!-- Modal content -->
					<div class="modalContent" id="modalContent">
						<span class="close">&times;</span>
						<form onsubmit="return false;" id="hireForm">
							<h2>Have a project? Hire Me</h2>
							<div class="inputBox">
									<select id="service">
										<option value="">-Select Service-</option>
										<?php foreach($services as $s): ?>
											<option value="<?=$s->service;?>"><?=$s->service;?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="inputBox">
									<span class="fas fa-user"></span>
									<input type="text" placeholder = "Name" id="clientName" >
								</div>
								<div class="inputBox">
									<span class="fas fa-envelope"></span>
									<input type="email" placeholder = "Email" id="clientEmail" >
								</div>
								<div class="inputBox">
									<span class="fas fa-phone"></span>
									<input type="number" placeholder = "Phone number" id="clientPhonenumber">
								</div>
								<div class="inputBox">
									<textarea  rows="4" id="serviceDescription" placeholder="Anything else?">
									</textarea>
								</div>
								<div id="hireStatus"></div>
							<button class="btn" id="hireBtn">Request</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- About section stars -->
<section class="about" id="about">
		<div class="max-width">
			<h2 class="title">About Me</h2>
			<div class="about-content">
				<div class="column left">
					<img src="../resources/images/about.JPG">
				</div>
				<div class="column right">
					<div class="text">I'm Ronald and I am a <span class="typing2"></span></div>
					<?php  foreach($about as $a): ?>
						<?="<p>{$a->content}</p>"?>
					<?php endforeach; ?>
					<a href="../resources/pdf/coderonaldCV.pdf" class="btn">Download CV</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Services section stars -->
<section class="services" id="services">
		<div class="max-width">
			<h2 class="title">My Services</h2>
			<div class="services-content">
				<?php foreach($servicecard as $sc): ?>
				<?= "
				<div class='card'>
					<div class='box'>
						<i class='{$sc->icon}'></i>
						<div class='text'>{$sc->title}</div>
						<p>{$sc->content}</p>
					</div>
				</div>
				" ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<!-- skills section stars -->
<section class="skills" id="skills">
		<div class="max-width">
			<h2 class="title">My skills</h2>
			<div class="skills-content">
				<div class="column left">
					<h2 class="text">My creative skills & experiences.</h2>
					<?php foreach($creativeSkills as $cs): ?>
					<?="<p>{$cs->content}</p>"?>	
					<?php endforeach; ?>
					<a href="#" class="btn">Read More</a>
				</div>
				<div class="column right">
					<div class="bars">
						<div class="info">
							<span>HTML</span>
							<span>90%</span>
						</div>
						<div class="line html"></div>
					</div>
					<div class="bars">
						<div class="info">
							<span>CSS</span>
							<span>60%</span>
						</div>
						<div class="line css"></div>
					</div>
					<div class="bars">
						<div class="info">
							<span>Javascript</span>
							<span>60%</span>
						</div>
						<div class="line js"></div>
					</div>
					<div class="bars">
						<div class="info">
							<span>PHP</span>
							<span>90%</span>
						</div>
						<div class="line php"></div>
					</div>
					<div class="bars">
						<div class="info">
							<span>MySQL</span>
							<span>80%</span>
						</div>
						<div class="line mysql"></div>
					</div>
					<div class="bars">
						<div class="info">
							<span>Java</span>
							<span>50%</span>
						</div>
						<div class="line java"></div>
					</div>
					<div class="bars">
						<div class="info">
							<span>Node js</span>
							<span>50%</span>
						</div>
						<div class="line node"></div>
					</div>
					<div class="bars">
						<div class="info">
							<span>Python</span>
							<span>50%</span>
						</div>
						<div class="line python"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- teams section begins -->
	<section id="teams" class="teams">
		<div class="max-width">
			<h2 class="title">My teams</h2>
				<div class="carousel owl-carousel">
					<?php foreach($team as $t): ?>
					<?="
					<div class='card'>
						<div class='box'>
							<img src='../resources/images/{$t->image}'>
							<div class='text'>{$t->name}</div>
							<p>{$t->skills}</p>
						</div>
					</div>"
					?>
				<?php endforeach; ?>
				</div>
		</div>
	</section>
	<!-- Achievement section stars -->
<section class="achievements" id="achievements">
		<div class="max-width">
			<h2 class="title">Achievements</h2>
			<div class="achievements-content">
				<div class="box">
					<div data-iframe-width="240" data-iframe-height="270" data-share-badge-id="3d8fcea2-3bcb-4b47-872f-0468514ea33c" data-share-badge-host="https://www.credly.com"></div><script type="text/javascript" async src="//cdn.credly.com/assets/utilities/embed.js"></script>
				</div>
			</div>
		</div>
</section>
<section class="ad" style="padding-left: 5rem; padding-right: 5rem; height: 200px; width: 100%;">
	<div class="addbox" style=" background: black">
		Ad
	</div>
</section>
	<!----------------contact us section starts--------------------->
<section class="contact" id="contact">
	<h2 class="title">contact me</h2>
	<div class="row">
		<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.818299072367!2d34.598485364152026!3d-0.0059163355696077976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182aa9f1efed77e9%3A0xb9c8a555cc010ad6!2sMaseno%20University-Kisumu%20Campus!5e0!3m2!1sen!2ske!4v1635888222531!5m2!1sen!2ske" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		<form id="contactMeForm" onsubmit="return false;">
			<h3>get in touch</h3>
			<div class="inputBox">
				<span class="fas fa-user"></span>
				<input type="text" placeholder = "Name" id="name" >
			</div>
			<div class="inputBox">
				<span class="fas fa-envelope"></span>
				<input type="email" placeholder = "Email" id="email" >
			</div>
			<div class="inputBox">
				<span class="fas fa-phone"></span>
				<input type="number" placeholder = "Phone number"  id="phone">
			</div>
			<div class="inputBox">
				<span class="fas fa-envelope"></span>
				<input type="text" placeholder = "Subject"  id="subject">
			</div>
			<div class="inputBox">
				<textarea id="message" ></textarea>
			</div>
			<div id="status"></div>
			<button id="messageBtn" class="btn">Send message</button>
		</form>
	</div>
</section>
<!----------------contact us section ends--------------------->
<section class="ad" style="padding-left: 5rem; padding-right: 5rem;  height: 200px; width: 100%;">
	<div class="addbox" style=" background: black">
		Ad
	</div>
</section>
<!-- Footer section starts -->

<?php require_once('includes/footer.php'); ?>
<script type="text/javascript" src="../resources/js/script.js"></script>
<!-- <script type="text/javascript" src="../resources/js/requestService.js"></script> -->
<script type="text/javascript" src="../resources/js/contactMe.js"></script>
</body>
</html>