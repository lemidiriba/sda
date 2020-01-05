@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-lg-6">
        <div class="card pb-4 pt-1">
            <div class="card-body card-print-height">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body card-print-height">
                <h4 class="h4 text-center">Total Status</h4>
                @if (count($calculateditems) == 0)
                <div class="alert alert-info text-center" role="alert">
                    <h4 class="alert-heading">No Data Found!</h4>

                </div>
                @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Message Type</th>
                                <th scope="col">Participant</th>
                                <th scope="col">Collected Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($calculateditems['allcollected'] as $item)

                            <tr>
                                <td>{{ $item['messagetype'] }}</td>
                                <td id="{{ $item['messagetype'] }}">{{ $item['totalcount'] }}</td>
                                <td>{{ $item['totalraised'] }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total Participant</th>
                                <th>{{ $calculateditems['totalparticipant'] }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Total Raised</th>
                                <th>{{ $calculateditems['totalprice'] }}</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>

                @endif

            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-12 col-sm-12 col-md-6mb-3">
        <div class="card">
            <div class="card-body card-print-height">
                <h4 class="h4 text-center">Message Pricing Status</h4>
                @if (count($priceitems) == 0)
                <div class="alert alert-info text-center" role="alert">
                    <h4 class="alert-heading">No Data Found!</h4>

                </div>
                @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Message Type</th>
                                <th scope="col">Price (Birr)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($priceitems as $item)
                            <tr>
                                <td>{{ $item->message_type_name }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>

                @endif
            </div>
        </div>
    </div>


</div>
<!--row-->
<script>
    window.onload = function () {
        console.log( $('#A').html());

        var ctxP = document.getElementById("pieChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                labels: ["Message A", "Message B", "Message C", "Message D", "Message Unknown"],
                datasets: [{
                    data: [
                        $('#A').html(),
                        $('#B').html(),
                        $('#C').html(),
                        $('#D').html(),
                        $('#unknown').html()
                    ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                }]
            },
            options: {

                responsive: true,
                title: {
                    display: true,
                    text: 'All Message'
                },
                legend: {
                    position: 'left',
                }


            }
        });

    }
</script>

<style>
    .table th,
    .table td {
        padding: 0.2rem;
    }
</style>

@endsection