@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')

<div class="row p-2">
    <div class="card col-12 p-2">
        <div class="col-sm-12 col-12 text-center p-2">
            <h2 id="a" class="h4"> Phone: {{ $phoneno }} </h2>
        </div>
    </div>


    @foreach ($calculatedprice['messagetype'] as $item)
    <div class="col-sm-6 col-lg-3">
        <div class="card rounded">
            <div class="card-body p-3 d-flex align-items-center" googl="true">
                <div class="bg-gradient-primary p-3 mr-2 mfe-3 messagetype text-white font-lg rounded">
                    {{ $item['messagetype'] }}
                </div>
                <div>
                    <div class="text-value text-primary price">{{ $item['totalraised'] }} ETB</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Coutn: {{ $item['totalcount'] }}</div>
                </div>
            </div>

        </div>
    </div>

    @endforeach

    <div class="card col-lg-12 pt-3 fade-in">
        <table id="table" class="table font-weight-normal pb-0" style="width:100%">

            <thead>
                <tr>

                    <th>Phone Number</th>
                    <th>Message Type</th>
                    <th>Value</th>
                    <th>Date</th>


                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
</div>



<script>
    //window.onload = filltable();



    window.onload = function () {
            //alert('lemi')
            $('#table').DataTable({
                    serverSide: true,
                    ordering: true,
                    processing: true,
                    "lengthMenu": [10, 20, 50, 100, 200, 5000,1000000],
                    ajax: '{{ route("admin.profile.table", $phoneno) }}',
                    columns: [{
                                    data: 'phone_no',
                                    name: 'phone_no'
                                },
                                {
                                    data: 'message_type',
                                    name: 'message_type'
                                },
                                {
                                    data: 'message_value',
                                    name: 'message_value'
                                },
                                {
                                    data: 'created_at',
                                    name: 'created_at'
                                },

                            ],
                    initComplete: function () {
                        this.api().columns(1).every(function () {
                                    var column = this;
                                    var select = $('#table_length').after('<select id="message_type"><option value=""> All</option></select>');

                                        $('#message_type').on('change', function () {
                                            var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                            );

                                            column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                        });

                                        column.data().unique().sort().each(function (d, j) {
                                            $('#message_type').append('<option value="' + d + '">' + d +
                                                '</option>')
                                        });
                                    });
                            },


                    });

            }
</script>

<style>
    .messagetype {
        background: linear-gradient(45deg, #39f 0%, #2982cc 100%);
    }

    .price {
        color: #2982cc 100%
    }


    #table_length {
        float: left;

    }

    #table_length>label {
        display: inline-flex;
        margin-right: 5px;
    }

    #table_filter {
        float: right;
    }

    #table_filter>label {
        display: inline-flex;
    }

    #table_paginate {
        float: right;
    }

    .table th,
    .table td {
        padding: 0.2rem;
    }
</style>
@endsection