<?
    /*
        display menu item
    */

    $date = date('F j, Y');
    $name = $item['name1'];  
    $body = $item['body'];  
    $find = '/<div><br><\/div>/';
    $replace = '';
    $body = preg_replace($find, $replace, $body);

    if($uri[1] == 'subscribe'){
        require_once('static/php/createsend-php-6.1.1/csrest_general.php');
        $auth = array('api_key' => 'your API key');
        $wrap = new CS_REST_General($auth);

        $result = $wrap->get_clients();
        var_dump($result->response);
    }
?>
<script src='/static/js/msgs-frontend.js'></script>
<style>
    body {
        background-color: #CCC;    
    }
    #mask {
        position: fixed;
        top: initial; 
        left: 10px;
        bottom: 10px;
        transform: none;
        background-color: inherit; 
    }
</style>

<div id = 'speak_progress_ctner'>
    <div id = 'speak_progress_bar'>
    </div>
</div>
<div id='content'>
    <div id='columns' class='helveticaneuer'>
        <div id='date' class='relative'><? 
            echo $date; 
        ?></div><?
            echo $body;
    ?></div>
</div>
<div id='speak' ><? 
    echo $body; ?>
</div>

<script src='/static/js/img-zoom.js'></script>
<script>
    var form = document.getElementById('mc-embedded-subscribe-form');
    if(form !== null){
        var email_input = document.getElementById('mce-EMAIL');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            if(email_input.value !== ''){
                form.submit();
            }
            else{
                alert('please provide your email');
            }

        });
    }
</script>
