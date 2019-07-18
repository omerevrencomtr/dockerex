@extends('layouts.home')
@section('title','Anasayfa')
@section('content')

    <div class="container card">
        <h2 class="title">Bizimle iletişime geçin</h2>
        <div class="row card-body">
            <div class="col-md-6">
                <p class="description">Hizmetimiz ile ilgili her konuda bizimle iletişime geçebilirsiniz. En kısa sürede
                    sizinle iletişim kuracağız.
                    <br>
                    <br>
                </p>
                <form role="form" id="contactForm">
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Adınız</label>
                        <input minlength="3" required type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="surname" class="bmd-label-floating">Soyadınız</label>
                        <input minlength="3" required type="text" class="form-control" name="surname" id="surname">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmails" class="bmd-label-floating">E-posta adresiniz</label>
                        <input minlength="3" required type="email" class="form-control" name="email"
                               id="exampleInputEmails">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="bmd-label-floating">Telefon Numaranız</label>
                        <input minlength="3" required type="number" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="form-group label-floating">
                        <label class="form-control-label bmd-label-floating" for="message"> Mesajınız</label>
                        <textarea minlength="30" required class="form-control" rows="6" name="message"
                                  id="message"></textarea>
                    </div>
                    <div class="submit text-center">
                        <button id="contactButton" type="button" class="btn btn-primary pull-right">Gönder <i
                                id="contactButtonSpinner" class=""></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 ml-auto">
                <div class="info info-horizontal">
                    <div class="icon icon-primary">
                        <i class="material-icons">pin_drop</i>
                    </div>
                    <div class="description">
                        <h4 class="info-title">Ofisimiz</h4>
                        <p> Gizli Cd. Gizli Sk.,
                            <br> 34000 İstanbul,
                            <br> Türkiye
                        </p>
                    </div>
                </div>
                <div class="info info-horizontal">
                    <div class="icon icon-primary">
                        <i class="material-icons">phone</i>
                    </div>
                    <div class="description">
                        <h4 class="info-title">Çağrı Merkezi</h4>
                        <p>
                            <br> +90 312 911 9024
                            <br> Pazartesi - Pazar, 00:00-23:59
                        </p>
                    </div>
                </div>
                <div class="info info-horizontal">
                    <div class="icon icon-primary">
                        <i class="material-icons">business_center</i>
                    </div>
                    <div class="description">
                        <h4 class="info-title">Yasal Bilgi</h4>
                        <p> DOCKER EX A.Ş.
                            <br> Vergi No &#xB7; 34xxxxxx
                            <br> IBAN &#xB7; TRXXXXXXXXX
                            <br> Bank &#xB7; GARANTİ BANKASI A.Ş
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#name,#surname,#email,#phone').keypress(function (e) {
            if (e.keyCode == 13)
                $('#contactButton').click();
        });


        $('#contactButton').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('contact.store')}}',
                data: $('#contactForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById("contactButton").disabled = true;
                    document.getElementById("contactButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {

                    document.getElementById("contactForm").reset();
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
                    document.getElementById("contactButton").disabled = false;
                    document.getElementById("contactButtonSpinner").className = "";

                },
            });

        });

    </script>
@endsection
@section('css')
    <style>
        .info {
            padding-top: 0px;
        }
    </style>
@endsection
@section('script')
@endsection
