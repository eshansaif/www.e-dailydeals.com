<?php

$dataPoints = array(
    array("label"=>$getOrderStatus[0]['order_status'], "y"=>$getOrderStatus[0]['count']),
    array("label"=>$getOrderStatus[1]['order_status'], "y"=>$getOrderStatus[1]['count']),
    array("label"=>$getOrderStatus[2]['order_status'], "y"=>$getOrderStatus[2]['count']),
    array("label"=>$getOrderStatus[3]['order_status'], "y"=>$getOrderStatus[3]['count']),
    array("label"=>$getOrderStatus[4]['order_status'] , "y"=>$getOrderStatus[4]['count']),
    array("label"=>$getOrderStatus[5]['order_status'] , "y"=>$getOrderStatus[5]['count']),
    array("label"=>$getOrderStatus[6]['order_status'] , "y"=>$getOrderStatus[6]['count']),

)

?>
@extends('layouts.backend._master')
@section('content')

    <script>
        window.onload = function() {


            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "The Pie Chart of of Order Status of Customer"
                },
                subtitles: [{
                    text: ""
                }],
                data: [{
                    type: "pie",
                    //yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <header class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{--<a class="btn btn-primary" href="{{ route('admin.create') }}">Add New <i class="fa fa-plus"></i></a>--}}
                        <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                     </span>
                    </header>


                    <div class="panel-body">
                        <div id="chartContainer" style="height: 370px; width: 50%;"></div>
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->


    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection