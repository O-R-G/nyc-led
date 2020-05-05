<?
$cursor = $_GET['cursor'];
$color = $_GET['color'];
$bg_color = $_GET['bg_color'];
if ($color == '') $color = 'FFF';
if ($bg_color == '') $bg_color = '000';
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
        <? if ($cursor) echo 'display: none;'; ?>
    }

    .blur:hover {
        filter: blur(0px);
    }

    .animate {
        animation-name: blur;
        animation-duration: 1.0s;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        animation-timing-function: ease-out;
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

<div class='box blur'>
&nbsp;
</div>

<div class='box animate'>
–
</div>


<!-- -->

<div class='box blur'>
&nbsp;
</div>

<div class='box blur'>
–––––––––––––––––––––
</div>

<div class='box blur'>
—————————————————————
</div>

<div class='box blur'>
•••••••••••••••••••••
</div>

<div class='box blur'>
NEW YORK CONSOLIDATED
</div>

<!-- -->    

<div class='box blur'>
&nbsp;
</div>

<div class='box blur letterspaced'>
–––––––––––––––––––––
</div>

<div class='box blur letterspaced'>
—————————————————————
</div>

<div class='box blur letterspaced'>
•••••••••••••••••••••
</div>

<div class='box blur letterspaced'>
NEW YORK CONSOLIDATED
</div>

<!-- -->

<div class='box blur'>
&nbsp;
</div>

<div class='box blur letterspaced-more'>
–––––––––––––––––––––
</div>

<div class='box blur letterspaced-more'>
—————————————————————
</div>

<div class='box blur letterspaced-more'>
•••••••••••••••••••••
</div>

<div class='box blur letterspaced-more'>
NEW YORK CONSOLIDATED
</div>





