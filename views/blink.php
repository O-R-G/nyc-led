<?
$color = $_GET['color'];
$bg_color = $_GET['bg_color'];
$cursor_color = $_GET['cursor_color'];
if ($color == '') $color = 'FFF';
if ($bg_color == '') $bg_color = '000';
if ($cursor_color == '') $cursor_color = 'FFF';
?>

<style>
    body {
        color: #<?= $color; ?>;
        background-color: #<?= $bg_color; ?>;
    }

    #cursor-container {
        position: fixed;
        left: 28px;
        bottom: 20px;
        white-space: nowrap;
        padding: 0px 0px 0 0px;
    }

    .cursor {
        font-size: 36px;
        color: #<?= $cursor_color; ?>;
    }

    .animate {
        animation-name: blink;
        animation-duration: 1.5s;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        animation-timing-function: ease-out;
    }

    @keyframes blink {
        0%      {opacity: 0.0;}
        25%     {opacity: 1.0;}
        100%    {opacity: 1.0;}
    }

    @keyframes blur {
        from {filter: blur(0px);}
        to {filter: blur(5px);}
    }

    @keyframes color {
        from {color: #FF0;}
        to {color: #FFF;}
    }

</style>

<div id='cursor-container' class='cursor animate'>
    •
</div>





