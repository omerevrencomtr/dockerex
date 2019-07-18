@extends('layouts.home')
@section('title',__('register.page_title'))
@section('content')
    <div class="row">
        <div class="col-md-10 ml-auto mr-auto">
            <div class="card card-signup">
                <h2 class="card-title text-center">{{__('register.page_title')}}</h2>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="info info-horizontal">
                                <div class="icon icon-success">
                                    <i class="material-icons">perm_phone_msg</i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">{{__('register.title_1')}}</h4>
                                    <p class="description">
                                        {{__('register.description_1')}}
                                    </p>
                                </div>
                            </div>
                            <div class="info info-horizontal">
                                <div class="icon icon-rose">
                                    <i class="material-icons">account_balance_wallet</i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">{{__('register.title_2')}}</h4>
                                    <p class="description">
                                        {{__('register.description_2')}}
                                    </p>
                                </div>
                            </div>
                            <div class="info info-horizontal">
                                <div class="icon icon-warning">
                                    <i class="material-icons">code</i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">{{__('register.title_3')}}</h4>
                                    <p class="description">
                                        {{__('register.description_3')}}
                                    </p>
                                </div>
                            </div>
                            <div class="info info-horizontal">
                                <div class="icon icon-info">
                                    <i class="material-icons">security</i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">{{__('register.title_4')}}</h4>
                                    <p class="description">
                                        {{__('register.description_4')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mr-auto">
                            <div class="social text-center">
                                <button class="btn btn-just-icon btn-round btn-twitter">
                                    <i class="fa fa-twitter"></i>
                                </button>
                                <button class="btn btn-just-icon btn-round btn-dribbble">
                                    <i class="fa fa-dribbble"></i>
                                </button>
                                <button class="btn btn-just-icon btn-round btn-facebook">
                                    <i class="fa fa-facebook"> </i>
                                </button>
                                <h4 class="mt-3">{{__('register.communication_channels')}}</h4>
                            </div>
                            <form id="registerForm" style="display: block;" class="form">
                                @csrf
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">face</i>
                                                    </span>
                                        </div>
                                        <input required type="text" minlength="3" id="name" name="name"
                                               class="form-control"
                                               placeholder="{{__('register.name')}}">
                                    </div>
                                </div>
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">account_circle</i>
                                                    </span>
                                        </div>
                                        <input required minlength="3" type="text" name="surname" class="form-control"
                                               placeholder="{{__('register.surname')}}">
                                    </div>
                                </div>
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">mail</i>
                                                    </span>
                                        </div>
                                        <input required type="email" name="email" class="form-control"
                                               placeholder="{{__('register.email')}}">
                                    </div>
                                </div>


                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">public</i>
                                                    </span>
                                        </div>

                                        <select required name="country" class="selectpicker"
                                                data-style="select-with-transition"
                                                title="{{__('register.country')}}" data-size="7">
                                            <option disabled>{{__('register.country')}}</option>
                                            @foreach(Template::getCountries() as $country)
                                                @if($country->iso == 'TR')
                                                    <option selected
                                                            value="{{$country->iso}}">{{$country->full_name}}
                                                        (+{{$country->phone_code}})
                                                    </option>
                                                @else
                                                    <option value="{{$country->iso}}">{{$country->full_name}}
                                                        (+{{$country->phone_code}})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">smartphone</i>
                                                    </span>
                                        </div>
                                        <input required type="tel" id="phone" name="phone" class="form-control"
                                               placeholder="{{__('register.phone')}}">
                                    </div>
                                </div>
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">lock_open</i>
                                                    </span>
                                        </div>
                                        <input required minlength="6" type="password" name="password"
                                               placeholder="{{__('register.password')}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">lock_outline</i>
                                                    </span>
                                        </div>
                                        <input required minlength="6" type="password" name="password_confirmation"
                                               placeholder="{{__('register.password_confirm')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="terms" class="form-check-input" type="checkbox">
                                        <span class="form-check-sign">
                                             <span class="check"></span>
                                        </span>
                                        <a href="#"
                                           target="_blank">{{__('register.terms_of_use')}}</a>{{__('register.agree')}}
                                    </label>
                                </div>

                                <div class="form-group has-default pl-3">
                                    <div class="input-group">
                                        <button id="registerButton"
                                                class="btn btn-success btn-block">{{__('register.register')}} <i
                                                id="registerButtonSpinner"
                                                class=''> </i>
                                        </button>
                                    </div>
                                </div>

                            </form>

                            <form id="phoneConfirmedForm" style="display: none;" class="form">
                                @csrf
                                <div class="form-group has-default">
                                    <div class="info info-horizontal">
                                        <div class="icon icon-success">
                                            <i class="material-icons">perm_phone_msg</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">{{__('register.phone_title')}}</h4>
                                            <p class="description">
                                                {{__('register.phone_description')}}
                                            </p>
                                            <p class="description">
                                                <button id="registerPhoneCallButton" disabled type="button"
                                                        class="btn btn-block btn-info">
                                                    {{__('register.phone_call')}} <span id="countDown"></span><i
                                                        id="registerPhoneCallButtonSpinner"
                                                        class=''> </i>
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">vpn_key</i>
                                                    </span>
                                        </div>
                                        <input required type="number" minlength="6" maxlength="6" id="phone_code"
                                               name="phone_code" class="form-control"
                                               placeholder="{{__('register.confirm_code')}}">
                                    </div>
                                </div>

                                <div class="form-group has-default pl-3">
                                    <div class="input-group">
                                        <button id="phoneConfirmedButton"
                                                class="btn btn-success btn-block">{{__('register.next')}} <i
                                                id="phoneConfirmedButtonSpinner"
                                                class=''> </i>
                                        </button>
                                    </div>
                                </div>

                            </form>

                            <form id="2FaForm" style="display: none;" class="form" method="post"
                                  action="{{route('auth.register.verify.2fa')}}">
                                @csrf
                                <div class="form-group has-default">
                                    <div class="info info-horizontal">
                                        <div class="icon icon-success">
                                            <i class="material-icons">security</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">{{__('register.2fa_title')}}</h4>
                                            <p class="description">
                                                {{__('register.2fa_text')}}
                                            </p>
                                            <p class="description">
                                                <img style="width:100%;" id="QrCode" src="">
                                            </p>
                                            <p class="description">
                                                <a id="authenticatorLink" href="#" target="_blank">
                                                    <button type="button" class="btn btn-info btn-block">Otp uygulaması
                                                        ile aç
                                                    </button>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">phonelink</i>
                                                    </span>
                                        </div>
                                        <input type="text" id="2FaSecret" class="form-control"
                                               value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">vpn_key</i>
                                                    </span>
                                        </div>
                                        <input required type="number" minlength="6" maxlength="6"
                                               id="authenticator_code" name="authenticator_code" class="form-control"
                                               placeholder="{{__('register.2fa_place')}}">
                                    </div>
                                </div>
                                <div class="form-group has-default">
                                    <div class="input-group">
                                        <div class="col-md-6 pr-0">
                                            <button id="2FaDisableButton" type="button"
                                                    class="btn btn-danger btn-block">{{__('register.2fa_disable')}} <i
                                                    id="2FaDisableButtonSpinner"
                                                    class=''> </i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <button id="2FaActiveButton"
                                                    class="btn btn-success btn-block">{{__('register.2fa_active')}} <i
                                                    id="2FaActiveButtonSpinner"
                                                    class=''> </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

        $('#phone').mask('0000000000');
        $('.placeholder').mask("0000000000", {selectOnFocus: true});
        document.getElementById("name").focus();

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
                    document.getElementById("registerPhoneCallButton").disabled = false;
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

        $('#registerButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('register')}}',
                data: $('#registerForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("registerButton").disabled = true;
                    document.getElementById("registerButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {

                    document.getElementById("registerForm").style.display = 'none';
                    document.getElementById("phoneConfirmedForm").style.display = 'block';
                    document.getElementById("phone_code").focus();
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
                    document.getElementById("registerButton").disabled = false;
                    document.getElementById("registerButtonSpinner").className = "";

                },
            });

        });

        $('#phoneConfirmedButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('auth.register.verify.phone')}}',
                data: $('#phoneConfirmedForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("phoneConfirmedButton").disabled = true;
                    document.getElementById("phoneConfirmedButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {

                    document.getElementById("phoneConfirmedForm").style.display = 'none';
                    document.getElementById("2FaForm").style.display = 'block';
                    var QrCode = data['qr_code'];
                    document.getElementById('QrCode')
                        .setAttribute(
                            'src', 'data:image/png;base64,' + QrCode + ''
                        );
                    document.getElementById("authenticatorLink").href = data['link'];
                    document.getElementById("2FaSecret").value = '{{__('register.2fa_secret')}}: ' + data['secret_key'];
                    document.getElementById("authenticator_code").focus();
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
                    document.getElementById("phoneConfirmedButton").disabled = false;
                    document.getElementById("phoneConfirmedButtonSpinner").className = "";

                },
            });

        });

        $('#registerPhoneCallButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('auth.register.send.call')}}',
                data: $('#phoneConfirmedForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("countDown").innerHTML = '';
                    document.getElementById("registerPhoneCallButton").disabled = true;
                    document.getElementById("registerPhoneCallButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
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
                    document.getElementById("registerPhoneCallButtonSpinner").className = "";

                },
            });

        });

        $('#2FaDisableButton').on('click', function () {
            window.location.assign("{{route('dashboard.index')}}");
        });

        $('#2FaActiveButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('auth.register.verify.2fa')}}',
                data: $('#2FaForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("2FaActiveButton").disabled = true;
                    document.getElementById("2FaActiveButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {

                    setTimeout(function () {
                        window.location.assign("{{route('dashboard.index')}}");

                    }, 3000);

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
                    document.getElementById("2FaActiveButton").disabled = false;
                    document.getElementById("2FaActiveButtonSpinner").className = "";

                },
            });

        });
    </script>

@endsection

