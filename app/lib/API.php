<?php


namespace app\lib;


class API
{
    public static function sendRequest(string $url, SessionManager $session, ?array $post = null, ?array $headers = null)
    {
        $headers[] = 'Accept: application/json';
        if (isset($session->access_token))
            $headers[] = 'Authorization: Bearer ' . $session->access_token;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if ($post)
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return json_decode($response);
    }

}