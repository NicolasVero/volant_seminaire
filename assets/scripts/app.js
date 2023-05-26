$(function(){
//GESTION DU RAFRAÎCHISSEMENT ORIENTATION ET TAILLE ÉCRAN
	// $( window ).on("orientationchange", function(){
	//    	   location.reload();
	// });
	// $( window ).resize( function(){
	//    	   location.reload();
	// });
// SUPPRIMER LES ATTRIBUTS WIDTH, HEIGHT ET SIZES DES IMAGES
	$('img').removeAttr('Width').removeAttr('Height').removeAttr('sizes').removeAttr('srcset');

//NAVIGATION
	if ($('#navigation-container').length ){
			$('#menu-open').click(function(){
				$('#navigation-container').addClass('open');
			});
			$('#menu-close').click(function(){
				$('#navigation-container').removeClass('open');
			});
	}
	
// AJOUT ACTIVITÉ AU FORMULAIRE
	if ($('#list-items-activities').length) {
		$('#list-items-activities li.item-activite-choice').each(function (index) {
			let data_activiteID = $(this).attr('data-activiteID');
			let data_activiteTITLE =  $(this).attr('data-activiteTITLE');
			let html_item = $(this).children().html();
			let form = '<div class="row"><input type="hidden" name="id_activite-' +  data_activiteID + '" value="' +  data_activiteID + '"><input type="hidden" name="titre_activite-' + data_activiteID + '" value="' + data_activiteTITLE + '"><label for="nombre_personnes-' + data_activiteID + '">Nombre de personnes :</label><input type="number" name="nombre_personnes-' + data_activiteID + '"><label for="date_activite-' + data_activiteID + '">Date de l\'activité :</label><input type="date" name="date_activite-' + data_activiteID + '"><label for="lieu_seminaire-' + data_activiteID + '">Lieu du séminaire :</label> <input type="text" name="lieu_seminaire-' + data_activiteID + '"><label for="horaires_debut-' + data_activiteID + '">Horaires :</label> <p>de <input type="time" name="horaires_debut-' + data_activiteID + '"> à <input type="time" name="horaires_fin-' + data_activiteID + '"></p></div>';
			
			// AJOUT 
			$(this).click( function(){
				$('#form-devis').prepend('<div id="titre_activite-' + data_activiteID + '" class="devis-item"><div class="row">' + html_item + '<button class="delete-activite"><i class="ti-trash"></i></button></div>' + form + '</div>');
				$('#titre_activite-' + data_activiteID + ' .ti-plus').remove();
			});

			// SUPPRESSION
			$(document).on('click', '.delete-activite', function() {
				$(this).closest('.devis-item').remove();
			});
		});
	}




//FORMULAIRE DEMANDE DEVIS - HOTEL
	if( $('#hotels').length ){
		$('#hotels').change( function() {
			$('#lieu_seminaire_hotel').prop('disabled', !($(this).is( ':checked' ) ) );
			$('#lieu_seminaire_hotel').val('');
		});
	}	
//FENETRE AJOUT ACTIVITÉ
	// if( $('#add-more-activity').length ){
	// 	$('#container-list-items-activities').slideDown().hide();
	// 	$('#add-more-activity').click( function(e){
	// 		e.preventDefault()
	// 		$('#container-list-items-activities').slideUp().show().addClass('open');
	// 	});
	// }

//FILTRE ACTIVITÉS
	if( $('#filters').length ){
		$('#all').click( function(e){
			e.preventDefault();
			
			$('.item-activite').slideDown();
			$('#filters a').removeClass('actif');
			$(this).addClass('actif');
			
			return false;
		});
		$('.filter').click( function(f){
			f.preventDefault();
			
			var filtre = $(this).attr('id');
			$('.item-activite').hide('slow').removeClass('d-flex');
			$('.item-activite-'+ filtre).show('slow').addClass('d-flex');
			$('#filters a').removeClass('actif');
			$(this).addClass('actif');
			
			return false;
		});
		$('#filters').slick({
			infinite: false,
			dots: false,
			focusOnSelect: true,
			slidesToScroll: 1,
			appendArrows: $('#navigation-activities'),
			prevArrow:'<button type="button" class="slick-prev d-flex justify-content-center align-items-center"><i class="ti-arrow-left"></i></button>',
			nextArrow:'<button type="button" class="slick-next d-flex justify-content-center align-items-center"><i class="ti-arrow-right"></i></button>',
			swipeToSlide: true,
			responsive: [
				{
					breakpoint: 576,
					settings:{
						arrows: false,
						dots: false,
						slidesToShow: 3
					}
				}
			]
		});
	}



// if ( $('#add-activite-button').length ){
// 
// 		var buttons = document.querySelectorAll('.add-activite-button');
// 
// 		buttons.forEach(function(button) {
// 			button.addEventListener('click', function() {
// 				var activiteUrl = this.dataset.activiteUrl;
// 				var formUrl = '<?php echo get_permalink(1); ?>?activite=' + encodeURIComponent(activiteUrl);
// 				window.open(formUrl, '_blank');
// 				console.log(activiteUrl);
// 			});
// 		});
// 	
// }	
	
// ICON NAVIGATION 
	// if( $('.site-navigation').length ){
	// 	$('.site-navigation .menu-item a').addClass('d-flex align-items-center justify-content-center');
	// 	$('.site-navigation .sub-menu').addClass('d-flex flex-column flex-md-row align-items-center justify-content-center');
	// 	$('.site-navigation .sub-menu a').addClass('content-link-vehicule d-flex flex-row flex-md-column align-items-center justify-content-between justify-content-md-end').append('<button class="icon-fleche ti-arrow-right order-last"></button>');
	// }
//NEWS HOME
	// if( $('.container-news-home').length ){
	// 	$('.container-news-home .wp-block-group__inner-container').addClass('d-flex flex-column flex-lg-row');
	// }
//RESPONSIVE
	// if( $( window ).width() < 768 ){
	// 	//NAVIGATION 
	// 	if($('.header-site').length ){
	// 		
	// 		var nav = $('#site-navigation').html();
	// 		$('#main-header').append('<nav class="site-navigation">' + nav + '</nav>');
	// 		$('#site-navigation').remove();
	// 		
	// 		$('.menu-open-mobile').on('click', function(event){
	// 			event.preventDefault();
	// 			$('.menu-open-mobile').toggleClass('on');
	// 			$('.site-navigation').toggleClass('on');
	// 			$('.overlay').toggleClass('on');
	// 		});	
	// 	}
	// 	if( $('.menu-item-has-children').length ){
	// 		$('.menu-item-has-children a').first().removeClass('d-flex').addClass('d-none');	
	// 		
	// 			var spanNeufs = $('.menu-item-has-children ul li.vehicules-neufs a span').html();
	// 			var strongNeufs = $('.menu-item-has-children ul li.vehicules-neufs a strong').html();
	// 			var spanOccas = $('.menu-item-has-children ul li.vehicules-occasions a span').html();
	// 			var strongOccas = $('.menu-item-has-children ul li.vehicules-occasions a strong').html();
	// 			
	// 			$('.menu-item-has-children ul li a span').remove();
	// 			$('.menu-item-has-children ul li a strong').remove();
	// 			
	// 			$('.menu-item-has-children ul li.vehicules-neufs a').prepend('<div class="submenu-title order-2"><span>' + spanNeufs + '</span><strong>' + strongNeufs + '</strong></div>' );
	// 			$('.menu-item-has-children ul li.vehicules-occasions a').prepend('<div class="submenu-title order-2"><span>' + spanOccas + '</span><strong>' + strongOccas + '</strong></div>' );
	// 	}
	// 	//SLIDER HOME
	// 	if( $('.slider-home').length ){
	// 		$('.container-title-article-slide button').remove();
	// 		$('.articles-slides-home a').append('<button class="icon-fleche ti-arrow-right" tabindex="-1"></button>');
	// 	}
	// 	//FILTRE CATALOGUE
	// 	// if( $('#content-sidebar-filters').length ){
	// 	// 	var menu = $('#content-sidebar-filters').html();
	// 	// 	
	// 	// }
	// }	
	
//NAVIGATION DROPDOWN
	// if( $( window ).width() <= 769 ){
	// 	if( $('.menu-item-has-children').length ){
	// 		$('.menu-item-has-children').click(function(){
	// 			// e.preventDefault();
	// 			// console.log('on');
	// 			$(this).toggleClass('on').prev().removeClass('on');
	// 			$('#container-page-single-tax').toggleClass('scroll-content');
	// 		});
	// 	}
	// }else if ( $( window ).width() >= 1200) {
	// 	if( $('.menu-item-has-children').length ){
	// 		$('.menu-item-has-children').hover(function(e){
	// 			e.preventDefault();
	// 			// console.log('on');
	// 			$(this).toggleClass('on').prev().removeClass('on');
	// 			$('#container-page-single-tax').toggleClass('scroll-content');
	// 		});
	// 	}
	// }
	//NAVIGATION POST
	// if( $('.post-navigation').length ){
	// 	$('.post-navigation a').addClass('d-flex flex-column flex-md-row');
	// 	$('.nav-links').addClass('d-flex justify-content-between d-lg-block');
	// }
//WIDGET RECHERCHE
	// if($('.widget-search').length){
	// 	$('.widget-search a').click(function(e){
	// 		e.preventDefault();
	// 		$('.widget-search').toggleClass('search-on');
	// 		$('.search-form-container').toggleClass('search-on');
	// 		$('.overlay').toggleClass('on');
	// 	});
	// }
//SÉCURISATION WIDGET TEL
	// if( $('#widget-tel').length ){
	// 	$('#widget-tel').click(function() {
	// 	  var PhoneNumber = $(this).text();
	// 	  PhoneNumber = PhoneNumber.replace('<i class="ti-mobile"></i>', '');
	// 	  window.location.href = 'tel://' + PhoneNumber;
	// 	});
	// }
	// if( $('#widget-tel-footer').length ){
	// 	$('#widget-tel-footer').click(function() {
	// 	  var PhoneNumber = $(this).text();
	// 	  PhoneNumber = PhoneNumber.replace('<i class="ti-mobile"></i>', '');
	// 	  window.location.href = 'tel://' + PhoneNumber;
	// 	});
	// }
//FORM VÉHICULES
	// if($('#form-type-vehicule').length){
	// 	var type = $('.contact-form-vehicule input').val();
	// 	$('#form-type-vehicule span').append('<b>' + type + '</b>');
	// 	$('#form-type-vehicule span input').remove();
	// }
//FORM CONTACT
	// if($('.select-contact').length){
	// 	$('.select-contact').selectmenu();
	// }
//IMAGE STAR SINGLE
// if($('#star-tax-single').length ){
// 	var img = $('#star-tax-single').attr('data-img');
// 	$('#bg-star-tax-single').css( 'background', 'url(' + img + ') no-repeat left -5% top');
// }
// 	
//SLIDER HOME
// if( $( window ).width() <= 700 ){
// 	if( $('.slider-home').length ){
// 		$('.slider-home').slick({
// 						autoplay: true,
// 						autoplaySpeed: 4000,
// 						arrows: false,
// 						dots: false,
// 						slidesToScroll: 1
// 		});
// 	}
// }else{
// 	$('.slider-home').slick({
// 		dots: true,
// 		infinite: true,
// 		speed: 1000,
// 		slidesToShow: 1,
// 		autoplay: true,
// 		autoplaySpeed: 4000,
// 		fade: true,
// 		arrows: false
// 	});
// }
//SLIDER HOME & GALERIE PRODUCTS 
// if( $( window ).width() >= 769 ){
// 	if( $('#module-gallery').length ){
// 		$('.slider-thumb').slick({
// 			autoplay: false,
// 			vertical: true,
// 			infinite: true,
// 			verticalSwiping: false,
// 			slidesPerRow: 1,
// 			slidesToShow: 3,
// 			arrows: false,
// 			asNavFor: '.slider-preview',
// 			focusOnSelect: true,
// 		});
// 		$('.slider-preview').slick({
// 			autoplay: false,
// 			vertical: true,
// 			infinite: true,
// 			slidesPerRow: 1,
// 			slidesToShow: 1,
// 			asNavFor: '.slider-thumb',
// 			arrows: true,
// 			prevArrow: '<button type="button" class="slick-prev"><i class="ti-angle-up"></i></button>',
// 			nextArrow: '<button type="button" class="slick-next"><i class="ti-angle-down"></i></button>',
// 			draggable: false,
// 		});
// 		$('.pop-up').magnificPopup({
// 			type: 'image',
// 			gallery:{
// 				enabled: true,
// 				tCounter: ''
// 			}
// 		});
// 	}
// }else{
// 	if( $('#module-gallery').length ){
// 		$('.slider-thumb').slick({
// 			autoplay: false,
// 			infinite: true,
// 			slidesPerRow: 3,
// 			slidesToShow: 3,
// 			arrows: false,
// 			asNavFor: '.slider-preview',
// 			focusOnSelect: true,
// 		});
// 		$('.slider-preview').slick({
// 			autoplay: false,
// 			infinite: true,
// 			slidesPerRow: 1,
// 			slidesToShow: 1,
// 			asNavFor: '.slider-thumb',
// 			arrows: false,
// 			prevArrow: '<button type="button" class="slick-prev"><i class="ti-angle-up"></i></button>',
// 			nextArrow: '<button type="button" class="slick-next"><i class="ti-angle-down"></i></button>',
// 			draggable: false,
// 		});
// 		$('.pop-up').magnificPopup({
// 			type: 'image',
// 			gallery:{
// 				enabled: true,
// 				tCounter: ''
// 			}
// 		});
// 	}
// }
//FONCTION ÉTENDUE POPUP
	// $.extend(true, $.magnificPopup.defaults, {
	// 		closeMarkup: '<button title="%title%" type="button" class="mfp-close"><i class="ti-close"></i></button>',
	// 		gallery: {
	// 			tPrev: '',
	// 			tNext: ''
	// 		},
	// });	
//CAROUSEL STICKY PRODUCTS
	// if( $('#carousel-sticky').length ){
	// 	$('#carousel-sticky').slick({
	// 		dots: false,
	// 		autoplay: true,
	// 		infinite: true,
	// 		slidesToShow: 4,
	// 		slidesToScroll: 1,
	// 		prevArrow: '<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',
	// 		nextArrow: '<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',
	// 		draggable: false,
	// 		responsive: [
	// 			{
	// 				breakpoint: 769,
	// 				settings: {
	// 					slidesToShow: 2,
	// 					slidesToScroll: 1
	// 				}
	// 			},
	// 			{
	// 				breakpoint: 479,
	// 				settings: {
	// 					slidesToShow: 1,
	// 					slidesToScroll: 1
	// 				}
	// 			},
	// 		]
	// 	});
	// }
//BUTTON UP
	if($('.btn-return-top').length ){
		$('.btn-return-top').click(function(){
			$('html,body').animate({scrollTop: 0}, 'slow');
		});
	}
//SCROLL TO ANCHOR
	// if( $('.scroll').length ) {
	// 	// console.log('scroll');
	// 	$('.scroll a[href^="#"]').click(function(f) {
	// 		f.preventDefault();
	// 		cible=$(this).attr('href');
	// 		if($(cible).length>=1){
	// 			haut=$(cible).offset().top;
	// 		}
	// 		$('html,body').animate({scrollTop:haut},2000,'easeOutQuint');
	// 		return false;
	// 	});
	// }
	// if( $('.button-360').length ) {
	// 	// console.log('scroll');
	// 	$('.button-360[href^="#"]').click(function(f) {
	// 		f.preventDefault();
	// 		cible=$(this).attr('href');
	// 		if($(cible).length>=1){
	// 			haut=$(cible).offset().top;
	// 		}
	// 		$('html,body').animate({scrollTop:haut},2000,'easeOutQuint');
	// 		return false;
	// 	});
	// }
//AJOUT DE CLASSES AUX MÉDIAS SOCIAUX
	if ($('#navigation-medias-sociaux').length){
		if ($('.facebook').length){
		$('.facebook a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-facebook-square"></i>');
		}
		if ($('.pinterest').length){
		$('.pinterest a').addClass('btn-widget widget-social d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-pinterest-square"></i>');
		}
		if ($('.twitter').length){
		$('.twitter a').addClass('btn-widget widget-social d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-twitter-square"></i>');
		}
		if ($('.linkedin').length){
		$('.linkedin a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-linkedin"></i>');
		}
		if ($('.youtube').length){
		$('.youtube a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-youtube"></i>');
		}
		if ($('.instagram').length){
		$('.instagram a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-instagram-square"></i>');
		}
		if ($('.google').length){
		$('.google a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-google-plus-square"></i>');
		}
	}	
//SINGLE
//MOTS-CLÉS
		// if( $('#meta-mots-cles').length ){
		// 	var content_meta = $('#meta-mots-cles .mots_cles ul').html();
		// 	$('.mots_cles ul').remove();
		// 	$('#meta-mots-cles').append('<ul class="meta-mots-cles-list d-flex">' + content_meta + '</ul>');
		// 	
		// 	var title_meta = $('.mots_cles').html();
		// 	$('.mots_cles').remove();
		// 	$('#meta-mots-cles').prepend('<h3 class="title-meta-list">' + title_meta + '</h3>');
		// 	$('.cat-item a').prepend('#');
		// }
//NEWS
	// if( $('#liste-articles-news').length ){
	// 		$('#liste-articles-news').append('<div id="list-item-news" class="list-item-news container"><ul class="row"></ul></div>');
	// 		$('#liste-articles-news').find('.post-news-vignette').each(function(){
	// 			news = $(this).html();
	// 			$('#list-item-news ul').append(news);
	// 			$(this).remove();			
	// 		});	
	// }
	// if( $('.post-navigation').length ){
	// 	$('.post-navigation h2').remove();
	// }	
});