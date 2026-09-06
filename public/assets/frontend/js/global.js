   /* OwlCarousel Script Start
    ============================================================== */
	
		
		
		if($('#owl-demo-main').length){
		$("#owl-demo-main").owlCarousel({
		  items : 1, //10 items above 1000px browser width
		  itemsDesktop : [1000,1], //5 items between 1000px and 901px
		  itemsDesktopSmall : [900,1], // betweem 900px and 601px
		  itemsTablet: [600,1], //2 items between 600 and 0
		  itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
		});

		// Custom Navigation Events
		$(".next").on('click',function(){
			owl.trigger('owl.next');
		})
		$(".prev").on('click',function(){
			owl.trigger('owl.prev');
		})
	}

$(document).ready(function () {

	
});
