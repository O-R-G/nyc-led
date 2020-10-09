
<?
/*

    load simple screen-reader
    based on https://github.com/Comandeer/sr-poc

*/
$stored_accessibility = get_cookie('n-y-c_accessibility');
if($stored_accessibility == 'none')
    $stored_accessibility = null;

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
<script src='/static/js/cookie.js'></script>
<script>
    var body = document.body;

    var stored_accessibility = '<? echo $stored_accessibility; ?>';

    if(stored_accessibility)
        body.setAttribute('accessibility', stored_accessibility);
    

    var sAccessibility = document.getElementById('accessibility');
    var sAccessibility_btn = document.getElementsByClassName('accessibility_btn');
    var sAccessibility_list = document.getElementById('accessibility_list');
    var sAccessibility_list_toggle = document.getElementById('accessibility_list_toggle');
    

    Array.prototype.forEach.call(sAccessibility_btn, function(el, i){
        el.addEventListener('click', function(){
            var this_feature = el.getAttribute('accessibility_feature');
            var activeBtn = document.querySelector('.accessibility_btn.active');
            
            if(this_feature == 'reset'){
                body.setAttribute('accessibility', '');
                createCookie('n-y-c_accessibility', 'none');
                // document.cookie = "accessibility=none";
                if(activeBtn != null)
                    activeBtn.classList.remove('active');
            }
            else if(this_feature == body.getAttribute('accessibility')){
                body.setAttribute('accessibility', '');
                createCookie('n-y-c_accessibility', 'none');
                // document.cookie = "accessibility=none";
                el.classList.remove('active');
            }
            else{
                body.setAttribute('accessibility', this_feature);
                createCookie('n-y-c_accessibility', this_feature);
                // document.cookie = "accessibility="+this_feature;
                if(activeBtn != null)
                    activeBtn.classList.remove('active');
                el.classList.add('active');
            }
        });

        var this_feature = el.getAttribute('accessibility_feature');
        if(this_feature == stored_accessibility)
        {
            el.classList.add('active');
        }
    });
    sAccessibility_list_toggle.addEventListener('click', function(){
        sAccessibility.classList.toggle('expanded');
        sAccessibility.classList.toggle('yellow');
    });
    


</script>
