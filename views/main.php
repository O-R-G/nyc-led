<?
    /*
        display menu item
    */

    $date = date('F j, Y');
    $name = $item['name1'];
    $body = $item['body'];
    $deck = $item['deck'];
    $find = '/<div><br><\/div>/';
    $replace = '';
    $body = preg_replace($find, $replace, $body);
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

<div id='speak_progress_ctner'>
    <div id='speak_progress_bar'></div>
</div>
<div id='img-zoom-bg'></div>
<div id='content'>
    <div id='columns' class='helveticaneuer'>
        <div id='date' class='relative'><?
            echo $date;
        ?></div><?
            echo $body;
    ?></div>
</div>

<div id='speak' >
    <? echo $body; ?>
</div>

<script src='/static/js/img-zoom.js'></script>
