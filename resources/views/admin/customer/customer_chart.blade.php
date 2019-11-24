<?php

   $current_month = Date('M');
   $last_month = Date('M',strtotime("-1 month"));
   $before_last_month = Date('M',strtotime("-2 month"));


$dataPoints = array(
    array("y" => $last_month_customers, "label" => $last_month),
    array("y" => $current_month_customers, "label" => $current_month),
    array("y" => $before_last_month_customers, "label" => $before_last_month),

);

?>
@extends('layouts.backend._master')
@section('content')

    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Report of Customers"
                },
                axisY: {
                    title: "Number of Customers"
                },
                data: [{
                    type: "line",
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
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->


    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection