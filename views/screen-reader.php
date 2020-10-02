
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
    <div id = 'screen-reader-ctner'>
        <div id = 'screen-reader-switch'></div>
        <!-- <div id = 'voice_option_ctner' class = 'expanded'></div> -->
    </div>
    <div id = 'accessibility_list_container'>
        <div id = 'accessibility_list_toggle'></div><div id = 'accessibility_list'>
            <!-- <div class = 'accessibility_btn' accessibility_feature='high_contrast'>High contrast</div> -->
            <div class = 'accessibility_btn' accessibility_feature='high_contrast'>High contrast</div><div class = 'accessibility_btn' accessibility_feature='negative_contrast'>Negative contrast</div><div class = 'accessibility_btn' accessibility_feature='reset'>Reset</div></div>
            <!-- <div class = 'accessibility_btn' accessibility_feature='light_background'>Light background</div> -->
            <!-- <div class = 'accessibility_btn' accessibility_feature='links_underline'>Underline links</div> -->
            <!-- <div class = 'accessibility_btn' accessibility_feature='readable_font'>Readable font</div> -->
            
    </div>
</div>

<script src='/static/js/screen-reader.js'></script>
<script>
    var sAccessibility = document.getElementById('accessibility');
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
        sAccessibility.classList.toggle('expanded');
        sAccessibility.classList.toggle('yellow');
    });
    
</script>
