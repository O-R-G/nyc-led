<?
/*
    process and validate donate form

    $_POST  =>  'name'
                'name_to_acknowledge'
                'mailing_address'
                'email'
                'telephone'
                'amount'
                'payment_method'
*/

/*
// debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

if(isset($_POST['amount']) &&
	intval($_POST['amount']) &&
	isset($_POST['payment_method']) &&
	($_POST['payment_method'] == 'stripe' || 
    $_POST['payment_method'] == 'check or wire')){

    // cleanup_ $_POST by reference (note '&')
    foreach($_POST as $key => &$value) {
        $value = cleanup_($key, $value);
    }

    // validate email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $_POST['email'] = "Please enter a valid email.";
        $error = true;
    }

    if (!$error) {

	    // generate email

	    // $debug = true;
	    $live = true;

	    $msg  = "New York Consolidated has received a donation.\r\n\r\n";
	    $msg .= $_POST['name'] . "\r\n";
	    $msg .= $_POST['name_to_acknowledge'] . "\r\n";
	    $msg .= $_POST['mailing_address'] . "\r\n";
	    $msg .= $_POST['email'] . "\r\n";
	    $msg .= $_POST['telephone'] . "\r\n\r\n";
	    $msg .= '$' . $_POST['amount'] . "\r\n";
	    $msg .= 'Payment by ' . $_POST['payment_method'] . "\r\n";
	    $msg = wordwrap($msg,70);

	    // $headers = "From: donations@n-y-c.org";
	    // $headers = "From: info@n-y-c.org";

        $headers = 'From: info@n-y-c.org' . "\r\n" ;
        $headers .='Reply-To: info@n-y-c.org' . "\r\n" ;
        $headers .='X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";  

	    // send email
	    if ($debug)
		    mail("reinfurt@o-r-g.com","New York Consolidated donation",$msg,$headers);
	    if ($live)
		    // $test = mail("mia@n-y-c.org","New York Consolidated donation",$msg,$headers);
		    mail("forward@o-r-g.com","New York Consolidated donation",$msg,$headers);

	    // if paying online then continue to stripe
	    // otherwise redirect to /thank-you

	    if ($_POST['payment_method'] != "stripe") {
		    ?><script>window.location.replace('/donate/submitted');</script><?
	    } else {

		    // processing entered amount and call stripe
		    $amount = intval($_POST['amount']);
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
    
		    ?><script src="https://js.stripe.com/v3/"></script>
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
		    </script><?
	    }
    }
}

/*
// /donate?xxx
$amount = 0;
if ($_GET && intval($_GET))
	$amount = array_key_first($_GET);
*/

// catch exceptions for success and cancel
if ($uri[2] != 'success' && $uri[2] != 'canceled' && $uri[2] != 'submitted'){

	// display form
	?><div id="donate-form">
		<div class="break">&nbsp;</div>
		<div id="donate-form-title"><?
			echo $deck;
		?></div>
		<form action='<?= $requestclean; ?>' method='post' class='no-break'>
			<input type="text" name="name" placeholder="Name" value="<?= $_POST['name']; ?>">
			<input type="text" name="name_to_acknowledge" placeholder="(Name to acknowledge)" value="<?= $_POST['name_to_acknowledge']; ?>">
			<textarea type="text" name="mailing_address" placeholder="Mailing address" rows="4" cols="100"><?= $_POST['mailing_address']; ?></textarea>
			<input type="text" name="email" placeholder="Email" value="<?= $_POST['email']; ?>">
			<input type="text" name="telephone" placeholder="Telephone" value="<?= $_POST['telephone']; ?>">
			<select id="amount" name="amount">
				<option value=""> Select an amount ...</option>
				<option value=""></option>
				<option value="100"> $100</option>
				<option value="250"> $250</option>
				<option value="500"> $500</option>
				<option value="1000"> $1000</option>
				<option value="2500"> $2500</option>
				<option value="5000"> $5000 </option>
				<option value="7500"> $7500</option>
				<option value="10000"> $10000</option>
			</select>
			<select id="payment" name="payment_method">
				<option value=""> Select a payment method ...</option>
				<option value=""></option>
				<option value="stripe"> Continue online (credit card, Apple Pay)</option>
				<option value="check or wire"> Please send me the details for a check/wire transfer</option>
			</select>
			<input type="submit" id="stripe_form_submit">
		</form>
        <div class="break">&nbsp;</div>
        <div class="break">&nbsp;</div>
        <div class="break">&nbsp;</div>
        <div class="break">&nbsp;</div>
        <div class="break">&nbsp;</div>
	</div>
	<script>
		// add form to dom
		var columns = document.getElementById("columns");
		var donate_form = document.getElementById("donate-form");
		columns.appendChild(donate_form);
	</script><?
}
// test_ form input, cleanup
function cleanup_($key, $value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
?><script>
	var amount = <?= $amount; ?>;
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
