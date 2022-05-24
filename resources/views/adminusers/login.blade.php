@extends('layouts.login')
@section('content')
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--singin" id="m_login">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1 m-login__content" style="background-image: url(<?php echo asset("/admin/img/villalogin.jpg") ?>)">


            <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                <div class="m-stack m-stack--hor m-stack--desktop">
                    <div class="m-stack__item m-stack__item--fluid">

                        <div class="m-login__wrapper">
                            <form class="m-login__form m-form validation-form" action="" method="post">
                                <div class="row">
                                    <div class="col-md-3 offset-md-1    ">
                                        <div class="text-left profile">
                                            <img src="<?php echo asset("/admin/img/image2.png") ?>" class="pic-w">
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-1">

                                        <div class="text-right profile">
                                            <img src="<?php echo asset("/admin/img/image1.png") ?>" class="pic-w">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-login__logo">
                                    <img src="<?php echo asset("/admin/img/logos/logo.png") ?>">
                                </div>

                                <div class="m-login__signin  ">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group m-form__group ">
                                        <input class="form-control m-input  validate[required]" type="text" placeholder="Username" autocomplete="off" name="username" />
                                    </div>
                                    <div class="form-group m-form__group ">
                                        <input class="form-control m-input  m-login__form-input--last validate[required]" type="password" placeholder="Password" name="password" />
                                    </div>
                                    <div class="m-login__form-action" style="margin-top: 33px;">
                                        <button class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection

<style media="screen">
    *,
    *:before,
    *:after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #47acc0;
    }

    .pic-w {
        width: 100px !important;
        height: 100px !important;

    }

    .background {
        width: 430px;
        height: 520px;
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
    }

    .background .shape {
        height: 200px;
        width: 200px;
        position: absolute;
        border-radius: 50%;
    }

    form {
        height: 520px;
        width: 400px;
        background-color: white;
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        border-radius: 10px;
        backdrop-filter: blur(5px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
        padding: 15px 35px;
    }

    form * {
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
        letter-spacing: 0.5px;
        outline: none;
        border: none;
    }

    form h3 {
        font-size: 32px;
        font-weight: 500;
        line-height: 42px;
        text-align: center;
    }

    label {
        display: block;
        margin-top: 30px;
        font-size: 16px;
        font-weight: 500;
    }

    input {
        display: block;
        height: 50px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.07);
        border-radius: 3px;
        padding: 0 10px;
        margin-top: 8px;
        font-size: 14px;
        font-weight: 300;
    }

    ::placeholder {
        color: #e5e5e5;
    }

    button {
        margin-top: 50px;
        /* width: 50%; */
        background-color: #ffffff;
        color: #080710;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .social {
        margin-top: 30px;
        display: flex;
    }

    .social div {
        background: red;
        width: 150px;
        border-radius: 3px;
        padding: 5px 10px 10px 5px;
        background-color: rgba(255, 255, 255, 0.27);
        color: #eaf0fb;
        text-align: center;
    }

    .social div:hover {
        background-color: rgba(255, 255, 255, 0.47);
    }

    .social .fb {
        margin-left: 25px;
    }

    .social i {
        margin-right: 4px;
    } 
   
  
</style>