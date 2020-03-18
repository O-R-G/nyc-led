<?

    // nytimes top stories (by section)
    // https://developer.nytimes.com
    // registered developer w/app newyorkconsolidated
    // https://api.nytimes.com/svc/topstories/v2/home.json?api-key=FJ5pNfQtwlkTP27jg62s2De8IM0Ozvjk

    // compose url with query
    $req_url = 'https://api.nytimes.com/svc/topstories/v2/home.json?api-key=FJ5pNfQtwlkTP27jg62s2De8IM0Ozvjk';
    // $req_url = 'https://api.nytimes.com/svc/topstories/v2/business.json?api-key=FJ5pNfQtwlkTP27jg62s2De8IM0Ozvjk';
    $results = file_get_contents($req_url, false, $context);
    $results_decoded = json_decode($results, true);


    $output_nyt = array();   
    $results_total = count($results_decoded['results']);
    $results_count = 3;

    // looping through every val
    foreach($results_decoded['results'] as $r){
        // $output_nyt .= $r['title'] . ' / / / ';
        $output_nyt[] = $r['title'] . ' / / / ';
    }

    /*
    var_dump($results_decoded['results'][0]['title']);
    var_dump($results_decoded['results'][1]['title']);
    echo $output_nyt;
    die();
    */
?>
