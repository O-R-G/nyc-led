<?
// require_once('static/php/composer/vendor/autoload.php');

// get fully-qualified hostname
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $protocol.$_SERVER["HTTP_HOST"];
$success_url = $protocol . 'n-y-c.org' . $requestclean . '/success';
$canceled_url = $protocol . 'n-y-c.org' . $requestclean . '/canceled';

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
	<script src="https://js.stripe.com/v3/"></script>
	<div id="error-message"></div>
<?
}
?>

<script>
(function() {
  // var stripe = Stripe('pk_live_WPSu14Hwjt9VxMIqSznbkiRC');
  var stripe = Stripe('pk_test_WsDyphr31j1ki9BzVhlqmmMA');

  var checkoutButton = document.getElementById('stripe_form_submit');
  if(checkoutButton != null){
  	checkoutButton.addEventListener('click', function () {
	    // When the customer clicks on the button, redirect
	    // them to Checkout.
	    stripe.redirectToCheckout({
	      lineItems: [{price: '<?= $price_id; ?>', quantity: 1}],
	      mode: 'payment',
	      shippingAddressCollection: {
		    allowedCountries: ['US'],
		  },
	      // Do not rely on the redirect to the successUrl for fulfilling
	      // purchases, customers may not always reach the success_url after
	      // a successful payment.
	      // Instead use one of the strategies described in
	      // https://stripe.com/docs/payments/checkout/fulfill-orders
	      successUrl: '<?= $success_url;  ?>',
	      cancelUrl: '<?= $canceled_url;  ?>',
	    })
	    .then(function (result) {
	      if (result.error) {
	        // If `redirectToCheckout` fails due to a browser or network
	        // error, display the localized error message to your customer.
	        var displayError = document.getElementById('error-message');
	        displayError.textContent = result.error.message;
	      }
	    });
	  });
  }
})();
</script>
