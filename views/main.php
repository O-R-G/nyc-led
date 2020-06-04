<?
// dev css in open-rec-gen deck for now

/*
    display menu item
*/

$name = $item['name1'];  
$body = $item['body'];  
$styles = $item['deck'];  
?>

<style>

body {
    background-color: #CCC;
    color: #000;
}

#main img {
    width: 45%;
    margin-right: 10px;
}

#menu{
    background-color: transparent;
}

.multi-column {
    column-count: 1;
    column-gap: 40px;
}

.nycon a {
  color: #00F;
  text-decoration: none;
  border-bottom: 1px solid;
}

.nycon b {
    font-weight: normal;
    color: #00F;
}

/* mobile */

@media screen and (max-width: 768px) {
    #main {
        top: 25px;
        left: 25px;
        padding: 25px;
        width: 70%;
    }

    #menu{
        background-color: #FFF;
    }

    .multi-column {
        column-count: 1;
    }
}
</style>

<?= $styles; ?>
<div id='main' class='nycon centered centeralign multi-column'><?
    echo $body;
?></div>



