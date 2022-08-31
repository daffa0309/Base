@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div>

                <div class="login-main">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    <form class="needs-validation" novalidate="" action="{{route('core.auth')}}" method="POST">
                        @csrf
                        <div>
                            <a class="logo" href="{{ route('core.login') }}">
                                <img class="img-fluid for-light" src="{{ asset('assets/images/visidata/logo-full.png') }}" alt="looginpage" width="250">
                            </a>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Username</label>
                            <input class="form-control" type="text" name="username" required="" placeholder="Username" autocomplete="off">
                            <div class="invalid-feedback text-danger">Username wajib diisi!</div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input class="form-control" type="password" name="password" required="" placeholder="Password" autocomplete="off">
                            <div class="invalid-feedback text-danger">Password wajib diisi!</div>
                            <div class="show-hide">
                                {{-- <span class="show">
                                </span> --}}
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            {{-- <div class="checkbox p-0">
                            <input id="checkbox1" type="checkbox">
                            <label class="text-muted" for="checkbox1">Remember password</label>
                            </div>
                            <a class="link" href="{{ route('forget-password') }}">Forgot password?</a> --}}
                            <button class="btn  btn-primary btn-block w-100 mt-3" type="submit">Sign in</button>
                        </div>
                        {{-- <h6 class="text-muted mt-4 or">Or Sign in with</h6> --}}
                        {{-- <div class="social mt-4">
                            <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn </a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="txt-fb" data-feather="facebook"></i>facebook</a></div>
                        </div>
                        <p class="mt-4 mb-0">Don't have account?<a class="ms-2" href="{{  route('sign-up') }}">Create Account</a></p> --}}
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var $proengsoft_validate = "";
    </script>

    {!! @$validator !!}
@endsection
