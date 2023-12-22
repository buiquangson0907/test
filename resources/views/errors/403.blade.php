<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="{{ asset('') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="favicon.ico?v={{ time() }}">
	<title>403 Error page</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome-free-6.4.2-web/css/all.css">
</head>

<body>
	<div class="d-flex justify-content-center align-items-center vh-100 text-center">
		<div class="col-md-3">
			<div style="font-size: 100px;">
                <i class="fa-solid fa-bug"></i>
            </div>
			<h1>403</h1>
            <h3 class="mt-3">Tài khoản không được truy cập</h3>
            <div class="d-flex flex-column">

                <a href="javascript:history.back()" class="text-decoration-none text-danger">
                    <i class="fa-solid fa-rotate-left"></i> Quay về trang trước đó, cảm ơn!
                </a>
                <a href="/" class="text-decoration-none text-dark fw-bold mt-3">
                    <i class="fa-solid fa-house"></i> Trang chủ
                </a>
            </div>
		</div>
	</div>
</body>

</html>
