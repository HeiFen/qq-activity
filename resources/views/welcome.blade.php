@extends('layouts.home')
@section('content')
<div>
    <img class="cent" src="data:image/png;base64,{{$qrcode}}" alt="">
</div>
@endsection
@section('script')
<script>
    var checkUrl = "{{route('check_login')}}"

    // 轮询登录状态
    var interval_check_login = setInterval(checkLogin, 1000)

    function checkLogin() {
        $.ajax({
            type: "POST",
            url: checkUrl,
            data: { qrisg: '{{$qrisg}}' },
            dataType: "json",
            success: function (data) {
                var status = data.data[0]// 状态
                var login_data = data.data// 登录数据
                console.log(login_data)
                if (data.data instanceof Array) {
                    if (status == 0) {// 登录成功
                        clearInterval(interval_check_login)
                    } else if (status == 65) {
                        console.log('二维码已失效')
                        clearInterval(interval_check_login)
                    } else if (!status) {
                        clearInterval(interval_check_login)
                    }
                } else {
                    clearInterval(interval_check_login)
                    var uin = login_data.uin
                    var skey = login_data.skey
                    var p_skey = login_data.p_skey
                    var g_tk = getGTK(skey)

                    console.log(uin)
                    console.log(skey)
                    console.log(p_skey)
                    console.log(skey)
                    console.log(g_tk)
                }
            },
            error: function (error) {
                console.log('检查登录状态失败')
                clearInterval(interval_check_login)
            }
        });
    }

    function getGTK(str) {
        hash = 5381;
        for (var i = 0, len = str.length; i < len; ++i) {
            hash += (hash << 5) + str.charAt(i).charCodeAt()
        }
        return hash & 2147483647
    }
</script>
@endsection