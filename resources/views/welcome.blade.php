@extends('layouts.home')
@section('content')
<div width="100px">
    <img src="data:image/png;base64,{{$qrcode}}" alt="">
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
                var status = data.data[0]
                console.log(status)
                if (data.data instanceof Array) {
                    if (status == 0) {
                        clearInterval(interval_check_login)
                    } else if (status == 65) {
                        console.log('二维码已失效')
                        clearInterval(interval_check_login)
                    } else if (!status) {
                        clearInterval(interval_check_login)
                    }
                }else{
                    console.log('返回参数错误')
                    clearInterval(interval_check_login)
                }
            },
            error: function (error) {
                console.log('检查登录状态失败')
                clearInterval(interval_check_login)
            }
        });
    }

</script>
@endsection