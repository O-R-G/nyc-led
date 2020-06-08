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
    /* color: #00F; */
}

.nycon b::before {
    /* content: '↪ '; */
    content: '↳ ';
    }

#mask {
    position: fixed;
    /* top: 100px; */
    top: inherit; 
                    /* doesnt quite work correctly */
                    /* neither did initial */
                    /* still slides around vertically */
    left: 10px;
    bottom: 10px;
    transform: none;
    width: 100px;
    height: 100px;
    background-color: #CCC;
}

#display {
}

#d {
}

.cursor {
}



/* mobile */

@media screen and (max-width: 768px) {
    #main {
        top: 20px;
        left: 20px;
        padding: 25px;
        width: 75%;
    }

    #menu{
        background-color: #CCC;
    }

    .multi-column {
        column-count: 1;
    }
}
</style>

<?= $styles; ?>
        
<div id='main' class='centered centeralign'>
    <div id='body' class='nycon multi-column'>
        <div id='date' class='relative'><?
            // echo date('F j, Y h:i:s a');
            echo date('F j, Y');
        ?></div>
        <div id='dates-menu' class='relative'><?    
            $d=strtotime('now');
            for ($i=1; $i<30; $i++) {
                $d=strtotime('- ' .  $i. ' days');
                echo '<a href="">' . date('F j, Y', $d) . '</a><br/>';
                // echo date('F j, Y', $d) . '<br/>';
            }
        ?></div><?
        echo $body;
    ?></div>
</div>

<script src='/static/js/dates-menu.js'></script>
<script src='/static/js/img-zoom.js'></script>
