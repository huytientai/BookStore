@extends('layouts.admin')

@section('title', 'Chart')

@section('content')
    <div style="padding-left: 15px;padding-right: 15px;height: 500px">
        <h3 style="color:dodgerblue">Current Month</h3>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="background: #3d3939;">
            <li class="nav-item">
                <a class="nav-link active" id="line-current-month-tab" data-toggle="tab" href="#line-current-month" role="tab" aria-controls="lineCurrentMonth" aria-selected="true">Day</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="doughnut-current-month-tab" data-toggle="tab" href="#doughnut-current-month" role="tab" aria-controls="doughnutCurrentMonth" aria-selected="false">Circle</a>
            </li>
        </ul>
        <br>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="line-current-month" role="tabpanel" aria-labelledby="line-tab">
                {!! $lineCurrentMonthChart->container() !!}
                {!! $lineCurrentMonthChart->script() !!}
            </div>
            <div class="tab-pane" id="doughnut-current-month" role="tabpanel" aria-labelledby="bar-tab">
                <canvas style="height: 0px;display: block"></canvas>
                <div style="height: 400px;">
                    {!! $doughnutCurrentMonthChart->container() !!}
                    {!! $doughnutCurrentMonthChart->script() !!}
                </div>
            </div>
        </div>
    </div>

    <br><br><hr><br><br>

    <div style="padding-left: 15px;padding-right: 15px;height: 500px">
        <h3 style="color:dodgerblue">Last Month</h3>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="background: #3d3939;">
            <li class="nav-item">
                <a class="nav-link active" id="line-last-month-tab" data-toggle="tab" href="#line-last-month" role="tab" aria-controls="line" aria-selected="true">Day</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="doughnut-last-month-tab" data-toggle="tab" href="#doughnut-last-month" role="tab" aria-controls="doughnut" aria-selected="false">Circle</a>
            </li>
        </ul>
        <br>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="line-last-month" role="tabpanel" aria-labelledby="line-tab">
                {!! $lineLastMonthChart->container() !!}
                {!! $lineLastMonthChart->script() !!}
            </div>
            <div class="tab-pane" id="doughnut-last-month" role="tabpanel" aria-labelledby="bar-tab">
                <canvas style="height: 0px;display: block"></canvas>
                <div style="height: 400px;">
                    {!! $doughnutLastMonthChart->container() !!}
                    {!! $doughnutLastMonthChart->script() !!}
                </div>
            </div>
        </div>
    </div>



    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(0).classList.add('active');
    </script>
@endsection
