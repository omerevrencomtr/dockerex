@extends('dashboard.layouts.app')
@section('title') Anasayfa @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach($tlExchanges as $tlExchange)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="{{$tlExchange->currency_buying_icon}}"></i>
                                </div>
                                <p class="card-category">{{$tlExchange->currency_buying_long_name}}
                                    <span id="{{$tlExchange->id}}-change_percent-c-t">
                                    <small><span
                                            id="{{$tlExchange->id}}-change_percent-t">{{number_format(($tlExchange->change_percent),$tlExchange->selling->decimal,'.',',')}}</span>
                                        %
                                    </small>
                                        </span>
                                </p>
                                <h2 class="card-title" id="{{$tlExchange->id}}-actual_price-c-t">
                                    <span
                                        id="{{$tlExchange->id}}-actual_price-t">{{number_format(($tlExchange->actual_price),$tlExchange->selling->decimal,'.',',')}}</span>
                                    <small><i class="{{$tlExchange->currency_selling_icon}}"></i></small>
                                </h2>
                            </div>
                            <div class="card-footer mt-0">
                                <small class="d-contents">
                                    <div class="float-left">
                                        Düşük: <span
                                            id="{{$tlExchange->id}}-low_price-c-t">{{number_format(($tlExchange->low_price),$tlExchange->selling->decimal,'.',',')}}</span>
                                    </div>
                                    <div class="text-center">
                                        Hacim: <span
                                            id="{{$tlExchange->id}}-volume-c-t">{{number_format(($tlExchange->volume),$tlExchange->selling->decimal,'.',',')}}</span>
                                    </div>
                                    <div class="float-right">
                                        Yüksek: <span
                                            id="{{$tlExchange->id}}-high_price-c-t">{{number_format(($tlExchange->high_price),$tlExchange->selling->decimal,'.',',')}}</span>
                                    </div>
                                </small>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-success">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Piyasalar:</span>
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        @foreach($exchangesGroups as $exchanges)
                                            @if ($loop->first)
                                                <li class="nav-item">
                                                    <a class="nav-link active"
                                                       href="#tab-{{$exchanges[0]->currency_selling_name}}"
                                                       data-toggle="tab">
                                                        <i class="{{$exchanges[0]->currency_selling_icon}}"></i> {{$exchanges[0]->currency_selling_long_name}}
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                       href="#tab-{{$exchanges[0]->currency_selling_name}}"
                                                       data-toggle="tab">
                                                        <i class="{{$exchanges[0]->currency_selling_icon}}"></i> {{$exchanges[0]->currency_selling_long_name}}
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach($exchangesGroups as $exchanges)
                                    <div class="tab-pane {{ $loop->first === true ? "active" : "" }}"
                                         id="tab-{{$exchanges[0]->currency_selling_name}}">
                                        <div class="table-responsive">
                                            <table style="min-width: 800px;" class="table table-hover table-bordered">
                                                <thead class="text-primary">
                                                <th>Piyasa</th>
                                                <th>Fiyat</th>
                                                <th>24s Değişim</th>
                                                <th>24s En Yüksek</th>
                                                <th>24s En Düşük</th>
                                                <th>Hacim</th>
                                                </thead>
                                                <tbody>
                                                @foreach($exchanges as $exchange)
                                                    <tr data-href="{{route('dashboard.exchange.index',['currency_buying_name'=>$exchange->currency_buying_name,'currency_selling_name'=>$exchange->currency_selling_name])}}">
                                                        <td>{{$exchange->currency_buying_name.' / '.$exchange->currency_selling_name}}</td>
                                                        <td id="{{$exchange->id}}-actual_price-c">
                                                                <span
                                                                    id="{{$exchange->id}}-actual_price">{{number_format(($exchange->actual_price),$exchange->selling->decimal,'.',',')}}</span> {{$exchange->currency_selling_name}}
                                                        </td>
                                                        <td id="{{$exchange->id}}-change_percent-c"><span
                                                                id="{{$exchange->id}}-change_percent">{{number_format(($exchange->change_percent),$exchange->selling->decimal,'.',',')}}</span> {{$exchange->currency_selling_name}}
                                                        </td>
                                                        <td id="{{$exchange->id}}-high_price-c"><span
                                                                id="{{$exchange->id}}-high_price">{{number_format(($exchange->high_price),$exchange->selling->decimal,'.',',')}}</span> {{$exchange->currency_selling_name}}
                                                        </td>
                                                        <td id="{{$exchange->id}}-low_price-c"><span
                                                                id="{{$exchange->id}}-low_price">{{number_format(($exchange->low_price),$exchange->selling->decimal,'.',',')}}</span> {{$exchange->currency_selling_name}}
                                                        </td>
                                                        <td id="{{$exchange->id}}-volume-c"><span
                                                                id="{{$exchange->id}}-volume">{{number_format(($exchange->volume),$exchange->selling->decimal,'.',',')}}</span> {{$exchange->currency_buying_name}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3>Blog</h3>
            <br>
            <div class="row">
                @if(isset($category->posts))
                @foreach($category->posts as $post)
                <div class="col-md-4">
                    <div class="card card-product">
                        <a href="_blank">
                            <div class="card-header card-header-image">
                                <img class="img" src="{{asset($post->image)}}">
                            </div>
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a target="_blank" href="{{$post->url}}"> {{$post->title}}</a>
                            </h4>
                            <div class="card-description">
                                {{$post->meta_description}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="price">
                                <h4>Medium</h4>
                            </div>
                            <div class="stats">
                                <p class="card-category"><i class="material-icons">place</i> {{$post->meta_key }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                    @endif
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        [data-href] {
            cursor: pointer;
        }

        .table > thead > tr > th, .table > tbody > tr > td {
            font-weight: 500;
        }


    </style>
@endsection
@section('script')
    <script type="text/javascript">
        var socket = io.connect('{{config('broadcasting.url')}}');
        socket.emit('subscribe', {
            channel: 'ticker',
            auth: {}
        });
        socket.on("App\\Events\\TickerEvent", function (msg, obj) {
            var ticker = obj.ticker;
            var actual_price = parseFloat(document.getElementById(ticker.id + '-actual_price').innerText.replace(/,/g, ""));
            var change_percent = parseFloat(document.getElementById(ticker.id + '-change_percent').innerText.replace(/,/g, ""));
            var high_price = parseFloat(document.getElementById(ticker.id + '-high_price').innerText.replace(/,/g, ""));
            var low_price = parseFloat(document.getElementById(ticker.id + '-low_price').innerText.replace(/,/g, ""));
            var volume = parseFloat(document.getElementById(ticker.id + '-volume').innerText.replace(/,/g, ""));
            if (actual_price > parseFloat(obj.ticker.actual_price.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-actual_price').innerText = obj.ticker.actual_price;
                $('#' + ticker.id + '-actual_price-t').text(obj.ticker.actual_price);
                texColor(obj.ticker.id, 'actual_price', true);
            } else if (actual_price < parseFloat(obj.ticker.actual_price.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-actual_price').innerText = obj.ticker.actual_price;
                $('#' + ticker.id + '-actual_price-t').text(obj.ticker.actual_price);
                texColor(obj.ticker.id, 'actual_price', false);
            }
            if (change_percent > parseFloat(obj.ticker.change_percent.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-change_percent').innerText = obj.ticker.change_percent;
                $('#' + ticker.id + '-change_percent-t').text(obj.ticker.actual_price);
                texColor(obj.ticker.id, 'change_percent', true);
            } else if (change_percent < parseFloat(obj.ticker.change_percent.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-change_percent').innerText = obj.ticker.change_percent;
                $('#' + ticker.id + '-change_percent-t').text(obj.ticker.change_percent);
                texColor(obj.ticker.id, 'change_percent', false);
            }
            if (high_price > parseFloat(obj.ticker.high_price.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-high_price').innerText = obj.ticker.high_price;
                $('#' + ticker.id + '-high_price-c-t').text(obj.ticker.high_price);
                texColor(obj.ticker.id, 'high_price', true);
            } else if (high_price < parseFloat(obj.ticker.high_price.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-high_price').innerText = obj.ticker.high_price;
                $('#' + ticker.id + '-high_price-c-t').text(obj.ticker.high_price);
                texColor(obj.ticker.id, 'high_price', false);
            }
            if (low_price > parseFloat(obj.ticker.low_price.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-low_price').innerText = obj.ticker.low_price;
                $('#' + ticker.id + '-low_price-c-t').text(obj.ticker.low_price);
                texColor(obj.ticker.id, 'low_price', true);
            } else if (low_price < parseFloat(obj.ticker.low_price.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-low_price').innerText = obj.ticker.low_price;
                $('#' + ticker.id + '-low_price-c-t').text(obj.ticker.low_price);
                texColor(obj.ticker.id, 'low_price', false);
            }
            if (volume > parseFloat(obj.ticker.volume.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-volume').innerText = obj.ticker.volume;
                $('#' + ticker.id + '-volume-c-t').text(obj.ticker.volume);
                texColor(obj.ticker.id, 'volume', true);
            } else if (volume < parseFloat(obj.ticker.volume.replace(/,/g, ""))) {
                document.getElementById(ticker.id + '-volume').innerText = obj.ticker.volume;
                $('#' + ticker.id + '-volume-c-t').text(obj.ticker.volume);
                texColor(obj.ticker.id, 'volume', false);
            }
        });

        function texColor(id, area, down) {

            if (down == false) {
                $('#' + id + '-' + area + '-c').fadeOut(250).addClass("text-success").fadeIn(250);
                $('#' + id + '-' + area + '-c-t').fadeOut(250).addClass("text-success").fadeIn(250);
                setTimeout(function () {
                    $('#' + id + '-' + area + '-c').removeClass('text-success');
                    $('#' + id + '-' + area + '-c-t').removeClass('text-success');
                }, 500);

            } else {
                $('#' + id + '-' + area + '-c').fadeOut(250).addClass("text-danger").fadeIn(250);
                $('#' + id + '-' + area + '-c-t').fadeOut(250).addClass("text-danger").fadeIn(250);


                setTimeout(function () {
                    $('#' + id + '-' + area + '-c').removeClass('text-danger');
                    $('#' + id + '-' + area + '-c-t').removeClass('text-danger');
                }, 500);
            }


        }

    </script>
    <script>
        jQuery(document).ready(function ($) {
            $('*[data-href]').on('click', function () {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection
