@extends('layout.auth')

@section('content')
<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter">
        <div class="container" style="">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-login card-hidden">
                            <div class="card-header card-header-image">
                                <a href="/">
                                    <img class="img logo" src="{{ asset('img/logo.png') }}">
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="form-group" >
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="uid" placeholder="User ID..." value="{{ isset($uid) ? $uid : '' }}" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" id="examplePassword" name="password" placeholder="Password..." value="" required>
                                    </div>
                                </div>
                                @if (!empty($error))
                                    <p class="card-text text-center">
                                        <i class="fa fa-warning"></i>
                                        {{ __($error) }}
                                    </p>
                                @endif
                            </div>
                            <div class="card-footer justify-content-center">
                                <button type="submit" class="btn btn-link btn-lg">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection