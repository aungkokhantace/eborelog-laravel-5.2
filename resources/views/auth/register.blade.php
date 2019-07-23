<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FOSTA Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="template/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="template/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="template/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="template/images/favicon.png" />

    <!-- custom css -->
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="images/fosta-logo.png" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" method="POST" action="/register">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <!-- start name -->
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" placeholder="Name" value="{{Request::old('name')}}">
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                </div>
                                <!-- end name -->

                                <!-- start email -->
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg {{$errors->has('email') ? 'is-invalid' :''}}" id="email" name="email" placeholder="Email" value="{{Request::old('email')}}">
                                    <p class=" text-danger">{{$errors->first('email')}}</p>
                                </div>
                                <!-- end email -->

                                <!-- start password -->
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg {{$errors->has('password') ? 'is-invalid' :''}}" id="password" name="password" placeholder="Password">
                                    <p class="text-danger">{{$errors->first('password')}}</p>
                                </div>
                                <!-- end password -->

                                <!-- start password confirmation -->
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                                <!-- end password confirmation -->

                                <!-- start role select -->
                                <div class="form-group">
                                    <select class="form-control form-control-lg select-left-padding {{$errors->has('password') ? 'is-invalid' :''}}" id="role" name="role">
                                        <!-- default -->
                                        <option selected disabled>Select User Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{$errors->first('role')}}</p>
                                </div>
                                <!-- end role select -->

                                <!-- start buttons -->
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        SIGN UP
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="/login" class="text-primary">Login</a>
                                </div>
                                <!-- end buttons -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="template/vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="template/js/off-canvas.js"></script>
    <script src="template/js/hoverable-collapse.js"></script>
    <script src="template/js/template.js"></script>
    <!-- endinject -->
</body>

</html>
