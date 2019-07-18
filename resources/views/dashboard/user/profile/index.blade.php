@extends('dashboard.layouts.app')
@section('title') Profilim @endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">attachment</i>
                            </div>
                            <h4 class="card-title">Hesap onayı</h4>
                        </div>
                        <div class="card-body ">
                            <form id="RegisterValidation" action="" method="">
                                <div class="form-group">
                                    <label for="exampleEmail" class="bmd-label-floating"> T.C. kimlik no</label>
                                    <input type="text" class="form-control" id="exampleEmail" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="examplePassword" class="bmd-label-floating"> Doğum tarihi</label>
                                    <input type="text" minlength="10" class="form-control" id="examplePassword"
                                           required="true" name="password">
                                </div>
                            </form>
                            <div align="center"
                                 style="border: 1px dashed #ccc!important; background-color: #e9f5fd; border-radius: 5px;"
                                 class="dropzone dz-clickable" id="kimlik">
                                <div style="text-transform: none;" class="dz-default dz-message">
                                    <div class="dz-message needsclick">
                                        <p>' Kimlik belgesi görselleri & Özçekim '</p>
                                        <p>Dosyayı yüklemek için tıklayın yada alana sürükleyip bırakın.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-rose btn-block">Hesap onayı iste</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card card-profile">
                        <div class="card-avatar">
                            <a href="#pablo">
                                <img class="img" src="../../assets/img/faces/marc.jpg"/>
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Profil Gravatarı</h4>
                            <p class="card-description">
                                Gravatarınızı değiştirmek için <a target="_blank" href="https://gravatar.com">gravatar.com</a>
                                adresini ziyaret ederek sisteme kayıt olduğunuz E-posta ile giriş yapıp yeni profil
                                gravatarı belirleye bilirsiniz.
                            </p>
                            <a target="_blank" href="https://gravatar.com" class="btn btn-rose btn-round">Ziyaret et</a>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">timeline</i>
                            </div>
                            <h4 class="card-title">Hacim ve komisyon bilgisi</h4>
                        </div>
                        <div class="card-body ">
                            <form id="RegisterValidation" action="" method="">
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <td class="subheading">İşlem Hacminiz <span>Son 30 Gün içinde yaptığınız alış satış toplamı</span>
                                        </td>
                                        <td class="text-xs-right monospaced subheading">58,418 TL</td>
                                    </tr>
                                    <tr>
                                        <td class="subheading">MAKER Komisyonu <span>Piyasa yapıcı olarak gerçekleştirdiğiniz işlemlere uygulanır</span>
                                        </td>
                                        <td class="text-xs-right monospaced subheading">%0.25</td>
                                    </tr>
                                    <tr>
                                        <td class="subheading">TAKER Komisyonu <span>Piyasa alıcı olarak gerçekleştirdiğiniz işlemlere uygulanır</span>
                                        </td>
                                        <td class="text-xs-right monospaced subheading">%0.35</td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">money</i>
                            </div>
                            <h4 class="card-title">Limit Bilgisi</h4>
                        </div>
                        <div class="card-body ">
                            <form id="RegisterValidation" action="" method="">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td colspan="2" class="subheading"><span class="caption"
                                                                                 style="font-size: 11px;">Hesap Tipi</span>
                                            <div class="no-select"><!----><span
                                                    class="primary--text">Onaylı Hesap</span><!----></div>
                                        </td>
                                        <td class="text-xs-right">Toplam</td>
                                        <td class="text-xs-right hidden-xs-only">Kullanılan</td>
                                        <td class="text-xs-right">Kalan</td>
                                    </tr>
                                    <tr>
                                        <td>Günlük</td>
                                        <td>Çekim + Yatırma</td>
                                        <td class="text-xs-right monospaced">500,000 TL</td>
                                        <td class="text-xs-right monospaced hidden-xs-only">0 TL</td>
                                        <td class="text-xs-right monospaced">500,000 TL</td>
                                    </tr>
                                    <tr>
                                        <td>Aylık</td>
                                        <td>Çekim + Yatırma</td>
                                        <td class="text-xs-right monospaced">3,000,000 TL</td>
                                        <td class="text-xs-right monospaced hidden-xs-only">8,630 TL</td>
                                        <td class="text-xs-right monospaced">2,991,370 TL</td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('css')

    <style>

    </style>
@endsection

@section('script')

    <script type="text/javascript">
        var myDropzone = new Dropzone("div#kimlik", {
            url: 'https://exchange.omerevren.com.tr/api/v1/account/confirmation/file',
            paramName: "upl",
            addRemoveLinks: true,

            removedfile: function (file, response) {
                var files = eval('(' + file.xhr.response + ')');
                $.ajax
                ({
                    type: "POST",
                    url: 'https://exchange.omerevren.com.tr/api/v1/account/confirmation/delete',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        'filename': files['fileId'],
                    },
                    datatype: 'json',
                    success: function (data) {
                        file.previewElement.remove();
                        toastr['success']('Dosya silindi');
                    },
                    error: function (data) {
                        toastr['success']('Dosya silinemedi');
                    },
                })

            },
            maxFilesize: 2,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
            url: 'https://exchange.omerevren.com.tr/api/v1/account/confirmation/file?key=kimlik',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            init: function () {

                this.on("error", function (file) {
                    var data = eval('(' + file.xhr['response'] + ')');
                    console.log(data);
                    for (datos in data['messages']) {
                        toastr['error'](data['messages'][datos]);
                    }
                });
                this.on("success", function (file) {

                    toastr['success'](file.name + ' dosyası başarı ile yüklendi.');
                });

            }
        });
    </script>

@endsection

