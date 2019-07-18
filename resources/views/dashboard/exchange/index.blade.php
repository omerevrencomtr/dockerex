@extends('dashboard.layouts.app')
@section('title') Borsa {{$currencyBuying->name}}/{{$currencySelling->name}} @endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-info">
                            <div class="card-icon">
                                <i class="material-icons">graphic_eq</i>
                            </div>
                            <h4 class="card-title ">Grafik</h4>
                        </div>
                        <div class="card-body">
                            <div id="volume-BTC" style="height: 600px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 cards">
                    <div class="card card-pricing card-raised">
                        <div class="card-body">
                            <h6 class="card-category"><i class="{{$currencySelling->icon}}"></i> Son Fiyat</h6>
                            <h3 class="card-title mt-0">{{number_format(($exchange->actual_price),2,'.',',')}} {{$currencySelling->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 cards">
                    <div class="card card-pricing card-raised">
                        <div class="card-body">
                            <h6 class="card-category"><i class="fa fa-arrow-down"></i> Alış Fiyatı</h6>
                            <h3 class="card-title mt-0">{{number_format(($exchange->actual_price),2,'.',',')}} {{$currencySelling->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 cards">
                    <div class="card card-pricing card-raised">
                        <div class="card-body">
                            <h6 class="card-category"><i class="fa fa-arrow-up"></i> Satış Fiyatı</h6>
                            <h3 class="card-title mt-0">{{number_format(($exchange->actual_price),2,'.',',')}} {{$currencySelling->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 cards">
                    <div class="card card-pricing card-raised">
                        <div class="card-body">
                            <h6 class="card-category"><i class="fa fa-exchange"></i> Hacim</h6>
                            <h3 class="card-title mt-0">{{number_format(($exchange->volume),2,'.',',')}} {{$currencyBuying->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 cards">
                    <div class="card card-pricing card-raised">
                        <div class="card-body">
                            <h6 class="card-category"><i class="fa fa-arrow-up"></i> 24s Yüksek</h6>
                            <h3 class="card-title mt-0">{{number_format(($exchange->actual_price),2,'.',',')}} {{$currencySelling->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 cards">
                    <div class="card card-pricing card-raised">
                        <div class="card-body">
                            <h6 class="card-category"><i class="fa fa-arrow-down"></i> 24s Düşük</h6>
                            <h3 class="card-title mt-0">{{number_format(($exchange->actual_price),2,'.',',')}} {{$currencySelling->name}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-success">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title ">Alış Emirleri</h4>
                        </div>
                        <div class="card-body" id="buyBody">
                            <div id="table" class="">
                                <table class="table table-hover table-striped table-bordered mb-0" id="buyTable">
                                    <thead class="text-primary">
                                    <th>Toplam</th>
                                    <th>Miktar</th>
                                    <th>Fiyat</th>
                                    </thead>
                                    <tbody align="right">
                                    @foreach($buyingOrders as $buyingOrder)
                                        <tr class="">
                                            <td>{{number_format(($buyingOrder->total),$currencySelling->decimal,'.',',')}}</td>
                                            <td>{{number_format(($buyingOrder->amount),$currencyBuying->decimal,'.',',')}}</td>
                                            <td class="bid">{{number_format(($buyingOrder->price),$currencySelling->decimal,'.',',')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <span>{{number_format(($buyDepth->sum('amount')),$currencyBuying->decimal,'.',',')}}</span>
                                        <span>{{$currencyBuying->name}}</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span>{{number_format(($buyDepth->sum('total')),$currencySelling->decimal,'.',',')}}</span>
                                        <span>{{$currencySelling->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-info">
                            <div class="card-icon">
                                <i class="material-icons">swap_horizontal_circle</i>
                            </div>
                            <h4 class="card-title ">Emir Konsolu</h4>
                        </div>
                        <div class="card-body" id="consoleBody">
                            <div class="page-categories">
                                <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center"
                                    role="tablist">
                                    <li class="nav-item nav-item-change">
                                        <a class="nav-link active bg-success" data-toggle="tab" id="buyFormTab"
                                           href="#buyForm"
                                           role="tablist">
                                            <i class="{{$currencySelling->icon}} p-0"></i> {{$currencyBuying->name}} Al
                                        </a>
                                    </li>
                                    <li class="nav-item nav-item-change">
                                        <a class="nav-link bg-danger" data-toggle="tab" id="sellFormTab"
                                           href="#sellForm"
                                           role="tablist">
                                            <i class="{{$currencyBuying->icon}}  p-0"></i> {{$currencyBuying->name}} Sat
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-space tab-subcategories">
                                    <div class="tab-pane active" id="buyForm">
                                        <form id="orderBuyForm" class="form-horizontal">
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Adet ({{$currencyBuying->name}}
                                                    )</label>
                                                <div class="col-md-9">
                                                    <div class="input-group form-group has-default ">
                                                        <input name="amount" id="buyAmount"
                                                               type="text"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Fiyat ({{$currencySelling->name}}
                                                    )</label>
                                                <div class="col-md-9">
                                                    <div class="input-group form-group has-default ">
                                                        <input id="buyPrice" name="price"
                                                               type="text"
                                                               class="form-control">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-prepend">
                                                                <button data-toggle="tooltip" data-placement="top"
                                                                        title="Listedeki ilk alış fiyatı"
                                                                        id="buyFirstBuyPrice"
                                                                        class="btn btn-outline-success" type="button"><i
                                                                        class="fa fa-cart-plus"></i></button>
                                                            </div>
                                                            <div class="input-group-prepend">
                                                                <button data-toggle="tooltip" data-placement="top"
                                                                        title="Listedeki ilk satış fiyatı"
                                                                        id="buyFirstSellPrice"
                                                                        class="btn btn-outline-danger" type="button"><i
                                                                        class="fa fa-cart-arrow-down"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Ara Toplam
                                                    ({{$currencySelling->name}})</label>
                                                <div class="col-md-9">
                                                    <div class="input-group form-group has-default ">
                                                        <input readonly name="subtotal" id="buySubtotal"
                                                               type="text"
                                                               class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Komisyon
                                                    ({{$currencySelling->name}})</label>
                                                <div class="col-md-9">
                                                    <div class="form-group bmd-form-group">
                                                        <input data-toggle="tooltip" data-placement="top"
                                                               title="Komisyon tahmini hesaplanır. Emir girişi yapıldıktan sonra komisyonu görebilirsiniz."
                                                               readonly class="form-control" type="text"
                                                               name="commission" id="buyCommission">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Toplam
                                                    ({{$currencySelling->name}})</label>
                                                <div class="col-md-9">
                                                    <div class="input-group form-group has-default ">
                                                        <input name="total" id="buyTotal"
                                                               type="text"
                                                               class="form-control">
                                                        <div class="input-group-prepend">
                                                            <button data-toggle="tooltip" data-placement="top"
                                                                    title="Bakiyemin tamamı" id="buyTotalAmount"
                                                                    class="btn btn-outline-light" type="button"><i
                                                                    class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-control mb-3">
                                                <button id="orderBuyButton" data-toggle="tooltip" data-placement="top"
                                                        title="{{$currencySelling->name}} ile {{$currencyBuying->name}} Al"
                                                        class="btn btn-success btn-block">Alış
                                                    Emri Gir <i id="orderBuyButtonSpinner"
                                                                class="{{$currencySelling->icon}}"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="sellForm">
                                        <form id="orderSellForm" class="form-horizontal">
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Adet ({{$currencyBuying->name}}
                                                    )</label>
                                                <div class="col-md-9">
                                                    <div class="input-group form-group has-default ">
                                                        <input name="amount" id="sellAmount"
                                                               type="text"
                                                               class="form-control">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-prepend">
                                                                <button data-toggle="tooltip" data-placement="top"
                                                                        title="Bakiyemin tamamı"
                                                                        id="sellTotalAmount"
                                                                        class="btn btn-outline-light" type="button"><i
                                                                        class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Fiyat ({{$currencySelling->name}}
                                                    )</label>
                                                <div class="col-md-9">
                                                    <div class="input-group form-group has-default ">
                                                        <input name="price" id="sellPrice"
                                                               type="text"
                                                               class="form-control">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-prepend">
                                                                <button data-toggle="tooltip" data-placement="top"
                                                                        title="Listedeki ilk alış fiyatı"
                                                                        id="sellFirstBuyPrice"
                                                                        class="btn btn-outline-success" type="button"><i
                                                                        class="fa fa-cart-plus"></i></button>
                                                            </div>
                                                            <div class="input-group-prepend">

                                                                <button data-toggle="tooltip" data-placement="top"
                                                                        title="Listedeki ilk satış fiyatı"
                                                                        id="sellFirstSellPrice"
                                                                        class="btn btn-outline-danger" type="button"><i
                                                                        class="fa fa-cart-arrow-down"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Ara Toplam
                                                    ({{$currencySelling->name}})</label>
                                                <div class="col-md-9">
                                                    <div class="input-group form-group has-default ">
                                                        <input readonly name="subtotal" id="sellSubtotal"
                                                               type="text"
                                                               class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Komisyon
                                                    ({{$currencySelling->name}})</label>
                                                <div class="col-md-9">
                                                    <div class="form-group bmd-form-group">
                                                        <input data-toggle="tooltip" data-placement="top"
                                                               title="Komisyon tahmini hesaplanır. Emir girişi yapıldıktan sonra komisyonu görebilirsiniz."
                                                               readonly class="form-control" type="text"
                                                               name="commission" id="sellCommission"
                                                               required="true" aria-required="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Toplam
                                                    ({{$currencySelling->name}})</label>
                                                <div class="col-md-9">
                                                    <div class="input-group form-group has-default ">
                                                        <input name="total" id="sellTotal"
                                                               type="text"
                                                               class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-control mb-3">
                                                <button id="orderSellButton" data-toggle="tooltip" data-placement="top"
                                                        title="{{$currencySelling->name}} ile {{$currencyBuying->name}} Sat"
                                                        class="btn btn-danger btn-block">Satış
                                                    Emri Gir <i id="orderSellButtonSpinner"
                                                                class="{{$currencyBuying->icon}}"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">

                                                <div class="col-md-9">
                                                    <div class="form-group bmd-form-group">
                                                        <input id="buyBalance"
                                                               value="{{number_format(($sellingBalance->balance),$currencySelling->decimal,'.',',')}}"
                                                               data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="Kullanıla bilir {{$currencySelling->name}} bakiyeniz"
                                                               readonly class="form-control text-center" type="text"
                                                               name="required"
                                                               required="true" aria-required="true">
                                                    </div>
                                                </div>
                                                <label
                                                    class="col-md-3 col-form-label label-on-right">{{$currencySelling->name}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group bmd-form-group">
                                                        <input id="sellBalance"
                                                               value="{{number_format(($buyingBalance->balance),$currencyBuying->decimal,'.',',')}}"
                                                               data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="Kullanıla bilir {{$currencyBuying->name}} bakiyeniz"
                                                               readonly class="form-control text-center" type="text"
                                                               name="required"
                                                               required="true" aria-required="true">
                                                    </div>
                                                </div>
                                                <label
                                                    class="col-md-3 col-form-label label-on-right">{{$currencyBuying->name}}</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-danger">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">Satış Emirleri</h4>
                        </div>
                        <div class="card-body table-hover" id="sellBody">
                            <div id="table" class=" ">
                                <table class="table table-hover table-striped table-bordered mb-0" id="sellTable">
                                    <thead class="text-primary">
                                    <th>Fiyat</th>
                                    <th>Miktar</th>
                                    <th>Toplam</th>
                                    </thead>
                                    <tbody align="right">
                                    @foreach($sellingOrders as $sellingOrder)
                                        <tr>
                                            <td class="ask">{{number_format(($sellingOrder->price),$currencySelling->decimal,'.',',')}}</td>
                                            <td>{{number_format(($sellingOrder->amount),$currencyBuying->decimal,'.',',')}}</td>
                                            <td>{{number_format(($sellingOrder->total),$currencySelling->decimal,'.',',')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <span>{{number_format(($sellDepth->sum('total')),$currencySelling->decimal,'.',',')}}</span>
                                        <span>{{$currencySelling->name}}</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span>{{number_format(($sellDepth->sum('amount')),$currencyBuying->decimal,'.',',')}}</span>
                                        <span>{{$currencyBuying->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-info">
                            <div class="card-icon">
                                <i class="material-icons">history</i>
                            </div>
                            <h4 class="card-title ">Market Geçmişi</h4>
                        </div>
                        <div class="card-body">
                            <table id="financialCryptoPendingTable" width="100%"
                                   class="table table-hover table-striped table-bordered dt-responsive">
                                <thead>
                                <tr>
                                    <th>İşlem tarihi</th>
                                    <th>Koin</th>
                                    <th>Yön</th>
                                    <th>Adres</th>
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
                        <div class="card-header card-header-icon card-header-info">
                            <div class="card-icon">
                                <i class="material-icons">open_in_new</i>
                            </div>
                            <h4 class="card-title ">Açık Emirler</h4>
                        </div>
                        <div class="card-body">
                            <table id="financialCryptoPendingTable" width="100%"
                                   class="table table-hover table-striped table-bordered dt-responsive">
                                <thead>
                                <tr>
                                    <th>İşlem tarihi</th>
                                    <th>Koin</th>
                                    <th>Yön</th>
                                    <th>Adres</th>
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
                        <div class="card-header card-header-icon card-header-info">
                            <div class="card-icon">
                                <i class="material-icons">book</i>
                            </div>
                            <h4 class="card-title ">Tamamlanan Emirler</h4>
                        </div>
                        <div class="card-body">
                            <table id="financialCryptoPendingTable" width="100%"
                                   class="table table-hover table-striped table-bordered dt-responsive">
                                <thead>
                                <tr>
                                    <th>İşlem tarihi</th>
                                    <th>Koin</th>
                                    <th>Yön</th>
                                    <th>Adres</th>
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
        </div>
    </div>
@endsection
@section('script')


    <script>
        var socket = io.connect('{{config('broadcasting.url')}}');
        socket.emit('subscribe', {
            channel: 'exchange.{{$exchange->id}}',
            auth: {}
        });
        socket.on("App\\Events\\ExchangeEvent", function (msg, obj) {

            if(obj.direction=='sell'){
                socketSellTable(obj.price, obj.amount, obj.key);
            }

            if(obj.direction=='buy'){
                socketBuyTable(obj.price, obj.amount, obj.key);
            }



        });
    </script>
    <script>

        function formatMoney(n, c, d, t) {
            var c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
                j = (j = i.length) > 3 ? j % 3 : 0;

            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };


        function socketSellTable(price, amount, key = null) {

            price = parseFloat(price.toString().replace(/,/g, ""));
            amount = parseFloat(amount.toString().replace(/,/g, ""));

            var rows = $("#sellTable tbody tr");
            var index = rows.length;
            var total = 0;
            var add = 0;
            var equal = false;
            var tablePrice = 0;
            var tableAmount = 0;
            var i;
            for (i = 0; i < index; i++) {
                tablePrice = parseFloat(rows[i].cells[0].innerText.replace(/,/g, ""));
                tableAmount = parseFloat(rows[i].cells[1].innerText.replace(/,/g, ""));

                if (tablePrice == price) {

                    equal = true;
                    break;
                } else if (tablePrice > price) {
                    console.log(tablePrice);
                    equal = false;
                    break;
                } else {
                    equal = false;
                }
            }
            add = i;
            var table = document.getElementById("sellTable").getElementsByTagName('tbody')[0];

            console.log(price);
            if (key == 'add' && equal == true) {
                rows[i].cells[0].innerText = formatMoney(price, '{{$currencySelling->decimal}}', '.', ',');
                rows[i].cells[1].innerText = formatMoney(amount + tableAmount, '{{$currencyBuying->decimal}}', '.', ',');
                rows[i].cells[2].innerText = formatMoney(((amount + tableAmount) * price), '{{$currencySelling->decimal}}', '.', ',');


                $(rows[i].cells[0]).fadeOut(250).addClass("bg-success").fadeIn(250);
                $(rows[i].cells[1]).fadeOut(250).addClass("bg-success").fadeIn(250);
                $(rows[i].cells[2]).fadeOut(250).addClass("bg-success").fadeIn(250);
                setTimeout(function () {
                    $(rows[i].cells[0]).removeClass('bg-success');
                    $(rows[i].cells[1]).removeClass('bg-success');
                    $(rows[i].cells[2]).removeClass('bg-success');
                }, 500);

            } else if (key == 'add' && equal == false) {

                var row = table.insertRow(add);
                var cell0 = row.insertCell(0);
                var cell1 = row.insertCell(1);
                var cell2 = row.insertCell(2);
                cell0.innerText = formatMoney(price, '{{$currencySelling->decimal}}', '.', ',');
                cell1.innerText = formatMoney(amount, '{{$currencyBuying->decimal}}', '.', ',');
                cell2.innerText = formatMoney((amount * price), '{{$currencySelling->decimal}}', '.', ',');

                cell0.className = 'ask';

                console.log(row);

                $(cell0).fadeOut(250).addClass("bg-success").fadeIn(250);
                $(cell1).fadeOut(250).addClass("bg-success").fadeIn(250);
                $(cell2).fadeOut(250).addClass("bg-success").fadeIn(250);
                setTimeout(function () {
                    $(cell0).removeClass('bg-success');
                    $(cell1).removeClass('bg-success');
                    $(cell2).removeClass('bg-success');
                }, 500);


            }


            if (key == 'remove' && equal == true) {

                if ((tableAmount - amount) <= 0) {
                    $(rows[i].cells[0]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    $(rows[i].cells[1]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    $(rows[i].cells[2]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    setTimeout(function () {
                        $(rows[i].cells[0]).removeClass('bg-danger');
                        $(rows[i].cells[1]).removeClass('bg-danger');
                        $(rows[i].cells[2]).removeClass('bg-danger');
                        table.deleteRow(add);
                    }, 500);

                } else {
                    rows[i].cells[0].innerText = formatMoney(price, '{{$currencySelling->decimal}}', '.', ',');
                    rows[i].cells[1].innerText = formatMoney(tableAmount - amount, '{{$currencyBuying->decimal}}', '.', ',');
                    rows[i].cells[2].innerText = formatMoney(((tableAmount - amount) * price), '{{$currencySelling->decimal}}', '.', ',');
                    $(rows[i].cells[0]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    $(rows[i].cells[1]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    $(rows[i].cells[2]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    setTimeout(function () {
                        $(rows[i].cells[0]).removeClass('bg-danger');
                        $(rows[i].cells[1]).removeClass('bg-danger');
                        $(rows[i].cells[2]).removeClass('bg-danger');
                    }, 500);
                }


            }

            if (key == 'operation' && equal == true) {

                if ((tableAmount - amount) <= 0) {
                    $(rows[i].cells[0]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    $(rows[i].cells[1]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    $(rows[i].cells[2]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    setTimeout(function () {
                        $(rows[i].cells[0]).removeClass('bg-warning');
                        $(rows[i].cells[1]).removeClass('bg-warning');
                        $(rows[i].cells[2]).removeClass('bg-warning');
                        table.deleteRow(add);
                    }, 500);

                } else {
                    rows[i].cells[0].innerText = formatMoney(price, '{{$currencySelling->decimal}}', '.', ',');
                    rows[i].cells[1].innerText = formatMoney(tableAmount - amount, '{{$currencyBuying->decimal}}', '.', ',');
                    rows[i].cells[2].innerText = formatMoney(((tableAmount - amount) * price), '{{$currencySelling->decimal}}', '.', ',');
                    $(rows[i].cells[0]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    $(rows[i].cells[1]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    $(rows[i].cells[2]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    setTimeout(function () {
                        $(rows[i].cells[0]).removeClass('bg-warning');
                        $(rows[i].cells[1]).removeClass('bg-warning');
                        $(rows[i].cells[2]).removeClass('bg-warning');
                    }, 500);
                }


            }

        }


        function socketBuyTable(price, amount, key = null) {

            price = parseFloat(price.toString().replace(/,/g, ""));
            amount = parseFloat(amount.toString().replace(/,/g, ""));

            var rows = $("#buyTable tbody tr");
            var index = rows.length;
            var total = 0;
            var add = 0;
            var equal = false;
            var tablePrice = 0;
            var tableAmount = 0;
            var i=0;
            for (i = 0; i < index; i++) {
                tablePrice = parseFloat(rows[i].cells[2].innerText.replace(/,/g, ""));
                tableAmount = parseFloat(rows[i].cells[1].innerText.replace(/,/g, ""));

                if (tablePrice == price) {

                    equal = true;
                    break;
                } else if (tablePrice < price) {
                    console.log(tablePrice);
                    equal = false;
                    break;
                } else {
                    equal = false;
                }
            }

            console.log(i+"--"+"--"+tablePrice+"--"+price)
            add = i;


            var table = document.getElementById("buyTable").getElementsByTagName('tbody')[0];

            console.log(price);
            if (key == 'add' && equal == true) {
                rows[i].cells[2].innerText = formatMoney(price, '{{$currencySelling->decimal}}', '.', ',');
                rows[i].cells[1].innerText = formatMoney(amount + tableAmount, '{{$currencyBuying->decimal}}', '.', ',');
                rows[i].cells[0].innerText = formatMoney(((amount + tableAmount) * price), '{{$currencySelling->decimal}}', '.', ',');


                $(rows[i].cells[2]).fadeOut(250).addClass("bg-success").fadeIn(250);
                $(rows[i].cells[1]).fadeOut(250).addClass("bg-success").fadeIn(250);
                $(rows[i].cells[0]).fadeOut(250).addClass("bg-success").fadeIn(250);
                setTimeout(function () {
                    $(rows[i].cells[2]).removeClass('bg-success');
                    $(rows[i].cells[1]).removeClass('bg-success');
                    $(rows[i].cells[0]).removeClass('bg-success');
                }, 500);

            } else if (key == 'add' && equal == false) {

                var row = table.insertRow(add);
                var cell0 = row.insertCell(0);
                var cell1 = row.insertCell(1);
                var cell2 = row.insertCell(2);


                cell2.innerText = formatMoney(price, '{{$currencySelling->decimal}}', '.', ',');
                cell1.innerText = formatMoney(amount, '{{$currencyBuying->decimal}}', '.', ',');
                cell0.innerText = formatMoney((amount * price), '{{$currencySelling->decimal}}', '.', ',');

                cell2.className = 'bid';

                console.log(row);

                $(cell2).fadeOut(250).addClass("bg-success").fadeIn(250);
                $(cell1).fadeOut(250).addClass("bg-success").fadeIn(250);
                $(cell0).fadeOut(250).addClass("bg-success").fadeIn(250);
                setTimeout(function () {
                    $(cell2).removeClass('bg-success');
                    $(cell1).removeClass('bg-success');
                    $(cell0).removeClass('bg-success');
                }, 500);


            }


            if (key == 'remove' && equal == true) {

                if ((tableAmount - amount) <= 0) {
                    $(rows[i].cells[2]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    $(rows[i].cells[1]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    $(rows[i].cells[0]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    setTimeout(function () {
                        $(rows[i].cells[2]).removeClass('bg-danger');
                        $(rows[i].cells[1]).removeClass('bg-danger');
                        $(rows[i].cells[0]).removeClass('bg-danger');
                        table.deleteRow(add);
                    }, 500);

                } else {
                    rows[i].cells[2].innerText = formatMoney(price, '{{$currencySelling->decimal}}', '.', ',');
                    rows[i].cells[1].innerText = formatMoney(tableAmount - amount, '{{$currencyBuying->decimal}}', '.', ',');
                    rows[i].cells[0].innerText = formatMoney(((tableAmount - amount) * price), '{{$currencySelling->decimal}}', '.', ',');
                    $(rows[i].cells[2]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    $(rows[i].cells[1]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    $(rows[i].cells[0]).fadeOut(250).addClass("bg-danger").fadeIn(250);
                    setTimeout(function () {
                        $(rows[i].cells[2]).removeClass('bg-danger');
                        $(rows[i].cells[1]).removeClass('bg-danger');
                        $(rows[i].cells[0]).removeClass('bg-danger');
                    }, 500);
                }


            }

            if (key == 'operation' && equal == true) {

                if ((tableAmount - amount) <= 0) {
                    $(rows[i].cells[2]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    $(rows[i].cells[1]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    $(rows[i].cells[0]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    setTimeout(function () {
                        $(rows[i].cells[2]).removeClass('bg-warning');
                        $(rows[i].cells[1]).removeClass('bg-warning');
                        $(rows[i].cells[0]).removeClass('bg-warning');
                        table.deleteRow(add);
                    }, 500);

                } else {
                    rows[i].cells[2].innerText = formatMoney(price, '{{$currencySelling->decimal}}', '.', ',');
                    rows[i].cells[1].innerText = formatMoney(tableAmount - amount, '{{$currencyBuying->decimal}}', '.', ',');
                    rows[i].cells[0].innerText = formatMoney(((tableAmount - amount) * price), '{{$currencySelling->decimal}}', '.', ',');
                    $(rows[i].cells[2]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    $(rows[i].cells[1]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    $(rows[i].cells[0]).fadeOut(250).addClass("bg-warning").fadeIn(250);
                    setTimeout(function () {
                        $(rows[i].cells[2]).removeClass('bg-warning');
                        $(rows[i].cells[1]).removeClass('bg-warning');
                        $(rows[i].cells[0]).removeClass('bg-warning');
                    }, 500);
                }


            }

        }


    </script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script>
        /**
         * Load new data depending on the selected min and max
         */
        function afterSetExtremes(e) {

            var chart = Highcharts.charts[0];

            chart.showLoading('Grafik Oluşturuluyor');
            $.getJSON('https://www.highcharts.com/samples/data/from-sql.php?start=' + Math.round(e.min) +
                '&end=' + Math.round(e.max) + '&callback=?', function (data) {

                chart.series[0].setData(data);
                chart.hideLoading();
            });
        }

        // See source code from the JSONP handler at https://github.com/highcharts/highcharts/blob/master/samples/data/from-sql.php
        $.getJSON('https://www.highcharts.com/samples/data/from-sql.php?callback=?', function (data) {

            // Add a null value for the end date
            data = [].concat(data, [[Date.UTC(2011, 9, 14, 19, 59), null, null, null, null]]);

            // create the chart
            Highcharts.stockChart('volume-BTC', {
                plotOptions: {
                    candlestick: {
                        color: '#c00000',
                        upColor: '#116d28'
                    }
                },

                chart: {
                    type: 'candlestick',
                    zoomType: 'x'
                },

                navigator: {
                    adaptToUpdatedData: false,
                    series: {
                        data: data
                    }
                },

                scrollbar: {
                    liveRedraw: false
                },

                title: {
                    text: 'BTC Fiyat / Hacim'
                },

                subtitle: {
                    text: ''
                },

                rangeSelector: {
                    buttons: [{
                        type: 'hour',
                        count: 1,
                        text: '1s'
                    }, {
                        type: 'day',
                        count: 1,
                        text: '1g'
                    }, {
                        type: 'week',
                        count: 1,
                        text: '1h'
                    }, {
                        type: 'month',
                        count: 1,
                        text: '1a'
                    }, {
                        type: 'year',
                        count: 1,
                        text: '1y'
                    }, {
                        type: 'YTD',
                        text: 'YBB'
                    }],
                    inputEnabled: true,
                    selected: 4
                },

                xAxis: {
                    events: {
                        afterSetExtremes: afterSetExtremes
                    },
                    minRange: 3600 * 1000 // one hour
                },

                yAxis: {
                    floor: 0
                },

                series: [{
                    data: data,
                    name: 'BTC / TL',
                    dataGrouping: {
                        enabled: false
                    }
                }]
            });
        });
    </script>

    <script>

        $(document).ready(function () {

            $('#orderBuyButton').click(function () {
                $.ajax({

                    type: "POST",
                    url: '{{route('dashboard.exchange.buy', ['buying_name'=>$currencyBuying->name,'selling_name'=>$currencySelling->name])}}',
                    data: $('#orderBuyForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    datatype: 'json',
                    beforeSend: function () {
                        document.getElementById("orderBuyButton").disabled = true;
                        document.getElementById("orderBuyButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
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
                        document.getElementById("orderBuyButton").disabled = false;
                        document.getElementById("orderBuyButtonSpinner").className = "{{$currencySelling->icon}}";

                    },
                });
            });


            $('#orderSellButton').click(function () {
                $.ajax({

                    type: "POST",
                    url: '{{route('dashboard.exchange.sell', ['buying_name'=>$currencyBuying->name,'selling_name'=>$currencySelling->name])}}',
                    data: $('#orderSellForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    datatype: 'json',
                    beforeSend: function () {
                        document.getElementById("orderSellButton").disabled = true;
                        document.getElementById("orderSellButtonSpinner").className = "fa fa-circle-o-notch fa-spin";
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
                        document.getElementById("orderSellButton").disabled = false;
                        document.getElementById("orderSellButtonSpinner").className = "{{$currencyBuying->icon}}";

                    },
                });
            });

        });


        var orderTotal = parseFloat('{{$orderTotal}}');
        var commissions = JSON.parse('{!!json_encode($commissions, true)!!}');

        $(document).ready(function () {

            $("#buyFirstBuyPrice").click(function () {
                var rows = $("#buyTable tbody tr");
                document.getElementById('buyPrice').value = parseFloat(rows[0].cells[2].innerText.replace(/,/g, "")).toFixed({{$currencySelling->decimal}});
            });

            $("#buyFirstSellPrice").click(function () {
                var rows = $("#sellTable tbody tr");
                document.getElementById('buyPrice').value = parseFloat(rows[0].cells[0].innerText.replace(/,/g, "")).toFixed({{$currencySelling->decimal}});
            });

            $("#buyTotalAmount").click(function () {
                document.getElementById('buyTotal').value = parseFloat(document.getElementById("buyBalance").value.replace(/,/g, "")).toFixed({{$currencySelling->decimal}});
            });

            $("#sellTable tbody tr").click(function () {
                $("#buyFormTab").click();
                var index = this.rowIndex;
                var rows = $("#sellTable tbody tr");
                var price = 0;
                var amount = 0;
                var subtotal = 0;
                var commission = 0;
                var total = 0;
                var i;
                for (i = 0; i < index; i++) {
                    price = parseFloat(rows[i].cells[0].innerText.replace(/,/g, ""));
                    amount += parseFloat(rows[i].cells[1].innerText.replace(/,/g, ""));
                    subtotal += parseFloat(rows[i].cells[2].innerText.replace(/,/g, ""));
                }

                commissions.forEach(function (item) {
                    if (parseFloat(item.min) <= parseFloat(orderTotal) && parseFloat(item.max) >= parseFloat(orderTotal)) {
                        commission = parseFloat(subtotal) * parseFloat(item.taker);
                    }
                });

                commission *= 1;
                total = subtotal + commission;

                document.getElementById('buyAmount').value = amount.toFixed({{$currencyBuying->decimal}});
                document.getElementById('buyPrice').value = price.toFixed({{$currencySelling->decimal}});
                document.getElementById('buySubtotal').value = subtotal.toFixed({{$currencySelling->decimal}});
                document.getElementById('buyCommission').value = commission.toFixed({{$currencySelling->decimal}});
                document.getElementById('buyTotal').value = total.toFixed({{$currencySelling->decimal}});
            });


            /* sell */
            function commissionCalculator(takerTotal = 0, makerTotal = 0, order = '') {
                var commission = 0;

                var makerCommission = 0;
                var takerCommission = 0;

                commissions.forEach(function (item) {
                    if (parseFloat(item.min) <= parseFloat(orderTotal) && parseFloat(item.max) >= parseFloat(orderTotal)) {
                        takerCommission = parseFloat(takerTotal) * parseFloat(item.taker);
                    }
                });

                commissions.forEach(function (item) {
                    if (parseFloat(item.min) <= parseFloat(orderTotal) && parseFloat(item.max) >= parseFloat(orderTotal)) {
                        makerCommission = parseFloat(makerTotal) * parseFloat(item.maker);
                    }
                });

                commission = makerCommission + takerCommission;
                if (order == 'buy') {
                    commission *= 1;
                } else if (order == 'sell') {
                    commission *= -1;
                } else {
                    commission;
                }
                return commission;
            }

            $("#sellPrice").keyup(function () {
                sellTotalCalculator(false, true);
            });

            $("#sellAmount").keyup(function () {
                sellTotalCalculator(true);
            });

            $("#sellPrice").change(function () {
                sellTotalCalculator();
            });

            $("#sellAmount").change(function () {
                sellTotalCalculator();
            });

            $("#sellTotal").change(function () {
                sellAmountCalculator();
            });

            $("#sellTotal").keyup(function () {
                sellAmountCalculator(true);
            });


            function sellAmountCalculator(fTotal = false) {
                $("#sellFormTab").click();
                var rows = $("#buyTable tbody tr");
                var price = parseFloat(document.getElementById('sellPrice').value);
                var amount = parseFloat(document.getElementById('sellAmount').value);
                var total = parseFloat(document.getElementById('sellTotal').value);
                var subTotal = parseFloat(document.getElementById('sellSubtotal').value);
                var length = rows.length;
                var commission = 0;

                var tablePrice = 0;
                var tableAmount = 0;
                var tableTotal = 0;

                var takerAmount = 0;
                var takerTotal = 0;

                var takerRemainingAmount = 0;
                var takerRemainingTotal = 0;

                var makerAmount;
                var makerTotal;

                var amountSet = 0;

                var i = 0;
                for (length -= 1; length >= i; length--) {
                    tablePrice = parseFloat(rows[length].cells[2].innerText.replace(/,/g, ""));
                    tableAmount = parseFloat(rows[length].cells[1].innerText.replace(/,/g, ""));
                    tableTotal = parseFloat(rows[length].cells[0].innerText.replace(/,/g, ""));

                    if (tablePrice >= price) {
                        if (price < tablePrice) {
                            break;
                        }
                        takerAmount += tableAmount;
                        takerTotal += tableTotal;

                        if (total == takerTotal) {

                            break;
                        }
                        if (total < takerTotal) {

                            takerRemainingTotal = total - takerTotal;
                            takerRemainingAmount = takerRemainingTotal / tablePrice;

                            takerTotal = takerRemainingTotal + takerTotal;
                            takerAmount = Math.abs(-1 * takerRemainingAmount - takerAmount);


                            break;
                        }

                    }
                }

                makerTotal = total - takerTotal;
                makerAmount = makerTotal / price;

                commission = commissionCalculator(takerTotal, makerTotal, 'sell');

                amount = makerAmount + takerAmount;
                subTotal = makerTotal + takerTotal + commission * -1;
                total = subTotal + commission;


                //amount=amount*1.0025;
                document.getElementById('sellAmount').value = amount.toFixed({{$currencyBuying->decimal}});

                document.getElementById('sellPrice').value = price.toFixed({{$currencySelling->decimal}});

                document.getElementById('sellSubtotal').value = subTotal.toFixed({{$currencySelling->decimal}});
                document.getElementById('sellCommission').value = commission.toFixed({{$currencySelling->decimal}});

                if (fTotal == false) {
                    document.getElementById('sellTotal').value = total.toFixed({{$currencySelling->decimal}});
                }
                sellTotalCalculator(false, false, true);
            }


            $("#sellFirstBuyPrice").click(function () {
                var rows = $("#buyTable tbody tr");
                document.getElementById('sellPrice').value = parseFloat(rows[0].cells[2].innerText.replace(/,/g, ""));
                sellTotalCalculator();
            });

            $("#sellFirstSellPrice").click(function () {
                var rows = $("#sellTable tbody tr");
                document.getElementById('sellPrice').value = parseFloat(rows[0].cells[0].innerText.replace(/,/g, ""));
                sellTotalCalculator();
            });

            $("#sellTotalAmount").click(function () {
                document.getElementById('sellAmount').value = parseFloat(document.getElementById("sellBalance").value.replace(/,/g, ""));
                sellTotalCalculator();
            });

            function sellTotalCalculator(fAmount = false, fPrice = false, fTotal = false) {
                $("#sellFormTab").click();
                var rows = $("#buyTable tbody tr");
                var price = parseFloat(document.getElementById('sellPrice').value);
                var amount = parseFloat(document.getElementById('sellAmount').value);
                var total = parseFloat(document.getElementById('sellTotal').value);
                var subTotal = parseFloat(document.getElementById('sellSubtotal').value);
                var length = rows.length;
                var commission = 0;

                var tablePrice = 0;
                var tableAmount = 0;
                var tableTotal = 0;

                var takerAmount = 0;
                var takerTotal = 0;

                var takerRemainingAmount = 0;
                var takerRemainingTotal = 0;

                var makerAmount;
                var makerTotal;

                var i = 0;
                for (length -= 1; length >= i; length--) {
                    tablePrice = parseFloat(rows[length].cells[2].innerText.replace(/,/g, ""));
                    tableAmount = parseFloat(rows[length].cells[1].innerText.replace(/,/g, ""));
                    tableTotal = parseFloat(rows[length].cells[0].innerText.replace(/,/g, ""));
                    if (tablePrice >= price) {
                        if (price < tablePrice) {
                            break;
                        }
                        takerAmount += tableAmount;
                        takerTotal += tableTotal;
                        if (amount == takerAmount) {
                            break;
                        }
                        if (amount < takerAmount) {
                            takerRemainingAmount = amount - takerAmount;
                            takerRemainingTotal = tablePrice * takerRemainingAmount;

                            takerAmount = takerAmount + takerRemainingAmount;
                            takerTotal = takerTotal - takerRemainingTotal * -1;
                            break;
                        }

                    }
                }


                makerAmount = amount - takerAmount;
                makerTotal = makerAmount * price;
                commission = commissionCalculator(takerTotal, makerTotal, 'sell');
                subTotal = makerTotal + takerTotal;

                total = subTotal + commission;
                if (fAmount == false) {
                    document.getElementById('sellAmount').value = amount.toFixed({{$currencyBuying->decimal}});
                }

                if (fPrice == false) {
                    document.getElementById('sellPrice').value = price.toFixed({{$currencySelling->decimal}});
                }

                document.getElementById('sellSubtotal').value = subTotal.toFixed({{$currencySelling->decimal}});
                document.getElementById('sellCommission').value = commission.toFixed({{$currencySelling->decimal}});

                if (fTotal == false) {
                    document.getElementById('sellTotal').value = total.toFixed({{$currencySelling->decimal}});
                }


            }

            $("#buyTable tbody tr").click(function () {
                var index = this.rowIndex;
                var rows = $("#buyTable tbody tr");
                var price = 0;
                var amount = 0;
                var i;
                for (i = 0; i < index; i++) {
                    price = parseFloat(rows[i].cells[2].innerText.replace(/,/g, ""));
                    amount += parseFloat(rows[i].cells[1].innerText.replace(/,/g, ""));
                }
                document.getElementById('sellAmount').value = amount;
                document.getElementById('sellPrice').value = price;
                sellTotalCalculator();
            });
        });

        $('#table tbody').perfectScrollbar();
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endsection

@section('css')
    <style>
        #table {
            border-right: 0px;
        }

        .bid {
            color: #4caf50;
        }

        .ask {
            color: #f44336;
        }

        #table thead, #table tbody, #table tr {
            display: block;
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }

        #table tbody {
            height: 452px;
            overflow-y: auto;
            overflow-x: hidden;
            position: relative;
        }

        #table thead th {
            display: block;
            width: 33.33%;
            float: left;
            border-left: 0px;
            padding: 5px;
        }

        #table tbody td {
            display: block;
            width: 33.33%;
            float: left;
            border-bottom: 0px;
            border-left: 0px;
            padding: 2px 2px 2px 2px;
        }

        #table tbody tr:hover {
            font-weight: 500;
            cursor: pointer;
        }

        #table tbody tr:active {
            font-weight: 900;

        }

        .table tbody tr:hover td {
            background-color: #ff9800;
        }


        .nav-item-change {
            width: 49% !important;
        }

        .table-min > tbody > tr > td {
            padding: 0px 8px;
        }

        .form-control[readonly], fieldset[readonly] .form-control, .form-group .form-control[readonly], fieldset[readonly] .form-group .form-control {
            background-color: transparent;
            cursor: not-allowed;
            border-bottom: 1px dotted #d2d2d2;
            background-repeat: no-repeat;
            border-bottom-width: 0px !important;
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
