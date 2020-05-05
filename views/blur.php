<?
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
    }

    .blur:hover {
        filter: blur(0px);
    }

    .letterspaced {
        letter-spacing: 5px;
    }

    .letterspaced-more {
        letter-spacing: 10px;
    }
</style>

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





