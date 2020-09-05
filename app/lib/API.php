<?php


namespace app\lib;


class API
{
    public static function sendRequest(string $url, SessionManager $session, ?array $post = null, ?array $headers = null)
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        $headers[] = 'Accept: application/json';
        if (isset($session->access_token))
            $headers[] = 'Authorization: Bearer ' . $session->access_token;
        if ($post)
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return json_decode($response);
    }

}