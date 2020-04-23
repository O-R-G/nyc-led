<?
$output_covid = array();
$req_url = 'https://covidtracking.com/api/v1/states/current.json';
$results = file_get_contents($req_url, false, $context);
$results_decoded = json_decode($results, true);
$results_ny = array();
foreach($results_decoded as $rd){
	if($rd['state'] == 'NY'){
		$results_ny = $rd;
		break;
	}
}

foreach($results_ny as $key => $r_ny){
	// echo $key.'<br>';
	if($key == 'positive'){
		$output_covid[] = 'Positive cases: '.$r_ny ;
	}elseif($key == 'negative'){
		$output_covid[] = 'Negative cases: '.$r_ny ;
	}elseif($key == 'hospitalizedCurrently'){
		$output_covid[] = 'Currently hospitalized cases: '.$r_ny ;
	}else{
		unset($results_ny[$key]);
	}
}
?>