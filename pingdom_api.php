<?
    /**
     * Very Basic Pingdom REST API wrapper.
     */
    
    // Your Pingdom Application Key. Get it at: https://my.pingdom.com/account/appkeys
    define('PINGDOM_REST_API_KEY', env('PINGDOM_REST_API_KEY'));

    // Your Pingdom Account username and password.
    define('USERNAME', env('PINGDOM_USERNAME'));
    define('PASSWORD', env('PINGDOM_PASSWORD'));

    /**
     * Pingdom API call
     *
     * @param string $method Pingdom API method
     * @param array $params Optional request parameters
     */
    function pingdomAPI($method, $params = null) {
        $url = "https://api.pingdom.com/api/2.0/" . $method . (empty($params) ? '' : '?' . http_build_query($params));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_USERPWD, USERNAME . ":" . PASSWORD);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("App-Key: " . PINGDOM_REST_API_KEY));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);

        return $response;
    }

    function outputJson($content) {
        header("Content-Type: application/json");
        echo $content;
    }

    /* ----- */
    // do more elaborate things here to support more than checks...

    $response = pingdomAPI('checks');
    outputJson($response);
