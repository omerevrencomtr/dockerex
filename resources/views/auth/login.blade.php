@extends('layouts.home')
@section('title','Anasayfa')
@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="col-md-8 col-12 mr-auto ml-auto">
                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card card-wizard" data-color="rose" id="wizardProfile">

                        <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                        <div class="card-header text-center">
                            <h3 class="card-title">
                                {{__('login.page_title')}}
                            </h3>
                            <h5 class="card-description">{{__('login.page_description')}}</h5>
                        </div>
                        <div class="wizard-navigation">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#login" data-toggle="tab" role="tab">
                                        {{__('login.login_information')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#confirm" data-toggle="tab" role="tab">
                                        {{__('login.account_verification')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" style="min-height: 200px;">
                                <div class="tab-pane active" id="login">
                                    <div class="mr-auto">
                                        <h5 class="info-text">{{__('login.info_text')}}</h5>
                                        <form class="form" id="loginForm" method="post"
                                              action="{{route('login')}}">
                                            <div class="form-group has-default">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">mail</i>
                                                    </span>
                                                    </div>
                                                    <input required id="email" type="email" name="email" class="form-control"
                                                           placeholder="{{__('login.email')}}">
                                                </div>
                                            </div>
                                            <div class="form-group has-default">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">lock_open</i>
                                                    </span>
                                                    </div>
                                                    <input required minlength="6" id="password" type="password" name="password"
                                                           placeholder="{{__('login.password')}}"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-check form-group text-center">
                                                <label class="form-check-label">
                                                    <input id="remember" name="remember" class="form-check-input" type="checkbox">
                                                    <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                                                    Beni Hatırla
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="confirm">
                                    <div class="mr-auto">
                                        <form class="form" id="loginAuthenticatorForm" style="display: none"
                                              method="post"
                                              action="{{route('login')}}">
                                            <div class="form-group has-default">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">mail</i>
                                                    </span>
                                                    </div>
                                                    <input type="number" required minlength="6" maxlength="6" id="authenticator_code" name="authenticator_code" class="form-control"
                                                           placeholder="{{__('login.2fa_code')}}">
                                                </div>
                                            </div>
                                            <h5 id="loginInfoText"
                                                class="info-text m-0">{{__('login.verify_message_google2fa')}}</h5>
                                        </form>
                                        <form class="form" id="loginPhoneForm" style="display: none" method="post"
                                              action="{{route('login')}}">
                                            <div class="form-group has-default">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">mail</i>
                                                    </span>
                                                    </div>
                                                    <input type="number" required minlength="6" maxlength="6" id="phone_code" name="phone_code" class="form-control"
                                                           placeholder="{{__('login.phone_code')}}">
                                                </div>
                                            </div>
                                            <h5 id="loginInfoText"
                                                class="info-text m-0">{{__('login.verify_message_sms')}}</h5>
                                            <div class="card-body">

                                                <button id="loginPhoneCallButton" disabled type="button"
                                                        class="btn btn-info btn-sm btn-block">
                                                    {{__('login.call_message')}} <span id="countDown"></span><i
                                                        id="loginPhoneCallButtonSpinner"
                                                        class=''> </i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="ml-auto">
                                <p style="display: none;">
                                    <input type="button" id="nextButton" class="btn-next"
                                           name="next" style="display: none">
                                </p>
                                <button type="button" id="loginButton" class="btn btn-fill btn-success btn-wd"
                                        name="next">
                                    {{__('login.next')}} <i
                                        id="loginButtonSpinner"
                                        class=''> </i>
                                </button>

                                <button style="display: none;" type="button" id="loginAuthenticatorButton"
                                        class="btn btn-fill btn-success btn-wd"
                                        name="next">
                                    {{__('login.sign_in')}} <i
                                        id="loginAuthenticatorButtonSpinner"
                                        class=""> </i>
                                </button>

                                <button style="display: none;" type="button" id="loginPhoneButton"
                                        class="btn btn-fill btn-success btn-wd"
                                        name="next">
                                    {{__('login.sign_in')}} <i
                                        id="loginPhoneButtonSpinner"
                                        class=""> </i>
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
                <!-- wizard container -->
            </div>
        </div>

    </div>
@endsection

@section('css')
    <style>
        .card-wizard[data-color="rose"] .moving-tab {
            background-color: #4caf50;
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);
        }
    </style>
@endsection
@section('script')

    <script type="text/javascript">
        document.getElementById("email").focus();

        $('#email,#password,#remember').keypress(function(e){
            if(e.keyCode==13)
                $('#loginButton').click();
        });

        $('#loginAuthenticatorButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('auth.login.verify.2fa')}}',
                data: $('#loginAuthenticatorForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("loginAuthenticatorButton").disabled = true;
                    document.getElementById("loginAuthenticatorButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {

                    $.notify({
                        icon: "add_alert",
                        message: data['message']

                    }, {
                        type: 'success',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                    setTimeout(function () {
                        window.location.assign("{{route('dashboard.index')}}");

                    }, 1000);

                },
                error: function (data) {

                    var data = eval('(' + data.responseText + ')');

                    for (datos in data['errors']) {
                        $.notify({
                            icon: "add_alert",
                            message: data['errors'][datos],

                        }, {
                            type: 'warning',
                            timer: 3000,
                            placement: {
                                from: 'top',
                                align: 'right'
                            }
                        });
                    }

                    document.getElementById("loginAuthenticatorButton").disabled = false;
                    document.getElementById("loginAuthenticatorButtonSpinner").className = "";
                },
            });

        });


        $('#loginPhoneCallButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('auth.login.send.call')}}',
                data: $('#loginPhoneForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("countDown").innerHTML = '';
                    document.getElementById("loginPhoneCallButton").disabled = true;
                    document.getElementById("loginPhoneCallButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {

                    CountDownTimer(Date.now() + 120000);

                    $.notify({
                        icon: "add_alert",
                        message: data['message']

                    }, {
                        type: 'success',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                },
                error: function (data) {

                    var data = eval('(' + data.responseText + ')');
                    $.notify({
                        icon: "add_alert",
                        message: data['message'],

                    }, {
                        type: 'danger',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                    for (datos in data['errors']) {
                        $.notify({
                            icon: "add_alert",
                            message: data['errors'][datos],

                        }, {
                            type: 'warning',
                            timer: 3000,
                            placement: {
                                from: 'top',
                                align: 'right'
                            }
                        });
                    }


                },
                complete: function (data) {
                    document.getElementById("loginPhoneCallButtonSpinner").className = "";

                },
            });

        });


        $('#loginPhoneButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('auth.login.verify.phone')}}',
                data: $('#loginPhoneForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("loginPhoneButton").disabled = true;
                    document.getElementById("loginPhoneButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {

                    $.notify({
                        icon: "add_alert",
                        message: data['message']

                    }, {
                        type: 'success',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });
                    setTimeout(function () {
                        window.location.assign("{{route('dashboard.index')}}");

                    }, 1000);

                },
                error: function (data) {

                    var data = eval('(' + data.responseText + ')');

                    for (datos in data['errors']) {
                        $.notify({
                            icon: "add_alert",
                            message: data['errors'][datos],

                        }, {
                            type: 'warning',
                            timer: 3000,
                            placement: {
                                from: 'top',
                                align: 'right'
                            }
                        });
                    }

                    document.getElementById("loginPhoneButton").disabled = false;
                    document.getElementById("loginPhoneButtonSpinner").className = "";
                },
            });

        });

        $('#loginButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('login')}}',
                data: $('#loginForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("loginButton").disabled = true;
                    document.getElementById("loginButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {
                    if (data['login_types']['phone'] == true) {
                        document.getElementById("loginAuthenticatorForm").style.display = 'none';
                        document.getElementById("loginPhoneForm").style.display = 'block';

                        document.getElementById("loginAuthenticatorButton").style.display = 'none';
                        document.getElementById("loginPhoneButton").style.display = 'block';

                        CountDownTimer(Date.now() + 120000);
                        document.getElementById("phone_code").focus();
                    }

                    if (data['login_types']['google2fa'] == true) {
                        document.getElementById("loginAuthenticatorForm").style.display = 'block';
                        document.getElementById("loginPhoneForm").style.display = 'none';

                        document.getElementById("loginAuthenticatorButton").style.display = 'block';
                        document.getElementById("loginPhoneButton").style.display = 'none';
                        document.getElementById("authenticator_code").focus();
                    }

                    document.getElementById("nextButton").click();
                    document.getElementById("loginButton").style.display = 'none';
                    $.notify({
                        icon: "add_alert",
                        message: data['message']

                    }, {
                        type: 'success',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                },
                error: function (data) {

                    var data = eval('(' + data.responseText + ')');

                    for (datos in data['errors']) {
                        $.notify({
                            icon: "add_alert",
                            message: data['errors'][datos],

                        }, {
                            type: 'warning',
                            timer: 3000,
                            placement: {
                                from: 'top',
                                align: 'right'
                            }
                        });
                    }


                },
                complete: function (data) {
                    document.getElementById("loginButton").disabled = false;
                    document.getElementById("loginButtonSpinner").className = "";

                },
            });

        });

        function CountDownTimer(dt) {
            var end = new Date(dt);

            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;

            function showRemaining() {
                var now = new Date();
                var distance = end - now;
                if (distance < 0) {
                    clearInterval(timer);
                    document.getElementById('countDown').innerHTML = '';
                    document.getElementById("loginPhoneCallButton").disabled = false;
                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                document.getElementById("countDown").innerHTML = '</br>' + minutes + ':' + seconds;

            }

            timer = setInterval(showRemaining, 1000);
        }


    </script>
@endsection
