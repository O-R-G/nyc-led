<? 
if(isset($_POST['donate_amount']) && intval($_POST['donate_amount'])){
	// processing entered amount and call stripe
	$amount = intval($_POST['donate_amount']);
	$amount = $amount * 100;
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$host = $protocol.$_SERVER["HTTP_HOST"];

	$success_url = $host.'/donate/success';
	$canceled_url = $host.'/donate/canceled';

	require_once('static/php/composer/vendor/autoload.php');

	// live secret key
	// \Stripe\Stripe::setApiKey('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');

	// test secret key
	\Stripe\Stripe::setApiKey('sk_test_51BF2u5KIsFHGARAdD1rbqEPotLTaA6nZ1OCs3A9rx3Ebu3hchZzVRfwQBYOTgdbNkpvCYUFQLtz2qrRY88nakySi00Yv1NabjT');

	$session = \Stripe\Checkout\Session::create([
		'payment_method_types' => ['card'],
		// 'mode' => 'payment',
		'billing_address_collection' => 'required',
		'submit_type' => 'donate',
		'line_items' => [
			[
				'name' => 'Donate $'. $amount/100 .' to New York Consolidated',
			    'amount' => $amount,
			    'currency' => 'usd',
			    'quantity' => 1
			]],
		'success_url' => $success_url,
		'cancel_url' => $canceled_url,
	]);

	?>
	<script src="https://js.stripe.com/v3/"></script>
	<script>
	(function() {
	  	function redirect(id){
			// live public key:
			// var stripe = Stripe('pk_live_WPSu14Hwjt9VxMIqSznbkiRC');
			// test public key:
			var stripe = Stripe('pk_test_WsDyphr31j1ki9BzVhlqmmMA');

			stripe.redirectToCheckout({
			  // Make the id field from the Checkout Session creation API response
			  // available to this file, so you can provide it as parameter here
			  // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
			  sessionId: id
			}).then(function (result) {
			  // If `redirectToCheckout` fails due to a browser or network
			  // error, display the localized error message to your customer
			  // using `result.error.message`.
			  result.error.message = 'error';
			});
		}
		redirect('<? echo $session->id; ?>');
	})();
	</script>

	<?
}
else if(!$uri[2])
{
	// /donate?xxx
	$amount = 0;
	if ($_GET && intval($_GET))
		$amount = array_key_first($_GET);

	?>
	<script>
		var amount = <?= $amount ?>;
		var sDonate_amount = document.getElementById('donate_amount');
		if(amount)
		{
			sDonate_amount.value = amount;
			sDonate_amount.classList.add('locked');
		}
		var sStripe_form_submit = document.getElementById('stripe_form_submit');
		var sDonate_form = document.getElementById('donate_form');
		sStripe_form_submit.addEventListener('click', function(e){
			e.preventDefault();
			if(sDonate_amount.value == '' || isNaN(parseFloat(sDonate_amount.value))){
				alert('Please enter a valid amount');
			}
			else
			{
				sDonate_form.submit();
			}
		});
	</script>
<?
}
else
{
	// /donate/success or /donate/canceled
}








?>

