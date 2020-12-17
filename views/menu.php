<?
/*
    simple menu
    adapted from http://www.o-r-g.com    
*/
$nav = $oo->nav($uu->ids);
// $traverse = $oo->traverse($item);
// $nav = $oo->nav_full($traverse);

/*
    tmp fix to show publications / buy
    uses $buy in two places to set initial style
    this could be done better, but for now ...

    style='<?= ($buy) ? "display:none;" : "" ?>'
*/

$buy = ($uri[1] == 'buy') ? true : false;

?><div id='menu' class='centered centeralign helveticaneuer <?= ($body) ? "hidden" : ""; ?>' style='<?= ($buy) ? "display:block;" : "" ?>'>
    <div id='xx_hide' class='<?= ($body) ? "" : "hidden"; ?>'>
        <!-- <img src='/media/svg/x-6-b.svg'> -->
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
                    // tmp exception buy/1996
                    // if ($n['url'] == 'buy/1996') break;
                    // if ($n['url'] == 'buy') $n['url'] = 'buy/1996';
                    if($n['o']['id'] != $uu->id) {
                        ?><a class='active' href='<?= '/' . $n['url']; ?>'><?= $n['o']['name1']; ?></a><?
                    } else {
                        ?><span class='static'><?= $n['o']['name1']; ?></span><?
                    }
                ?></li><?
            }
            $prevd = $d;
        }
        if ($uri[1]) {
            ?><li><a class='active' href='/'>↵</a></li><?
        }
        ?></ul>
    </ul>
</div>

<div id='xx_show' class='<?= ($body) ? "" : "hidden"; ?>' style='<?= ($buy) ? "display:none;" : "" ?>'>
    <!-- <img src='/media/svg/hamburger-6-b.svg'> -->
</div>

<script type = "text/javascript" src = "/static/js/menu.js"></script>

