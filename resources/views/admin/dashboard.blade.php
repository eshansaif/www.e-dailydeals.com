
<?php

$current_month = Date('M');
$last_month = Date('M',strtotime("-1 month"));
$before_last_month = Date('M',strtotime("-2 month"));
$before_two_last_month = Date('M',strtotime("-3 month"));
$before_three_last_month = Date('M',strtotime("-4 month"));
$before_four_last_month = Date('M',strtotime("-5 month"));
$before_five_last_month = Date('M',strtotime("-6 month"));
$before_six_last_month = Date('M',strtotime("-7 month"));
$before_seven_last_month = Date('M',strtotime("-8 month"));
$before_eight_last_month = Date('M',strtotime("-9 month"));
$before_nine_last_month = Date('M',strtotime("-10 month"));
$before_ten_last_month = Date('M',strtotime("-11 month"));

$dataPoints = array(
    array("y" => $before_last_four_month_orders, "label" => $before_four_last_month ),
    array("y" => $before_last_three_month_orders, "label" => $before_three_last_month ),
    array("y" => $before_last_two_month_orders, "label" => $before_two_last_month ),
    array("y" => $before_last_month_orders, "label" => $before_last_month ),
    array("y" => $last_month_orders, "label" => $last_month ),
    array("y" => $current_month_orders, "label" => $current_month ),

    array("y" => $before_last_four_month_orders, "label" => $before_four_last_month ),
    array("y" => $before_last_five_month_orders, "label" => $before_five_last_month ),
    array("y" => $before_last_six_month_orders, "label" => $before_six_last_month ),
    array("y" => $before_last_seven_month_orders, "label" => $before_seven_last_month ),
    array("y" => $before_last_eight_month_orders, "label" => $before_eight_last_month ),
    array("y" => $before_last_nine_month_orders, "label" => $before_nine_last_month ),
    array("y" => $before_last_ten_month_orders, "label" => $before_ten_last_month ),

);

?>

@extends('layouts.backend._master')

@section('content')


    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title:{
                    text: "Report of Orders"
                },
                axisY: {
                    title: "Number of orders"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## orders",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>

    <div class="wrapper">
    <div class="row states-info">
        <div class="col-md-6">
            <div class="panel red-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="col-xs-8">
                            <span class="state-title"> <strong>Total Customer</strong> </span>
                            <h4><strong>{{ $total_customer }}</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel blue-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-tag"></i>
                        </div>
                        <div class="col-xs-8">
                            <span class="state-title">  <strong>Product ordered Today</strong>  </span>
                            <h4><strong>{{ $today_orders }}</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel green-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-gavel"></i>
                        </div>
                        <div class="col-xs-8">
                            <span class="state-title">  <strong>New Order</strong>  </span>
                            <h4><strong>{{ $new_orders }}</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel yellow-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <div class="col-xs-8">
                            <span class="state-title">  <strong>Craft Designers </strong> </span>
                            <h4><strong>{{ $total_craft_designer }}</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    Order Report Of 12 Months
                    <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                </header>
                <div class="panel-body">
                    <div id="visitors-chart">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </section>
        </div>



    </div>



</div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


@endsection
