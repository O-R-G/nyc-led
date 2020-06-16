<?
/*
    simple menu
    adapted from http://www.o-r-g.com
*/

$nav = $oo->nav($uu->ids);
// $nav = $oo->nav_full($traverse);
// $traverse = $oo->traverse($item);

?><div id='menu' aria-hidden="true" class='centered centeralign nycon large <?= ($body) ? "hidden" : ""; ?>'>
    <div id='xx_hide' aria-hidden="true" class='<?= ($body) ? "" : "hidden"; ?>'>
        <img src='/media/svg/x-6-b.svg'>
    </div>
    <ul class="nav-level"><?
        $prevd = $nav[0]['depth'];
        foreach($nav as $n) {
            $d = $n['depth'];
            if($d > $prevd){
                ?><ul class="nav-level"><?
            }
            if(substr($n['o']['name1'],0,1) != '_') {
                ?><li><?
                    if($n['o']['id'] != $uu->id) {
                        ?><a class='active' href='<?= '/' . $n["url"]; ?>'><?= $n['o']['name1']; ?></a><?
                    } else {
                        ?><span class='static'><?= $n['o']['name1']; ?></span><?
                    }
                ?></li><?
            }
            $prevd = $d;
        }
        ?></ul>
    </ul>
</div><?
?><div id='xx_show' class='<?= ($body) ? "" : "hidden"; ?>'>
    <img src='/media/svg/hamburger-6-b.svg'>
</div>
<script type = "text/javascript" src = "/static/js/menu.js"></script>

