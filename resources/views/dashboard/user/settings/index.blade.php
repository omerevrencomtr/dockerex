@extends('dashboard.layouts.app')
@section('title') Ayarlar @endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">lock</i>
                            </div>
                            <h4 class="card-title">Parola Değiştir</h4>
                        </div>
                        <div class="card-body ">
                            <form id="RegisterValidation" action="" method="">
                                <div class="form-group">
                                    <label for="exampleEmail" class="bmd-label-floating"> Mevcut parolanız</label>
                                    <input type="password" class="form-control" id="exampleEmail" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="examplePassword" class="bmd-label-floating"> Yeni parolanız</label>
                                    <input type="password" minlength="10" class="form-control" id="examplePassword"
                                           required="true" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="examplePassword1" class="bmd-label-floating"> Yeni parolanız
                                        tekrar </label>
                                    <input type="password" minlength="10" class="form-control" id="examplePassword1"
                                           required="true" equalTo="#examplePassword" name="password_confirmation">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-rose btn-block">Parola değiştir</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">screen_lock_portrait</i>
                            </div>
                            <h4 class="card-title">Authenticator</h4>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-rose btn-block">Authenticator'ü kapat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function setFormValidation(id) {
            $(id).validate({
                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                    $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
                },
                success: function (element) {
                    $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
                    element[0].remove();
                    console.log(element)
                },
                errorPlacement: function (error, element) {
                    $(element).closest('.form-group').append(error);
                    //document.querySelector('#exampleInput1-error');
                    console.log(element);
                },
            });
        }

        $(document).ready(function () {
            setFormValidation('#RegisterValidation');
        });
    </script>
@endsection

@section('csss')

    <style>
        .input-group .form-group {
            width: 70%;
        }
    </style>
@endsection
