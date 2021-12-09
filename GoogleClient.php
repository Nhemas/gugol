<?php
class GoogleClient {
    
    private $token_url = 'https://oauth2.googleapis.com/token';
    private $redirect_uri = 'http://localhost/googleLogin.php';

    private $client_id = '863746956179-ag8sa55jtnfsmbdepf58842qs6i22218.apps.googleusercontent.com';
    private $client_secret = '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';

    private function curl($url, $params = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if (!empty($params)) {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        $res = json_decode(curl_exec($ch), TRUE);
        curl_close($ch);
        return $res;
    }
    
    public function getTokensByAuthCode($auth_code) {
        $params = array(
            'code' => $auth_code,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->redirect_uri,
            'grant_type' => 'authorization_code',
            'access_type' => 'offline'
        );
        return $this->curl($this->token_url, $params);
    }
}