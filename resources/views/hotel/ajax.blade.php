@extends('layout.conquer')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Ajax Example
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Ajax Example</a>
                </li>
                <li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" onclick="showInfo()">
                        <i class="icon-bulb"></i>
                    </a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height btn-primary"
                    data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                    <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div id="showinfo"></div>

        <a class="btn btn-warning" data-toggle="modal" href="#disclaimer">Disclaimer</a>
    </div>
@endsection

@section('javascript')
    <script>
        function showInfo() {
            $.ajax({
                type: 'POST',
                url: '{{ route('hotels.showInfo') }}',
                data: '_token=<?php echo csrf_token(); ?>',
                success: function(data) {
                    $('#showinfo').html(data.msg)
                }
            });
        }
    </script>
@endsection
