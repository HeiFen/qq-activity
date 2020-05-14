<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 获取qrisg
     */
    private function getqrtoken($qrsig){
        $len = strlen($qrsig);
        $hash = 0;
        for($i = 0; $i < $len; $i++){
            $hash += (($hash << 5) & 2147483647) + ord($qrsig[$i]) & 2147483647;
			$hash &= 2147483647;
        }
        return $hash & 2147483647;
	}

    /**
     * 轮询登录状态
     */
    public function checkLogin(Request $request)
    {
        $request->validate([
            'qrisg' => 'required'
        ]);

        $url='https://ssl.ptlogin2.qq.com/ptqrlogin?u1=https%3A%2F%2Fqzs.qq.com%2Fqzone%2Fv5%2Floginsucc.html%3Fpara%3Dizone&ptqrtoken='.$this->getqrtoken($request->input('qrisg')).'&ptredirect=0&h=1&t=1&g=1&from_ui=1&ptlang=2052&action=0-0-'.time().'0000&js_ver=10194&js_type=1&login_sig=&pt_uistyle=40&aid=549000912&daid=5&';

        $headers = [
            'cookie' => 'qrsig='.$request->input('qrisg')
        ];

        $guzz_data = guzzTo($url, 'post', $headers);

        if(preg_match("/ptuiCB\('(.*?)'\)/", $guzz_data['body'], $arr)){
            $status = explode("','",str_replace("', '","','",$arr[1]));
            if($status[0] == 0){
                $cookies = implode($guzz_data['headers']['Set-Cookie']);
                // 获取 uin
                preg_match('/;uin=(.*?);/',$cookies,$uin);
                // 获取 skey
                preg_match('/skey=@(.{9});/',$cookies,$skey);
                // 获取 superkey
                preg_match('/superkey=(.*?);/',$cookies,$superkey);
				$uin = $uin[1];
                $login_data = get_curl($status[2],0,0,0,1);
                // 获取p_skey
                if($login_data) {
					preg_match("/p_skey=(.*?);/", $login_data, $matchs);
					$pskey = $matchs[1];
                }
                return $this->json([
                    'uin' => $uin,
                    'skey' => $skey[1],
                    'superkey' => $superkey[1],
                    'p_skey' => $pskey
                ]);
            }
            return $this->json($status);
        }
    }
}
