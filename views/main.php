<?

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
    column-count: 2;
    column-gap: 40px;
}

#main{
    width: 800px;
    /* background-color: transparent; */
    background-color: #FF0;
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
    // echo $name . '</br></br>';
    echo $body;
?></div>
<div id='name helveticaautospaced'><a href='/'>•</a></div>
