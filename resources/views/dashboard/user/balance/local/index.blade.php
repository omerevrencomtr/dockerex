@extends('dashboard.layouts.app')
@section('title') Yerel Varlık Yönetimi @endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title ">Açıklamalar</h4>
                        </div>
                        <div class="card-body">
                            <span>Yatırdığınız tutarının hesabınıza en hızlı biçimde yansıtılabilmesi için;</span>


                            <ul>
                                <li>Para yatırımlarınız için atanan transfer kodunu üyeliğinizin devamınca kullana bilirsiniz.
                                </li>
                                <li><u>Adınıza kayıtlı</u> bir banka hesabından havale / eft yapılması,</li>
                                <li>Havale / eft işleminin ATM aracılığıyla <u>yapılmaması,</u></li>
                                <li>Sayfada belirtilen minumun tutardan aktarılan tutarın <u>aynı olması veya fazla olması</u></li>
                                <li>Sistem tarafından atanacak yatırım transfer kodunun havale / eft işlemi <u>açıklama
                                        kısmına
                                        eklenmiş olması,</u> gerekmektedir.
                                </li>
                            </ul>
                            <br/>
                            <b><span>Önemli:</span></b>
                            <ol>
                                <li>Hatalı gerçekletirilen havale / eft işlemlerinde transfer ücreti kesilerek gönderici hesaba iade edilir.
                                </li>
                                <li>Haftasonu gerçekleştirilen eft işlemleri haftanın tatil olmayan ilk iş günü
                                    onaylanacaktır.
                                </li>
                            </ol>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Birim</th>
                                        <th class="text-center">Min. yatırım tutarı</th>
                                        <th class="text-center">Onay sayısı</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($currencies as $currency)
                                        <tr>
                                            <td>{{$currency->long_name}}</td>
                                            <td class="text-center">{{$currency->deposit_min}}</td>
                                            <td class="text-center">{{$currency->approval_number}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title ">Varlıklarım</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-min">
                                    <thead>
                                    <tr>
                                        <th>Birim</th>
                                        <th class="text-right">Tutar</th>
                                        <th class="text-right">Kur</th>
                                        <th class="text-right">Değer</th>
                                        <th style="width: 1%;" class="text-center">Çek</th>
                                        <th style="width: 1%;" class="text-center">Yatır</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($currencies as $currency)
                                        <tr>
                                            <td>{{$currency->long_name}}</td>
                                            <td class="text-right"
                                                id="{{$currency->name}}Amount">{{number_format($currency->balance, 8, '.', ',')}}</td>
                                            <td class="text-right">{{number_format($currency->balance, 8, '.', ',')}}</td>
                                            <td class="text-right">{{number_format($currency->balance, 8, '.', ',')}}</td>
                                            <td class="text-center">
                                                <button id="{{$currency->name}}WithdrawButton"
                                                        onclick="withdraw('{{$currency->name}}')" type="button"
                                                        rel="tooltip" class="btn btn-danger btn-xs">
                                                    <i class="material-icons">account_balance_wallet</i><i
                                                        id="{{$currency->name}}WithdrawButtonSpinner"
                                                        class=''> </i>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <button id="{{$currency->name}}DepositButton"
                                                        onclick="deposit('{{$currency->name}}')" type="button"
                                                        rel="tooltip" class="btn btn-success btn-xs">
                                                    <i class="material-icons">account_balance</i><i
                                                        id="{{$currency->name}}DepositButtonSpinner"
                                                        class=''> </i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div style="display: none;" id="depositForm" class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal">
                                        <div class="form-control mb-3">
                                            <select name="bank" class="custom-select"
                                                    id="depositBank">
                                            </select>
                                        </div>

                                        <div style="display: none;" id="depositInfo">
                                            <div class="row">
                                                <label class="col-md-2 col-form-label">Ünvan</label>
                                                <div class="col-md-10">
                                                    <div class="input-group form-group has-default ">
                                                        <input value="test" readonly id="depositTitle"
                                                               type="text"
                                                               class="form-control readonly">
                                                        <div class="input-group-prepend">
                                                            <button id="depositTitleCopy"
                                                                    data-clipboard-target="#depositTitle"
                                                                    class="btn btn-outline-primary" type="button"><i
                                                                    class="fa fa-clone"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-2 col-form-label">Açıklama</label>
                                                <div class="col-md-10">
                                                    <div class="input-group form-group has-default ">
                                                        <input value="test" readonly id="depositDescription"
                                                               type="text"
                                                               class="form-control readonly">
                                                        <div class="input-group-prepend">
                                                            <button id="depositDescriptionCopy"
                                                                    data-clipboard-target="#depositDescription"
                                                                    class="btn btn-outline-primary" type="button"><i
                                                                    class="fa fa-clone"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-2 col-form-label">IBAN</label>
                                                <div class="col-md-10">
                                                    <div class="input-group form-group has-default ">
                                                        <input value="test" readonly id="depositAddress"
                                                               type="text"
                                                               class="form-control readonly">
                                                        <div class="input-group-prepend">
                                                            <button id="depositAddressCopy"
                                                                    data-clipboard-target="#depositAddress"
                                                                    class="btn btn-outline-primary" type="button"><i
                                                                    class="fa fa-clone"></i></button>
                                                        </div>
                                                        <div data-toggle="modal" data-target="#qrModal"
                                                             class="input-group-prepend">
                                                            <button class="btn btn-outline-primary qr" type="button"><i
                                                                    class="fa fa-qrcode"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <div style="display: none;" id="withdrawRow" class="row">
                                <div class="col-md-12">
                                    <form id="withdrawForm">
                                        <input type="hidden" id="withdrawCurrency" name="currency" value="">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><span id="withdrawName"></span>&nbsp;IBAN</span>
                                            </div>
                                            <input type="text" class="form-control" name="address" id="withdrawAddress"
                                                   placeholder="IBAN">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><span
                                                                id="withdrawAmountName"></span>&nbsp;Tutar</span>
                                                    </div>
                                                    <input type="text" name="amount" id="withdrawAmount"
                                                           class="form-control"
                                                           placeholder="Tutar">
                                                    <div class="input-group-prepend">
                                                        <button onclick="fullBalance()" value=""
                                                                id="withdrawFullBalanceButton"
                                                                class="btn btn-outline-primary" type="button">+
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mt-2">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Komisyon</span>
                                                    </div>
                                                    <select name="commission" class="custom-select"
                                                            id="withdrawCommissions">
                                                    </select>
                                                    <div class="input-group-prepend">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Toplam Tutar</span>
                                            </div>
                                            <input name="total" id="withdrawTotal" type="text" readonly="readonly"
                                                   class="form-control"
                                                   value="Toplam">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i id="withdrawTotalLogo"
                                                                                  class="fa fa-btc"></i></span>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="button" id="withdrawConfirmButton"
                                                    class="btn btn-danger btn-block">Çekim Talebi Oluştur <i
                                                    id="withdrawConfirmButtonSpinner"
                                                    class=''> </i></button>
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
    <!-- notice modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-notice">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Qr Kodu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <img
                        id="qrCodeImg"
                        src="https://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=&chld=H|0">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success btn-round" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end notice modal -->

    <!-- notice modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-notice">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawModalLabel">Para Çekim Onayı</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-left">Birim</td>
                                <td id="confirmCurrency" class="text-left">0.00100000</td>
                            </tr>
                            <tr>
                                <td class="text-left">IBAN</td>
                                <td id="confirmAddress" class="text-left">0.00100000</td>
                            </tr>
                            <tr>
                                <td class="text-left">Tutar</td>
                                <td id="confirmAmount" class="text-left">0.00100000</td>
                            </tr>
                            <tr>
                                <td class="text-left">Komisyon</td>
                                <td id="confirmCommission" class="text-left">0.00100000</td>
                            </tr>
                            <tr>
                                <td class="text-left">Toplam</td>
                                <td id="confirmTotal" class="text-left">0.00100000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <form id="withdrawFinalForm">
                        <input id="confirmCurrencyF" type="hidden" name="currency">
                        <input id="confirmAddressF" type="hidden" name="address">
                        <input id="confirmAmountF" type="hidden" name="amount">
                        <input id="confirmCommissionF" type="hidden" name="commission">
                        <div class="form-group has-default bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="material-icons">lock_outline</i>
                                                    </span>
                                </div>
                                <input type="number" name="confirmation_code" id="confirmCodeF" minlength="6"
                                       maxlength="6"
                                       placeholder=""
                                       class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="withdrawFinalButton" type="button" class="btn btn-link">Onayla <i
                            id="withdrawFinalButtonSpinner"
                            class=''> </i></button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end notice modal -->


    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title ">Bekleyen işlemler</h4>
                </div>
                <div class="card-body">
                    <table id="financialLocalPendingTable" width="100%"
                           class="table table-hover table-striped table-bordered dt-responsive">
                        <thead>
                        <tr>
                            <th>İşlem tarihi</th>
                            <th>Birim</th>
                            <th>Yön</th>
                            <th>IBAN</th>
                            <th>Transfer kodu</th>
                            <th>Tutar</th>
                            <th>Komisyon</th>
                            <th>Toplam</th>
                            <th style="width: 2%;">İptal</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title ">İşlem Geçmişi</h4>
                </div>
                <div class="card-body">
                    <table id="financialLocalHistoryTable" width="100%"
                           class="table table-hover table-striped table-bordered dt-responsive">
                        <thead>
                        <tr>
                            <th>İşlem tarihi</th>
                            <th>Birim</th>
                            <th>Yön</th>
                            <th>IBAN</th>
                            <th>Transfer kodu</th>
                            <th>Tutar</th>
                            <th>Komisyon</th>
                            <th>Toplam</th>
                            <th>Açıklama</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

    <style>


        .table-min > tbody > tr > td {
            padding: 0px 8px;
        }

        .form-control[readonly], fieldset[readonly] .form-control, .form-group .form-control[readonly], fieldset[readonly] .form-group .form-control {
            background-color: transparent;
            cursor: not-allowed;
            border-bottom: 1px dotted #d2d2d2;
            background-repeat: no-repeat;
        }

        fieldset[readonly][readonly] .form-control, .form-control.readonly, .form-control:readonly, .form-control[readonly] {
            background-image: linear-gradient(to right, #d2d2d2 0%, #d2d2d2 30%, transparent 30%, transparent 100%);
            background-repeat: repeat-x;
            background-size: 3px 1px;
        }

        .form-control:readonly, .form-control[readonly] {
            background-color: #e9ecef;
            opacity: 1;
        }
    </style>
@endsection


@section('script')

    <script>

        function deposit(name) {
            $.ajax({

                type: "POST",
                url: '{{route('dashboard.user.balance.local.deposit')}}',
                data: {'name': name},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById(name + "DepositButton").disabled = true;
                    document.getElementById(name + "DepositButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {
                    document.getElementById("withdrawRow").style.display = 'none';
                    document.getElementById("depositInfo").style.display = 'none';
                    document.getElementById("depositForm").style.display = 'block';
                    //document.getElementById("depositLogo").className = data.currency.icon;
                    //document.getElementById("depositAddress").value = data.address.address;
                    //document.getElementById("qrCodeImg").src = 'https://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=' + data.address.address + '&chld=H|0';

                    localStorage.setItem('balanceLocal', JSON.stringify(data));
                    var select = document.getElementById("depositBank");

                    select.options.length = 0;
                    for (datos in data.addresses) {
                        select.options[select.options.length] = new Option(data.addresses[datos].name, data.addresses[datos].address);
                    }

                    select.click();
                    //document.getElementById("depositLogo").className = data.currency.icon;
                    //document.getElementById("depositAddress").value = data.address.address;
                    //document.getElementById("qrCodeImg").src = 'https://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=' + data.address.address + '&chld=H|0';
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
                    document.getElementById(name + "DepositButton").disabled = false;
                    document.getElementById(name + "DepositButtonSpinner").className = "";

                },
            });
        }


        var historyTable = $('#financialLocalHistoryTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Turkish.json"
            },
            "visible": true,
            "responsive": true,
            "searching": false,
            "lengthChange": false,
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{route('dashboard.user.balance.local.getHistory')}}",
                "dataType": "json",
                "type": "POST",
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            },
        });

        var pendingTable = $('#financialLocalPendingTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Turkish.json"
            },
            "visible": true,
            "responsive": true,
            "searching": false,
            "lengthChange": false,
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{route('dashboard.user.balance.local.getPending')}}",
                "dataType": "json",
                "type": "POST",
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            },
        });


        //setInterval(function(){ table.draw(); }, 3000);

        function withdrawCancel(id) {
            $.ajax({
                type: "POST",
                url: '{{route('dashboard.user.balance.local.withdrawCancel')}}',
                data: {'id': id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
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
                    pendingTable.draw();
                    historyTable.draw();
                },
            });
        }

        $(document).ready(function () {

            $('#depositBank').click(function () {

                var balanceLocal = JSON.parse(localStorage.getItem('balanceLocal'));
                document.getElementById("depositAddress").value = balanceLocal.addresses[this.value].address;
                document.getElementById("depositTitle").value = balanceLocal.addresses[this.value].title;
                document.getElementById("depositDescription").value = balanceLocal.deposit_id;
                document.getElementById("depositInfo").style.display = 'block';
                document.getElementById("qrCodeImg").src = 'https://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=' + balanceLocal.addresses[this.value].address + '&chld=H|0';

            });

            $('#withdrawFinalButton').click(function () {
                $.ajax({
                    type: "POST",
                    url: '{{route('dashboard.user.balance.local.withdraw')}}',
                    data: $('#withdrawFinalForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    datatype: 'json',
                    beforeSend: function () {
                        document.getElementById("withdrawFinalButton").disabled = true;
                        document.getElementById("withdrawFinalButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                    },
                    success: function (data) {
                        pendingTable.draw();
                        historyTable.draw();
                        $('#withdrawModal').modal('hide');
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
                        document.getElementById("withdrawFinalButton").disabled = false;
                        document.getElementById("withdrawFinalButtonSpinner").className = "";

                    },
                });
            });


            $('#withdrawConfirmButton').click(function () {
                var amount = parseFloat(document.getElementById("withdrawAmount").value).toFixed(8);
                var commission = parseFloat(document.getElementById('withdrawCommissions').value).toFixed(8);
                var currency = document.getElementById("withdrawFullBalanceButton").value;
                document.getElementById("withdrawCurrency").value = currency;
                var balance = parseFloat(document.getElementById(currency + "Amount").innerText.replace(",", "")).toFixed(8);
                var address = document.getElementById("withdrawAddress").value;
                if (address == '') {
                    $.notify({
                        icon: "add_alert",
                        message: "IBAN girmediniz.",

                    }, {
                        type: 'warning',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });
                    return null;
                }

                if (parseFloat(balance) >= parseFloat(amount)) {

                    /* yeterli */
                    $.ajax({

                        type: "POST",
                        url: '{{route('dashboard.user.balance.local.getWithdrawConfirm')}}',
                        data: $('#withdrawForm').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        datatype: 'json',
                        beforeSend: function () {
                            document.getElementById("withdrawConfirmButton").disabled = true;
                            document.getElementById("withdrawConfirmButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                        },
                        success: function (data) {
                            $("#withdrawModal").modal();

                            document.getElementById("confirmAddress").innerText = data.data.address;
                            document.getElementById("confirmAmount").innerText = parseFloat(data.data.amount).toFixed(8);
                            document.getElementById("confirmCommission").innerText = parseFloat(data.data.commission).toFixed(8);
                            document.getElementById("confirmCurrency").innerText = data.data.currency;

                            document.getElementById("confirmAddressF").value = data.data.address;
                            document.getElementById("confirmAmountF").value = parseFloat(data.data.amount).toFixed(8);
                            document.getElementById("confirmCommissionF").value = parseFloat(data.data.commission).toFixed(8);
                            document.getElementById("confirmCurrencyF").value = data.data.currency;


                            var total = data.data.amount - data.data.commission;
                            document.getElementById("confirmTotal").innerText = parseFloat(total).toFixed(8);
                            var message = "";
                            if (data.key == "google2fa") {
                                message = "Lütfen Authenticayor uygulamanızın ürettiği kodu giriniz.";
                            } else {
                                message = "Lütfen telefonunuza gönderilen kodu giriniz.";
                            }
                            document.getElementById("confirmCodeF").placeholder = message;
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
                            document.getElementById("withdrawConfirmButton").disabled = false;
                            document.getElementById("withdrawConfirmButtonSpinner").className = "";

                        },
                    });


                } else {
                    $.notify({
                        icon: "add_alert",
                        message: "Bakiyeniz bu işlem için yetersiz.",

                    }, {
                        type: 'warning',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });
                }

            });


            $('#withdrawFullBalanceButton').click(function () {
                totalCalculator();
            });

            $('#withdrawAmount').keyup(function () {
                totalCalculator();
            });

            $('#withdrawCommissions').change(function () {
                totalCalculator();
            });

        });


        function totalCalculator() {

            var amount = parseFloat(document.getElementById("withdrawAmount").value).toFixed(8);
            var commission = parseFloat(document.getElementById('withdrawCommissions').value).toFixed(8);
            var total = amount - commission;
            document.getElementById("withdrawTotal").value = parseFloat(total).toFixed(8);

        }

        function fullBalance() {
            var currency = document.getElementById("withdrawFullBalanceButton").value;
            var amount = parseFloat(document.getElementById(currency + "Amount").innerText.replace(",", "")).toFixed(8);
            document.getElementById("withdrawAmount").value = amount;

        }

        var clipboard = new ClipboardJS('.btn');

        clipboard.on('success', function (e) {
            $(e.trigger).text("Kopyalandı");
            //e.clearSelection();
            setTimeout(function () {
                $(e.trigger).html('<i class="fa fa-clone"></i>');
            }, 2500);
        });

        clipboard.on('error', function (e) {
            $(e.trigger).text("Hata");
            setTimeout(function () {
                $(e.trigger).text("Copy");
            }, 2500);
        });

        function withdraw(name) {
            document.getElementById("withdrawFullBalanceButton").value = name;
            $.ajax({

                type: "POST",
                url: '{{route('dashboard.user.balance.local.getwithdraw')}}',
                data: {'name': name},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                beforeSend: function () {
                    document.getElementById(name + "WithdrawButton").disabled = true;
                    document.getElementById(name + "WithdrawButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
                },
                success: function (data) {

                    document.getElementById("depositForm").style.display = 'none';
                    document.getElementById("withdrawRow").style.display = 'block';

                    document.getElementById("withdrawName").innerText = data.currency.long_name;
                    document.getElementById("withdrawAmountName").innerText = data.currency.long_name;

                    document.getElementById("withdrawTotalLogo").className = data.currency.icon;

                    var select = document.getElementById("withdrawCommissions");

                    select.options.length = 0;
                    for (datos in data.currency.withdraw_commissions) {
                        select.options[select.options.length] = new Option(data.currency.withdraw_commissions[datos].amount, data.currency.withdraw_commissions[datos].amount);
                    }


                    //document.getElementById("depositLogo").className = data.currency.icon;
                    //document.getElementById("depositAddress").value = data.address.address;
                    //document.getElementById("qrCodeImg").src='http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl='+data.address.address+'&chld=H|0';
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
                    document.getElementById(name + "WithdrawButton").disabled = false;
                    document.getElementById(name + "WithdrawButtonSpinner").className = "";

                },
            });
        }

    </script>

@endsection
