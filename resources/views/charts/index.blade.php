@extends('layouts.admin')

@section('title', 'Chart')

@section('content')
    <div style="padding-left: 15px;padding-right: 15px;height: 500px">
        <h3 style="color:dodgerblue">Month</h3>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="background: #3d3939;">
            <li class="nav-item">
                <a class="nav-link active" id="line-tab" data-toggle="tab" href="#line" role="tab" aria-controls="line" aria-selected="true">Day</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="bar-tab" data-toggle="tab" href="#bar" role="tab" aria-controls="bar" aria-selected="false">Sum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
            </li>
        </ul>
        <br>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="line" role="tabpanel" aria-labelledby="line-tab">
                {!! $lineChart->container() !!}
                {!! $lineChart->script() !!}
            </div>
            <div class="tab-pane" id="bar" role="tabpanel" aria-labelledby="bar-tab">
                <canvas style="height: 0px"></canvas>
                {!! $barChart->container() !!}
                {!! $barChart->script() !!}
            </div>
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">mess</div>
            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">setting</div>
        </div>

    </div>

    <br><br>
    <p id="tt">Click this paragraph.</p>


    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(0).classList.add('active');

        $(document).ready(function(){
            $("#tt").on("click", function(){
                alert("The paragraph was clicked.");
            });
        });
    </script>
@endsection
