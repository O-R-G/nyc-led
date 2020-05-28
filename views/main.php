<?

// better do all this in open-records using styles loaded from deck dammit?

/* 
    dev
*/
$item = $oo->get(14); // force
$v = $_GET['v'];
switch ($v){
    case 'a':
        $left = '100px';
        $width = '600px';
        $padding = '150px';
        $bg_color = '#FFF';
        $column_count = 1;
        break;
    case 'b':
        $left = '100px';
        $width = '700px';
        $padding = '100px';
        $bg_color = '#FFF';
        $column_count = 2;
        break;
    case 'c':
        $left = '25px';
        $width = '800px';
        $padding = '25px';
        $bg_color = 'transparent';
        $column_count = 3;
        break;
    default:
        $left = '100px';
        $width = '600px';
        $padding = '150px';
        $bg_color = '#FFF';
        $column_count = 1;
        break;
}

/*
    display menu item
*/

$name = $item['name1'];  // hide/show
$body = $item['body'];  // hide/show

?>

<style>
/* 
    dev -- move to main.css
*/

body {
    background: #CCC;
    color: #000;
}

.multi-column {
    column-count: <?= $column_count; ?>;
    column-gap: 40px;
}

#main{
    left: <?= $left; ?>;
    width: <?= $width; ?>;
    padding: <?= $padding; ?>;
    background-color: <?= $bg_color; ?>;
}

.nycon a {
  color: #000;
  text-decoration: none;
  border-bottom: 1px solid;
}

.nycon b {
    font-family: 'helveticaautospaced', monospace;
    font-weight: normal;
    letter-spacing: 1px;
    text-transform: uppercase;
}

</style>

<div id='main' class='nycon centered centeralign multi-column'><?
    echo $body;
?></div>
<div id='cursor' class='cursor blink'>
    <a href='/'>•</a>
</div>



