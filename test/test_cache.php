<?
require_once('views/json.php');

$key = 'FJ5pNfQtwlkTP27jg62s2De8IM0Ozvjk';
$req_url = 'https://api.nytimes.com/svc/news/v3/content/all/all.json?api-key=' . $key;
?>
<style>
	body{
		font-family: sans-serif;
		color: white;
	}
</style>
<script>
	var output = [];
	console.log('test-cache');
	var req_url = '<? echo $req_url; ?>';
	var cache_filename = 'new-york-times';
	request_json(req_url, cache_filename);
	var cache_filename2 = 'mmm';
	request_json(req_url, cache_filename2);
</script>