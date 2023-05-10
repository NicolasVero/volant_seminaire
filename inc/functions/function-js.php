
<script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>
<script>
	
	
	$(document).ready( function() {
		$('#open-menu').click( function() {
			$('#list-items-activities').slideDown(500);
		});
	});
	
	
	// console.log(document.getElementById('open-menu'));
	
	// $(document).ready( function() {
	// 	$('#hotels').change( function() {
	// 		if($(this).is( ':checked' ) ) {
	// 			$('#lieu_seminaire_hotel').prop('disabled', false);
	// 			console.log('checked');
	// 		} else {
	// 			$('#lieu_seminaire_hotel').prop('disabled', true);
	// 			console.log('not checked');
	// 			$('#lieu_seminaire_hotel').val('');
	// 		}
	// 	});
	// });	
	
	$(document).ready( function() {
		$('#hotels').change( function() {
			$('#lieu_seminaire_hotel').prop('disabled', !($(this).is( ':checked' ) ) );
			$('#lieu_seminaire_hotel').val('');
		});
	});	
	
	
	
</script>