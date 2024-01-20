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
                            <h3>15<sup style="font-size: 20px"> xe</sup></h3>
                            <p>Đến hạn thay nhớt</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-oil-can"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>  
                
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>15<sup style="font-size: 20px"> xe</sup></h3>
                            <p>Đến hạn đăng kiểm</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>15<sup style="font-size: 20px"> xe</sup></h3>
                            <p>Đến hạn bảo hiểm</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>15<sup style="font-size: 20px"> xe</sup></h3>
                            <p>Đến hạn ngân hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Chi tiết <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Chi phí
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div><!-- /.card-header -->
    
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div id="curve_chart" style="position: relative; width: 900px; height: 500px; margin: auto;"></div>
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
        var data = google.visualization.arrayToDataTable([
            ['Tháng', 'Chi phí'],
            ['1',  1000],
            ['2',  1170],
            ['3',  660],
            ['4',  1023000000],
            ['5',  1030],
            ['6',  1030],
            ['7',  1030],
            ['8',  1030],
            ['9',  1030],
            ['10',  1030],
            ['11',  1030],
            ['12',  1030]
        ]);

        var options = {
            title: 'Chi phí sửa chửa xe',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>
@endsection