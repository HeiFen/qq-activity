<?php

use GuzzleHttp\Client;

/**
 * guzzle
 */
function guzzTo($url, $method, $headers=null, $body=null)
{
    $client = new Client();
    $headers[] = "Accept: application/json";
    $headers[] = "Accept-Encoding: gzip,deflate,sdch";
    $headers[] = "Accept-Language: zh-CN,zh;q=0.8";
    $headers[] = "Connection: keep-alive";

    $data = [
        'headers' => $headers,
        'body' => $body
    ];
    
    $content = $client->request($method, $url, $data);
    $data = [
        'headers' => $content->getHeaders(),
        'body' => $content->getBody()->getContents(),
        'content' => $content->getBody(),
    ];

    return $data;
}

/**
 * curl
 */
function get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){
    // if($this->loginapi)return $this->get_curl_proxy($url,$post,$referer,$cookie,$header,$ua,$nobaody);
	$ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    // $httpheader[] = "Accept: application/json";
    // $httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
    $httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
    // $httpheader[] = "Connection: keep-alive";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    // if($post){
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    // }
    if($header){
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
    }
    // if($cookie){
    //     curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    // }
    // if($referer){
    //     curl_setopt($ch, CURLOPT_REFERER, $referer);
    // }
    // if($ua){
    //     curl_setopt($ch, CURLOPT_USERAGENT,$ua);
    // }else{
    //     curl_setopt($ch, CURLOPT_USERAGENT,$ua);
    // }
    // if($nobaody){
    //     curl_setopt($ch, CURLOPT_NOBODY,1);

    // }
    // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}