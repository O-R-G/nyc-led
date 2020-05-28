<?
/*
    simple menu
    adapted from http://www.o-r-g.com
*/
// $body = $item['body'];  // hide/show
$body = TRUE;
$nav = $oo->nav($uu->ids);
// $traverse = $oo->traverse($item);
// $nav = $oo->nav_full($traverse);

if($uu->id) { 
    // for now, a back door to home
    ?><div id='home' class='centered centeralign'>
        <a href="/">&nbsp;</a>
    </div><?
} else {
    ?><div id='menu' class='centered centeralign <?= ($body) ? "hidden" : ""; ?>'>
        <div id='xx_hide' class='<?= ($body) ? "" : "hidden"; ?>'>
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
        <div id='cursor' class='cursor blink'>
            <a href='/'>•</a>
        </div>
    </div><?
}
?><div id='xx_show' class='<?= ($body) ? "" : "hidden"; ?>'>
    <img src='/media/svg/hamburger-6-b.svg'>
</div>
<script type = "text/javascript" src = "/static/js/menu.js"></script>

