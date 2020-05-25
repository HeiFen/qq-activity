<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class indexController extends Controller
{
    public function index()
    {
        $url = 'https://ssl.ptlogin2.qq.com/ptqrshow?appid=549000912&e=2&l=M&s=4&d=72&v=4&t=0.5409099'.time().'&daid=5';
        $headers = [
            'cookie' => 'p_uin=o1149385543; p_skey=sV78gtR2qB6GxPoMF0q4w1Kw080Dt6Y7dP4za6FZXYY_'
        ];
        $data = guzzTo($url, 'post', $headers);
        
        if (isset($data['headers']['Set-Cookie'])) {
            preg_match('/qrsig=(.*?);/',$data['headers']['Set-Cookie'][0],$match);
            if(isset($match[1])){
                $qrisg = $match[1];
                $qrcode = 'data:image/png;base64,'.base64_encode($data['body']);
                
                return view('welcome', compact('qrisg', 'qrcode'));
            }
        }
    }
}
