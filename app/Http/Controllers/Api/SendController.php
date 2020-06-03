<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendController extends Controller
{
    /**
     * 领取活动
     */
    public function index(Request $request)
    {
        $user_cookie = $request->all();

        $url = 'https://x6m5.ams.game.qq.com/ams/ame/amesvr?ameVersion=0.3&sServiceType=dnf&iActivityId=303692';
        $flow_id = [
            '663478',
            '664441',
            '664444',
            '664445'
        ];

        $headers = [
            'cookie' => 'skey=' . $user_cookie['skey'] . '; uin=' . $user_cookie['uin'] . '; p_skey=' . $user_cookie['p_skey']
        ];

        foreach ($flow_id as $k => $v) {
            $body = [
                'sServiceType' => 'dnf',
                'iFlowId' => $v,
                'iActivityId' => '303692',
                'g_tk' => $user_cookie['g_tk']
            ];

            $guzz_data = guzzTo($url, 'post', $headers, $body);

            $return_data = json_decode($guzz_data['body']);

            if ($return_data->ret >= 0) {
                logger($return_data->flowRet->sMsg);
            } else {
                return $this->error('参数错误');
            }
        }
        return $this->json('已领取');
    }
}
