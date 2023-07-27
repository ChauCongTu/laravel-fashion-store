<!doctype html>
<html lang="en">

<head>
    <title>Thanh toán trực tuyến với VN PAY | NZ Fashion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-primary">
    <div class="container mt-5 mb-5">
        <div class="shadow bg-white rounded-3">
            <div class="text-center py-3">
                <img src="https://cdn.discordapp.com/attachments/1100753623849377835/1134032604635603097/image.png"
                    class="w-25" alt="">
            </div>
            <form action="{{ route('vnpay') }}" method="post">
                @csrf
                <div class="d-flex">
                    <div class="col-md-4">
                        <button class="bg-white border-0" name="bankCode" value="VCB">
                            <img src="https://cdn.discordapp.com/attachments/1100753623849377835/1134032902133391360/image.png"
                                alt="" width="50%">
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button class="bg-white border-0" name="bankCode" value="NCB">
                            <img src="https://cdn.discordapp.com/attachments/1100753623849377835/1134035637331300402/image.png"
                                alt="" width="50%">
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button class="bg-white border-0" name="bankCode" value="EIB">
                            <img src="https://cdn.discordapp.com/attachments/1100753623849377835/1134035637658472560/image.png"
                                alt="" width="50%">
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
