<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title','Đăng nhập quản trị viên | GDX')</title>
    <link href="/css/styles.css" rel="stylesheet" />

    <!-- Favicon
	============================================ -->
    <link rel="shortcut icon" href="/image/logos/icon-logo-mini.png">

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #008bd1;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <div class="text-center">
                                        <img src="/image/logos/logo-gia-dung-xanh.png" width="150" alt="Gia Dụng Xanh">
                                    </div>
                                    <h3 class="text-center font-weight-light my-4">Đăng nhập hệ thống GDX</h3>
                                </div>
                                <div class="card-body" id="admin-login">
                                    @csrf
                                    <div class="admin-login-result mb-2"></div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                        <label for="inputEmail">Nhập địa chỉ Email</label>
                                        <p class="email-error text-danger text-center"></p>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                        <label for="inputPassword">Nhập mật khẩu</label>
                                        <p class="pwd-error text-danger text-center"></p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="#">Quên mật khẩu?</a>
                                        <button class="btn btn-primary login-submit">Đăng nhập</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Gia Dụng Xanh</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/js/scripts.js"></script>
    <script type="text/javascript" src="/js/jquery-2.2.4.min.js"></script>
    <script src="/js/validate/validate.js"></script>
    <script src="/js/auth/login_admin.js"></script>

</body>

</html>