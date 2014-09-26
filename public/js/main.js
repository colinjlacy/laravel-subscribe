// This identifies your website in the createToken call below
Stripe.setPublishableKey('pk_test_Pel36Th96c7rTyFdQ5myPO32');

var stripeResponseHandler = function(status, response) {
	var $form = $('#payment-form');

	if (response.error) {
		// Show the errors on the form
		$form.find('#payment-errors').text(response.error.message).addClass('alert alert-danger');
		window.scrollTo("#title", 200);
		$form.find('.btn').prop('disabled', false).removeClass('disabled');
	} else {
		// token contains id, last4, and card type
		var token = response.id;
			//last4 = response.card.last4,
			//sub = response.subscriptions.data.id,
			//plan = response.subscriptions.data.plan.id;

		// Insert the token into the form so it gets submitted to the server
		$form.append($('<input type="hidden" name="stripeToken" />').val(token));
		//$form.append($('<input type="hidden" name="stripe_subscriptions" />').val(sub));
		//$form.append($('<input type="hidden" name="stripe_plan" />').val(plan));
		//$form.append($('<input type="hidden" name="stripe_active" />').val(1));
		//$form.append($('<input type="hidden" name="last_four" />').val(last4));

		// and re-submit
		$form.get(0).submit();
	}
};
// On click...
jQuery(function($) {
	$('#payment-form').submit( function(e) {

		e.preventDefault();

		var $form = $(this);

		// Disable the submit button to prevent repeated clicks
		$form.find('.btn').prop('disabled', true).addClass('disabled');

		Stripe.createToken({
			number: $('.card-number').val(),
			cvc: $('.card-cvc').val(),
			exp_month: $('.card-expiry-month').val(),
			exp_year: $('.card-expiry-year').val()
			//plan: 'laravelplan1'
		}, stripeResponseHandler);

		// Prevent the form from submitting with the default action
		return false;
	});
});