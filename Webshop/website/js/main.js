$(function(){
				$('.order-article').submit(function(e){
					e.preventDefault();
					//AJAX
					$.ajax({
						url: '/index.php?action=ajax_cart',
						type: 'POST',
						data: $(this).serialize(),
						success: function(response) {
							$('section.cart-holder').empty().append(response);
						},
						error: function() {
							console.log("Uppppsssss....");
						}
					});
				});
			});