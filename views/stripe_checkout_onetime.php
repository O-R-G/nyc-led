<?
/* 
    build and populate stripe one-time checkout session

    /buy/1996 (1)
    /buy/1996/copies/10 (10)
    /buy/1996/wholesale/100 (100 @ 45% discount)
    /buy/1996/partners/1000 (1000 @ 75% discount)
*/
    
require_once('static/php/composer/vendor/autoload.php');
require_once('static/php/stripe_key.php');

$test = true;
$wholesale = ($uri[3] == 'wholesale');
$partners = ($uri[3] == 'partners');
$copies = ($uri[3] == 'copies');
if (($partners || $wholesale || $copies) && is_numeric($uri[4]));
    $quantity = ($uri[4]); 
$isSuccess = false;
$isCanceled = false;
$isProduct = false;
if ($test) {
    \Stripe\Stripe::setApiKey($stripe_key_test);
} else
    \Stripe\Stripe::setApiKey($stripe_key_live);
if (!($stripe_key_test || $stripe_key_live))
    die('API key not loaded ...');
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $protocol.$_SERVER["HTTP_HOST"];
$success_url = $protocol . $host . $requestclean . '/success';
$canceled_url = $protocol . $host . $requestclean . '/canceled';
// ini_set('display_errors', '1');

/*
    set price, shipping, sales tax, coupon
*/

if ($test) {
    // forced to 1996-test price rather than o-r-g
    $price_id = 'price_1HYvXCKIsFHGARAduanMKl1u';
    $price_id_shipping = 'price_1HaWaPKIsFHGARAdmvRq3hLF';
    $taxrate_ny = 'txr_1Hbe1jKIsFHGARAdZVHSX9A4';
    if ($wholesale)
        $coupon_id = '2swxxLhE';
    if ($partners)
        $coupon_id = 'guiJWtf1'; 
} else {
    if(end($uri) == 'success'){
	    $isSuccess = true;
	    $this_parent_uri = $uri;
	    array_pop($this_parent_uri);
	    array_shift($this_parent_uri);
	    $this_parent = $oo->get(end($oo->urls_to_ids($this_parent_uri)));
	    $price_id = $this_parent['notes'];
    } else {
	    if(end($uri) == 'canceled'){
		    $isCanceled = true;
		    $this_parent_uri = $uri;
		    array_pop($this_parent_uri);
		    array_shift($this_parent_uri);
		    $this_parent = $oo->get(end($oo->urls_to_ids($this_parent_uri)));
		    $price_id = $this_parent['notes'];
	    } else {
		    $isProduct = true;
		    $price_id = $item['notes'];
	    }
	    while(ctype_space(substr($price_id, 0, 1)))
		    $price_id = substr($price_id, 1);
	    while(ctype_space(substr($price_id, strlen($price_id)-1)))
		    $price_id = substr($price_id, 0, strlen($price_id)-1);
    }
    if ($uri[2] == '1996')
        $price_id_shipping = 'price_1I0xAYKIsFHGARAd8Q5sQkn6';
    else if ($uri[2] == 'alice-mackler')
        $price_id_shipping = 'price_1HzCaqKIsFHGARAdcQpMZM1Y';
    else
        $price_id_shipping = 'price_1HzCaqKIsFHGARAdcQpMZM1Y';
    $taxrate_ny = 'txr_1HbeZCKIsFHGARAdBcX9SxD4';
    if ($wholesale)
        $coupon_id = '81MXnu1M'; 
    if ($partners)
        $coupon_id = 'DMa0UOg9'; 
}

/*
    build session

    wholesale = no shipping, no sales tax, and 45% coupon
    partners = no shipping, no sales tax, and 75% coupon
*/

$session_ = [
	'payment_method_types' => ['card'],
	'mode' => 'payment',
	'billing_address_collection' => 'required',
	'shipping_address_collection' => [
		'allowed_countries' => ['US', 'CA'],
	],
	'line_items' => [
		[
		  'price' => $price_id,
		  'quantity' => 1,
		],
    ],
	'success_url' => $success_url,
	'cancel_url' => $canceled_url,
];
if ($wholesale || $partners) {
    $session_[] = [
        'discounts' => [[
            'coupon' => $coupon_id,
        ]],
    ];
    if ($quantity)
        $session_['line_items'][0]['quantity'] = $quantity;
} else {
    $session_['line_items'][0]['dynamic_tax_rates'] = [
		[
            $taxrate_ny,
		],
    ];
    $session_['line_items'][] = [
	'price' => $price_id_shipping,
	'description' => 'Shipping via USPS Priority Mail',
	'quantity' => 1,
    ];
    if ($quantity)
        $session_['line_items'][0]['quantity'] = $quantity;
}

/*
    stripe api
*/

$session = \Stripe\Checkout\Session::create($session_);
if(!$isSuccess && !$isCanceled){
    ?><form id = 'stripe_form' method = 'POST' action = '<? echo $currentUrl; ?>/submitting'>
		<button id = 'stripe_form_submit' type="button">Buy</button>
	</form><?
}
?><script src="https://js.stripe.com/v3/"></script>
<script>
(function() {
  var checkoutButton = document.getElementById('stripe_form_submit');
  var test = <? echo json_encode($test); ?>;
  var stripe_key_test_public = 'pk_test_WsDyphr31j1ki9BzVhlqmmMA';
  var stripe_key_live_public = 'pk_live_WPSu14Hwjt9VxMIqSznbkiRC';;
  if(checkoutButton != null){
  	function redirect(id){
        if (test) {
		    // test public key:
    		var stripe = Stripe(stripe_key_test_public);
        } else {
		    // live public key:
		    var stripe = Stripe(stripe_key_live_public);
        }
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
	checkoutButton.addEventListener('click', function(){
		redirect('<? echo $session->id; ?>');
	});
  }
})();
</script>
