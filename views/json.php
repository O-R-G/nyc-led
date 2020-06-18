<?
// check cache
$cache_dir = 'static/data/';
$cache_filenames = scandir($cache_dir);

// use php to get the last modified dates
// easier to set the initial values 
// these are then passed to json.js
// which does the real work
$cache_mtime = array();
clearstatcache();
foreach($cache_filenames as $key => $name){
	if(substr($name[0], 0, 1) == '.'){
		unset($cache_filenames[$key]);
	} else{
		$this_mtime = filemtime( $cache_dir . $name );
		$cache_mtime[$name] = $this_mtime;
	}
}
$cache_filenames = array_values($cache_filenames);
?>

<script>
    // to be passed to json.js
    var document_root = '<? echo $_SERVER["DOCUMENT_ROOT"] ?>';
    var cache_filenames = <? echo json_encode($cache_filenames); ?>;
    var cache_mtime = <? echo json_encode($cache_mtime); ?>;
</script>
<!-- <script src='/static/js/json.js'></script> -->
<!-- <script src='/static/js/call_request_json.js'></script> -->

