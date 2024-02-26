@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $thay_nhot_count }}<sup style="font-size: 20px"> xe</sup></h3>
                            <p>Đến hạn thay nhớt</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-oil-can"></i>
                        </div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#info-thay-nhot" type="submit" class="small-box-footer">
                            Chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>  

                @include('administrator.pages.dashboard.oil_change')
                
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $dang_kiem_count }}<sup style="font-size: 20px"> xe</sup></h3>
                            <p>Đến hạn đăng kiểm</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#info-dang-kiem" type="submit" class="small-box-footer">
                            Chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                @include('administrator.pages.dashboard.inspection')

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $bao_hiem_count }}<sup style="font-size: 20px"> xe</sup></h3>
                            <p>Đến hạn bảo hiểm</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#info-bao-hiem" type="submit" class="small-box-footer">
                            Chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                @include('administrator.pages.dashboard.insurance')

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $ngan_hang_count }}<sup style="font-size: 20px"> xe</sup></h3>
                            <p>Đến hạn ngân hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#info-ngan-hang" type="submit" class="small-box-footer">
                            Chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                @include('administrator.pages.dashboard.banking')
            </div>

            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Chi phí bảo dưỡng - sửa chữa
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div><!-- /.card-header -->
    
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="chart_div" style="position: relative; width: 100%; height: 500px;"></div>
                                {{-- <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                                </div> --}}
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
@endsection

@section('title')
    Dashboard
@endsection

@section('js-custom')
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(@json($result));

        var options = {
            title: '',
            hAxis: {title: '',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    $(document).ready(function(){
        $('.toast').toast('show');
    });
    
</script>
@endsection