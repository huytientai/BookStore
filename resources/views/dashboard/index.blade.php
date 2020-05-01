@extends('layouts.admin')

@section('title','DashBoard')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Used Space</p>
                            <h3 class="card-title">49/50
                                <small>GB</small>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">warning</i>
                                <a href="#pablo">Get More Space...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Revenue</p>
                            <h3 class="card-title">${{ $info['revenue'] ?? 0 }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Last 24 Hours
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <span class="material-icons" style="width: 56px;height: 56px;font-size: 36px;text-align: center;line-height: 56px">how_to_reg</span>
                            </div>
                            <p class="card-category">Register</p>
                            <h3 class="card-title">+{{ $info['register'] ?? 0 }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Last 30 days
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">info_outline</i>
                            </div>
                            <p class="card-category">Fixed Issues</p>
                            <h3 class="card-title">75</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">local_offer</i> Tracked from Github
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div class="">{!! $dailyChart->container() !!}</div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Daily Sales</h4>
                            <p class="card-category">
                                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated 4 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            {{--<div class="ct-chart" id="websiteViewsChart"></div> --}}
                            <div>{!! $monthlyChart->container() !!}</div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Monthly Sales</h4>
                            <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> campaign sent 2 days ago
                            </div>
                        </div>
                    </div>
                </div>
                {{--                <div class="col-md-4">--}}
                {{--                    <div class="card card-chart">--}}
                {{--                        <div class="card-header card-header-danger">--}}
                {{--                            <div class="ct-chart" id="completedTasksChart"></div>--}}
                {{--                        </div>--}}
                {{--                        <div class="card-body">--}}
                {{--                            <h4 class="card-title">Completed Tasks</h4>--}}
                {{--                            <p class="card-category">Last Campaign Performance</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="card-footer">--}}
                {{--                            <div class="stats">--}}
                {{--                                <i class="material-icons">access_time</i> campaign sent 2 days ago--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">New Employees</h4>
                            <p class="card-category">New employees work under a year</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Date</th>
                                </thead>
                                <tbody>
                                @foreach($employees as $key => $employee)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ \App\Models\User::$roles[$employee->role] }}</td>
                                        <td>{{ date_format($employee->created_at,'Y-d-m') }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {!! $dailyChart->script() !!}
    {!! $monthlyChart->script() !!}

    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(0).classList.add('active');
    </script>
@endsection
