<?
    /*
        display menu item
    */

    $name = $item['name1'];  
    $body = $item['body'];  
    $find = '/<br>/';
    $replace = '';
    $body = preg_replace($find, $replace, $body);
    $find = '/<div><\/div>/';
    $replace = '';
    $body = preg_replace($find, $replace, $body);
    // $find = '/<\/div>/';
    // $replace = '<br></div>';
    // $body = preg_replace($find, $replace, $body);
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
<div id = 'speak_progress_ctner'><div id = 'speak_progress_bar'></div></div>
<div id='main' class='centered centeralign'>
    <div id='body' class='helveticaneuer multi-column'>
        <div id='date' class='relative'><?
            // echo date('F j, Y h:i:s a');
            echo date('F j, Y');
        ?></div><?
        echo $body;
    ?></div>

</div>
<div id='speak' ><? echo $body; ?></div>
<!-- <script src='/static/js/dates-menu.js'></script> -->
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
