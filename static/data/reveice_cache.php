<?
if(!empty($_POST['data'])){
	$data = $_POST['data'];
	$file_name = mktime() . ".json";//generates random name

	$file = fopen("data/" .$file_name, 'w');//creates new file
	fwrite($file, $data);
	fclose($file);
}