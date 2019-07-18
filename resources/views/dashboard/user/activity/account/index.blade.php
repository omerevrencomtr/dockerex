@extends('dashboard.layouts.app')
@section('title') Hesap Faliyetlerim @endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title ">Hesap Faliyetlerim</h4>
                        </div>
                        <div class="card-body">
                            <table id="activityAccountTable" width="100%"
                                   class="table table-hover table-striped table-bordered dt-responsive">

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .sorting_disabled {
            display: none !important;
        }


    </style>
@endsection
@section('script')


    <script>
        $('#activityAccountTable').DataTable({
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
                "url": "{{route('dashboard.user.activity.account.show')}}",
                "dataType": "json",
                "type": "POST",
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            },
            "columns": [
                {"data": "data"},
            ]
        });
        //document.querySelector('#activityAccountTable > thead').style.display = 'none';

    </script>

@endsection
