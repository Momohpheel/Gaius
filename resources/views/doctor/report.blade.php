@extends('layout.docapp')
@section('head')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('content')
<div class="uk-container" style="padding: 10px">
    <h2 style="font-weight: bold">Report</h2>
    <div class="uk-card uk-card-default uk-card-body">
        <div>
            <form class="uk-grid-small" method="get" action="" uk-grid>
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="form-stacked-select">From Date</label>
                    <div class="uk-form-controls">
                        <input class="uk-input datepicker" type="text" name="from_date" value="" autocomplete="off">
                    </div>
                </div>
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="form-stacked-select">To Date</label>
                    <div class="uk-form-controls">
                        <input class="uk-input datepicker2" type="text" name="to_date" value="" autocomplete="off">
                    </div>
                </div>
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="form-stacked-select">&nbsp;</label>
                    <div class="uk-form-controls">
                        <button class="uk-button uk-button-primary" type="submit">Filter</button> &nbsp;
                    </div>
                </div>
            </form>
        </div>
        <div uk-grid>
            <div class="uk-width-expand@m">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="uk-width-1-3@m">
                <div>
                    <canvas id="myChart2"  width="400" height="400" ></canvas>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <div>
       <div class="uk-child-width-1-3@m uk-child-width-1-2 uk-grid-small uk-grid-match" uk-grid>
            {{--  <div>
                <a href="{{url('/products')}}" style="text-decoration: none">
                    <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                        <div style="text-align: right">
                            <div style="padding: 20px 30px">
                                <div style="color: #7E7E7E; font-size: 12px;">TOTAL PRODUCTS</div>
                                <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500">{{$total_products}}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
           
            {{-- <div>
                <a href="{{url('/order_report?from='.$from_date.'&to='.$to_date)}}" style="text-decoration: none">
                    <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                        <div style="text-align: right">
                            <div style="padding: 20px 30px">
                                <div style="color: #7E7E7E; font-size: 12px;">TOTAL ORDERS</div>
                                <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500">{{$total_orders}}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
            {{-- <div>
                <a href="{{url('/customers')}}" style="text-decoration: none">
                    <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                        <div style="text-align: right">
                            <div style="padding: 20px 30px">
                                <div style="color: #7E7E7E; font-size: 12px;">NEW CUSTOMERS</div>
                                <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500">{{$total_customers}}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
          
            {{-- <div>
                <a href="{{url('/reconciliation/passtobill?sort=passtobill')}}" style="text-decoration: none">
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">PASS-TO-BILL PRODUCTS (RECONCILIATION)</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500"> {{ $passBill }}</div>
                        </div>
                    </div>
                </div>
                </a>
            </div> --}}


            {{-- <div>
                <a href="{{url('/reconciliation/expired?sort=expired')}}" style="text-decoration: none">
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">EXPIRED PRODUCTS (RECONCILIATION)</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500"> {{ $expired }}</div>
                        </div>
                    </div>
                </div>
                </a>
            </div> --}}

            {{-- <div>
                <a href="{{url('/reconciliation/complete')}}" style="text-decoration: none">
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">COMPLETE PRODUCTS (RECONCILIATION)</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500"> {{ $expired }}</div>
                        </div>
                    </div>
                </div>
                </a>
            </div> --}}
        </div>


    </div>
</div>
@endsection
@section('foot')
    <script>
        const labels = [
          
              'Jan', 
               'Feb', 
               'Mar', 
                'Apr', 
               'May', 
                 'Jun', 
                 'Jul', 
                'Aug', 
                'Sep', 
                'Oct', 
                 'Nov', 
                 'Dec', 
           
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Student Report',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    
                ],
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

    </script>

    <script>
        const labels2 = [
           
        ];
        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'Sales Report',
                backgroundColor: [
                    '#1ABC9C',
                    '#F1C40F',
                    '#e45d56'
                ],
                borderColor: [
                    '#1ABC9C',
                    '#F1C40F',
                    '#e45d56'
                ],
                borderWidth: 1,
                data: [
                    
                ],
            }]
        };

        const config2 = {
            type: 'doughnut',
            data: data2,
            options: { responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ''
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }}
        };

        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );

    </script>

    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "c-99:c+00",
                dateFormat: "yy-mm-dd"
            });
            $( ".datepicker2" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "c-99:c+00",
                dateFormat: "yy-mm-dd"
            });
        } );
    </script>
@endsection
