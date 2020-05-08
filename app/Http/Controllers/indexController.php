<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class indexController extends Controller
{
    public function index()
    {
        return view('welcome');
        // $url = 'https://user.qzone.qq.com/proxy/domain/ic2.qzone.qq.com/cgi-bin/feeds/feeds3_html_more?uin=1149385543';

        // $client = new Client();
        
        // $content = $client->request('GET', $url, [
        //     'headers' => [
        //         'Cookie' => 'p_uin=o1149385543; p_skey=az33o8kbwCYf4C7hAgxiUFylA9cUbUs1xS6tnhupcY4_',
        //     ]
        // ]);
        // dd($content->getHeaders());
    }
}
