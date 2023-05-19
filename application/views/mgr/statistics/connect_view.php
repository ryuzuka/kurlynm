<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    /*날짜 선택*/
.months_header {
    position: relative;
    overflow: hidden;
    width: 100%;
    margin-top: 10px;
    text-align: center;
}
.months_header h2 { /*날짜text*/
    padding: 0 10px;
    font-family:'Muli', sans-serif;
    font-weight: bold;
    font-size: 18px;
    color: #428bca;
    float:left;
    width:70%;
    margin: 0 0 10px;
}
a.change-month { /*월이동버튼*/
    background-color: transparent;
    padding: 0;
    outline: none;
    border: none;
    float: left;
    width:15%;
    transition: color .2s;
}
</style>

<section class="content">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <!--MONTH -->
                        <div class="months_header">
                            <a class="change-month arrow-left" href="<?=$_SERVER['PHP_SELF']?>?target_month=<?=$prev_month?>"> <i class="fa fa-arrow-left fa-lg"></i></a>
                            <h2><?=$target_month?></h2>
                            <a class="change-month arrow-right" href="<?=$_SERVER['PHP_SELF']?>?target_month=<?=$next_month?>"> <i class="fa fa-arrow-right fa-lg"></i></a>
                        </div>
                        <!--/MONTH -->
                    </div>
                </div>
            </div>
            
            
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">주요 접속통계</h3>
                </div>

                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <colgroup>
                            <col width="*">
                            <col width="30%">
                            <col width="30%">
                        </colgroup>
                        <thead>
                            <tr calss="text-center">
                                <th class="text-center bg-gray">구분</th>
                                <th class="text-center bg-gray">Page View</th>
                                <th class="text-center bg-gray">Unique Visitor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center">2019년 접속통계</th>
                                <td class="text-center"><?= number_format($yearStatistics->pv)?></td>
                                <td class="text-center"><?= number_format($yearStatistics->uv)?></td>
                            </tr>
                            <tr>
                                <th class="text-center">05월 접속통계</th>
                                <td class="text-center"><?= number_format($monthStatistics->pv)?></td>
                                <td class="text-center"><?= number_format($monthStatistics->uv)?></td>
                            </tr>
                            <tr>
                                <th class="text-center">오늘 접속통계</th>
                                <td class="text-center"><?= number_format($todayStatistics->pv)?></td>
                                <td class="text-center"><?= number_format($todayStatistics->uv)?></td>
                            </tr>
                            <tr>
                                <th class="text-center">어제 접속통계</th>
                                <td class="text-center"><?= number_format($yesterdayStatistics->pv)?></td>
                                <td class="text-center"><?= number_format($yesterdayStatistics->uv)?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">일별 접속통계</h3>
                </div>

                <div class="box-body">
                    <div class="chart">
                      <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
                
                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <colgroup>
                            <col width="*">
                            <col width="30%">
                            <col width="30%">
                        </colgroup>
                        <thead>
                            <tr calss="text-center">
                                <th class="text-center bg-gray">날짜</th>
                                <th class="text-center bg-gray">Page View</th>
                                <th class="text-center bg-gray">Unique Visitor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($statisticsList as $i => $list) {
                            ?>
                            <tr>
                                <th class="text-center"><?=$list->date?></th>
                                <td class="text-center"><?=number_format($list->pv)?></td>
                                <td class="text-center"><?=number_format($list->uv)?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    
</section>


<script type="text/javascript">
    var areaChartData = {
      labels  : [<?php
        foreach ($statisticsList as $i => $list) {
            if ($i > 0) {
                echo ', "'.date('j', strtotime($list->date)).'"';
            } else {
                echo '"'.date('j', strtotime($list->date)).'"';
            }
        }
        ?>],
      datasets: [
        {
          label               : 'Page View',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php
            foreach ($statisticsList as $i => $list) {
                if ($i > 0) {
                    echo ', '.$list->pv;
                } else {
                    echo $list->pv;
                }
            }
            ?>]
        },
        {
          label               : 'Unique Visitor',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php
            foreach ($statisticsList as $i => $list) {
                if ($i > 0) {
                    echo ', '.$list->uv;
                } else {
                    echo $list->uv;
                }
            }
            ?>]
        }
      ]
    }
    
    
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
</script>