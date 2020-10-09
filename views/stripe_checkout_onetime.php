<?
require_once('static/php/composer/vendor/autoload.php');

// live secret key
// \Stripe\Stripe::setApiKey('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');

// test secret key
\Stripe\Stripe::setApiKey('sk_test_51BF2u5KIsFHGARAdD1rbqEPotLTaA6nZ1OCs3A9rx3Ebu3hchZzVRfwQBYOTgdbNkpvCYUFQLtz2qrRY88nakySi00Yv1NabjT');

// get fully-qualified hostname
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $protocol.$_SERVER["HTTP_HOST"];
$success_url = $protocol . 'n-y-c.org' . $requestclean . '/success';
$canceled_url = $protocol . 'n-y-c.org' . $requestclean . '/canceled';

$session = \Stripe\Checkout\Session::create([
	'payment_method_types' => ['card'],
	'mode' => 'payment',
	'billing_address_collection' => 'required',
	'shipping_address_collection' => [
		'allowed_countries' => ['US', 'CA'],
	],
	'line_items' => [
		[
		  'price' => 'price_1HYvXCKIsFHGARAduanMKl1u',
		  'quantity' => 1,
		  // 'tax_rates' => ['txr_1Ha1KUKIsFHGARAdJy9u0CCw'],
		],
	],
	'success_url' => $success_url,
	'cancel_url' => $canceled_url,
]);


$isSuccess = false;
$isCanceled = false;
$isProduct = false;

if(end($uri) == 'success'){
	$isSuccess = true;
}
else{
	if(end($uri) == 'canceled'){
		$isCanceled = true;
		$this_parent_uri = $uri;
		array_pop($this_parent_uri);
		array_shift($this_parent_uri);
		$this_parent = $oo->get(end($oo->urls_to_ids($this_parent_uri)));
		$price_id = $this_parent['notes'];
	}
	else{
		$isProduct = true;
		$price_id = $item['notes'];
	}
	while(ctype_space(substr($price_id, 0, 1)))
		$price_id = substr($price_id, 1);
	while(ctype_space(substr($price_id, strlen($price_id)-1)))
		$price_id = substr($price_id, 0, strlen($price_id)-1);
}
if(!$isSuccess && !$isCanceled){
?>
	<form id = 'stripe_form' method = 'POST' action = '<? echo $currentUrl; ?>/submitting'>
		<button id = 'stripe_form_submit' type="button">Buy</button>
	</form>
<?
}
?>
<script src="https://js.stripe.com/v3/"></script>
<script>
(function() {
  var checkoutButton = document.getElementById('stripe_form_submit');
  if(checkoutButton != null){
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
  }
})();
</script>
