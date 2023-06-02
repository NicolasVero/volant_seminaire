$(function(){
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
				
				var DivnewTransform = 0 + 'px';
				$('#container-list-items-activities').css( 'transform', 'translateY(' + DivnewTransform + ')').removeClass('open');
				
				var DivformHeight = $('#container-article-page-devis').height();
				var DivtotalHeight = DivformHeight + 63;		
				$('.main-page-devis').css('height', DivtotalHeight);
				
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
	if( $('#add-more-activity').length ){
		
		var DivformHeight = $('#container-article-page-devis').height();
		var DivtotalHeight = DivformHeight + 63;		
		$('.main-page-devis').css('height', DivtotalHeight);
		
		$('#add-more-activity').click( function(e){
			e.preventDefault();
			var DivnewTransform = $('#container-article-page-devis').height();
			var DivnewTransform = '-' + DivformHeight + 'px';
			// var TotalHeight = DivformHeight + 50;
			// var DivnewTransform = '-' + DivformHeight + 'px';
			
			$('#container-list-items-activities').addClass('open').css( 'transform', 'translateY(' + DivnewTransform + ')');
		});
		$('#button-close').click( function(e){
			e.preventDefault();
			var DivnewTransform = 0 + 'px';
			
			$('#container-list-items-activities').css( 'transform', 'translateY(' + DivnewTransform + ')').removeClass('open');
			
		});
	}

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
			infinite: true,
			dots: false,
			slidesToShow: 10,
			slidesToScroll: 1,
			appendArrows: $('#navigation-activities'),
			prevArrow:'<button type="button" class="slick-prev d-inline-block"><i class="fa-solid fa-angle-left"></i></button>',
			nextArrow:'<button type="button" class="slick-next d-inline-block"><i class="fa-solid fa-angle-right"></i></button>',
			responsive: [
				{
					breakpoint: 576,
					settings:{
						arrows: false,
						dots: false,
						slidesToShow: 3,
						appendArrows: $('#navigation-activities'),
						prevArrow:'<button type="button" class="slick-prev d-inline-block"><i class="fa-solid fa-angle-left"></i></button>',
						nextArrow:'<button type="button" class="slick-next d-inline-block"><i class="fa-solid fa-angle-right"></i></button>',
					}
				}
			]
		});
	}
//WIDGET RECHERCHE
	if($('.widget-search').length){
		$('.widget-search a').click(function(e){
			e.preventDefault();
			$('.widget-search').toggleClass('search-on');
			$('.search-form-container').toggleClass('search-on');
			$('.overlay').toggleClass('on');
		});
	}

//OUVRIR RECHERCHE 

var widgetSearch = document.getElementById('widget-search');
var searchFormContainer = document.getElementById('search-form-container');

widgetSearch.addEventListener('click', function(event) {
	event.preventDefault();
	searchFormContainer.classList.toggle('search-form-visible');
});


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

//BUTTON UP
	// if($('.btn-return-top').length ){
	// 	$('.btn-return-top').click(function(){
	// 		$('html,body').animate({scrollTop: 0}, 'slow');
	// 	});
	// }

//AJOUT DE CLASSES AUX MÉDIAS SOCIAUX
	// if ($('#navigation-medias-sociaux').length){
	// 	if ($('.facebook').length){
	// 	$('.facebook a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-facebook-square"></i>');
	// 	}
	// 	if ($('.pinterest').length){
	// 	$('.pinterest a').addClass('btn-widget widget-social d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-pinterest-square"></i>');
	// 	}
	// 	if ($('.twitter').length){
	// 	$('.twitter a').addClass('btn-widget widget-social d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-twitter-square"></i>');
	// 	}
	// 	if ($('.linkedin').length){
	// 	$('.linkedin a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-linkedin"></i>');
	// 	}
	// 	if ($('.youtube').length){
	// 	$('.youtube a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-youtube"></i>');
	// 	}
	// 	if ($('.instagram').length){
	// 	$('.instagram a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-instagram-square"></i>');
	// 	}
	// 	if ($('.google').length){
	// 	$('.google a').addClass('btn-widget d-flex align-items-center align-items-start justify-content-center').append('<i class="fab fa-google-plus-square"></i>');
	// 	}
	// }	
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
});