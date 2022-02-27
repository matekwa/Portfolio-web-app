	let myBtn = document.getElementById("myBtn");
	let myModal = document.getElementById("myModal");
	let close = document.getElementsByClassName("close")[0];

	myBtn.onclick = function(){
		myModal.style.display = "block";
	}

	close.onclick = function(){
		myModal.style.display = "none";
	}

	// window.onclick = function(event){
	// 	if (event.target == myModal) {
	// 		myModal.style.display = "none";
	// 	}
	// }


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


	// Typing script
	// 	var typed = new Typed(".typing", {
	// 	strings:["Software Engineer","Dancer","Web Developer","Youtuber","Graphics Designer"],
	// 	typeSpeed:100,
	// 	backSpeed:60,
	// 	loop: true
	// });

	// 	var typed = new Typed(".typing2", {
	// 	strings:["Software Engineer","Dancer","Video Editor","Web Developer","Youtuber"],
	// 	typeSpeed:100,
	// 	backSpeed:60,
	// 	loop: true
	// });

	$('.menu-btn').click(function(){
		$('.navbar .menu').toggleClass("active");
		$('.menu-btn i').toggleClass("active");
	})

	// $('.carousel').owlCarousel({
	// 	margin:20,
	// 	loop:true,
	// 	autoplayTimeOut:2000,
	// 	autoplayHoverPause: true,
	// 	responsive: {
	// 		0:{
	// 			items: 1,
	// 			nav : false
	// 		},
	// 		600:{
	// 			items: 2,
	// 			nav : false
	// 		},
	// 		1000:{
	// 			items: 3,
	// 			nav : false
	// 		}
	// 	}
	// });

});