<?
    /*
        display menu item
    */

    $name = $item['name1'];  
    $body = $item['body'];  
?>

<style>
    body {
        background-color: #CCC;    
    }
    #menu {
        background-color: transparent;
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
        
<div id='main' class='centered centeralign'>
    <div id='body' class='nycon multi-column'>
        <div id='date' class='relative'><?
            // echo date('F j, Y h:i:s a');
            echo date('F j, Y');
        ?></div>
        <div id='dates-menu' class='relative' aria-hidden='true'><?    
            $d=strtotime('now');
            for ($i=1; $i<30; $i++) {
                $d=strtotime('- ' .  $i. ' days');
                echo '<a href="" aria-hidden="true">' . date('F j, Y', $d) . '</a><br/>';
                // echo date('F j, Y', $d) . '<br/>';
            }
        ?></div><?
        echo $body;
    ?></div>
</div>

<script src='/static/js/dates-menu.js'></script>
<script src='/static/js/img-zoom.js'></script>
