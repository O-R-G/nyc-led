    <?
    if ($uri[1]) {
        ?>
        <div id='mask'>
            <div id='display' class='cursor'>
                <a href='/'>
                    <div id='d'></div>
                </a>
            </div>
        </div>
        <script>
            // this is abominable
            // but will have to do for now
            is_main_hack = 1; // truly awful way to do this
        </script>
        <script src='/static/js/matrix.js'></script>
        <script>
            // hack to start bc of loading of json.js
            // which is loaded in different order
            // timer = setInterval(update, timer_ms);
            // columns=3;  // this does nothing here
            stop_start();
        </script><?
    }
	?></body>
</html>
