$(function(){
				$('#form').submit(function(e){
					e.preventDefault();
					//AJAX
					$.ajax({
						url: '/ajax/cart.php',
						type: 'POST',
						data: $(this).serialize(),
						success: function(response) {
							$('.order-atricle').fadeOut(500, function(){
									$(this).empty().append(response).fadeIn(500);
							});
						},
						error: function() {
							console.log("Uppppsssss....");
						}
					});
				});
			});