<?
$color = $_GET['color'];
$bg_color = $_GET['bg_color'];
$cursor_color = $_GET['cursor_color'];
$cursor_only = $_GET['cursor_only'];
if ($color == '') $color = 'FFF';
if ($bg_color == '') $bg_color = '000';
if ($cursor_color == '') $cursor_color = 'FFF';
?>

<style>
    body {
        color: #<?= $color; ?>;
        background-color: #<?= $bg_color; ?>;
    }

    .box {
        font-size: 30px;
        white-space: nowrap;
        padding: 0px 100px 0 100px;
    }

    .blur {
        cursor: pointer;
        filter: blur(5px);
        transition: 0.4s filter ease-out;
    }

    .blur:hover {
        filter: blur(0px);
    }

    .cursor {
        color: #<?= $cursor_color; ?>;
    }

    .cursor-only {
        <? if ($cursor_only) echo 'display: none;'; ?>
    }

    .animate {
        animation-name: blur;
        animation-duration: 1.0s;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        animation-timing-function: ease-out;
    }

    .padded {
        padding-right: 5px;
    }

    .letterspaced {
        letter-spacing: 5px;
    }

    .letterspaced-more {
        letter-spacing: 10px;
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

<!-- -->

<div class='box'>
&nbsp;
</div>

<div class='box letterspaced-more'>
<span class='cursor animate'>—</span><span class='cursor-only'>NEW YORK<br/>CONSOLIDATED</span>
</div>

<div class='box'>
&nbsp;
</div>

<div class='box letterspaced-more'>
<span class='cursor animate cursor-only'>—</span><span class='cursor-only'>N<br/>YC</span>
</div>

<div class='box'>
&nbsp;
</div>

<div class='box letterspaced-more'>
<span class='cursor-only'>N</span><span class='cursor animate cursor-only'>—</span><br/><span class='cursor-only'>YC</span>
</div>

<!-- -->

<div class='box blur'>
&nbsp;
</div>

<div class='box blur cursor-only'>
–––––––––––––––––––––
</div>

<div class='box blur cursor-only'>
—————————————————————
</div>

<div class='box blur cursor-only'>
•••••••••••••••••••••
</div>

<div class='box blur cursor-only'>
NEW YORK CONSOLIDATED
</div>

<!-- -->    

<div class='box blur'>
&nbsp;
</div>

<div class='box blur cursor-only letterspaced'>
–––––––––––––––––––––
</div>

<div class='box blur cursor-only letterspaced'>
—————————————————————
</div>

<div class='box blur cursor-only letterspaced'>
•••••••••••••••••••••
</div>

<div class='box blur cursor-only letterspaced'>
NEW YORK CONSOLIDATED
</div>

<!-- -->

<div class='box blur'>
&nbsp;
</div>

<div class='box blur cursor-only letterspaced-more'>
–––––––––––––––––––––
</div>

<div class='box blur cursor-only letterspaced-more'>
—————————————————————
</div>

<div class='box blur cursor-only letterspaced-more'>
•••••••••••••••••••••
</div>

<div class='box blur cursor-only letterspaced-more'>
NEW YORK CONSOLIDATED
</div>





