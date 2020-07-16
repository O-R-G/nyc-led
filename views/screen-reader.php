
<?
/*

    load simple screen-reader
    based on https://github.com/Comandeer/sr-poc

*/
?>

<style>
    unknown-element {
        display: block;
    }

    .screen-reader-hide {
        display: NONE;
    }

</style>

<div id='accessibility'>
    <img id = 'screen-reader-switch' src='/media/svg/speak-6-k.svg'>
    <img id = 'accessibility_list_toggle' src='/media/svg/accessibility-6-k.svg'>
    <div id = 'accessibility_list'><div class = 'accessibility_btn' accessibility_feature='high_contrast'>HIGH CONTRAST</div><div class = 'accessibility_btn' accessibility_feature='negative_contrast'>NEGATIVE CONTRAST</div><div class = 'accessibility_btn' accessibility_feature='light_background'>LIGHT BACKGROUND</div><div class = 'accessibility_btn' accessibility_feature='links_underline'>LINKS UNDERLINE</div><div class = 'accessibility_btn' accessibility_feature='readable_font'>READABLE FONT</div><div class = 'accessibility_btn' accessibility_feature='reset'>RESET</div></div>
</div>

<script src='/static/js/screen-reader.js'></script>
<script>
    var sAccessibility_btn = document.getElementsByClassName('accessibility_btn');
    var sAccessibility_list = document.getElementById('accessibility_list');
    var sAccessibility_list_toggle = document.getElementById('accessibility_list_toggle');
    var body = document.body;
    Array.prototype.forEach.call(sAccessibility_btn, function(el, i){
        el.addEventListener('click', function(){
            var this_feature = el.getAttribute('accessibility_feature');
            if(this_feature == 'reset')
                body.setAttribute('accessibility', '');
            else if(this_feature == body.getAttribute('accessibility'))
                body.setAttribute('accessibility', '');
            else
                body.setAttribute('accessibility', this_feature);
        });
    });
    sAccessibility_list_toggle.addEventListener('click', function(){
        sAccessibility_list.classList.toggle('expanded');
    });
</script>
