@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="bg-white p-2">
    <h2 class="h2" id="title" data-title-value="{{ $title }}"> @lang('strings.backend.message.title.type_'.$title) </h2>
    <table id="table" class="table font-weight-normal pb-0 fade-in" style="width:100%">
        <thead>
            <tr>

                <th>Phone Number</th>
                <th>Total Count</th>
                <th>Collected Birr(ETB)</th>
                <th>Recent Date</th>
            </tr>
        </thead>

        </tbody>

    </table>

</div>


<script>
    window.onload = function () {
        let x = document.getElementById('title');

        switch (x.getAttribute('data-title-value')) {
            case 'all':
                $('#table').DataTable({
                    serverSide: true,
                    ordering: true,
                    processing: true,
                   "lengthMenu": [10, 20, 50, 100, 200, 5000,1000000],
                    ajax: '{{ route("admin.message.allmessage") }}',
                    columns: [{
                            data: 'phone_no',
                            name: 'phone_no',
                            "render": function (data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<a href="{{ route("admin.profile.table1") }}/' +
                                        row.phone_no + '">' + data + '</a>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'count',
                            name: 'count'
                        },
                        {
                            data: 'calculated',
                            name: 'calculated'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                    ]

                });
                break;
            case 'a':
                $('#table').DataTable({
                    serverSide: true,
                    ordering: true,
                    processing: true,
                   "lengthMenu": [10, 20, 50, 100, 200, 5000,1000000],
                    ajax: '{{ route("admin.message.getmessage", "A") }}',
                    columns: [{
                            data: 'phone_no',
                            name: 'phone_no',
                            "render": function (data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<a href="{{ route("admin.profile.table1") }}/' +
                                        row.phone_no + '">' + data + '</a>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'count',
                            name: 'count'
                        },
                        {
                            data: 'calculated',
                            name: 'calculated'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                    ]

                });
                break;
            case 'b':
                $('#table').DataTable({
                    serverSide: true,
                    ordering: true,
                    processing: true,
                  "lengthMenu": [10, 20, 50, 100, 200, 5000,1000000],
                    ajax: '{{ route("admin.message.getmessage", "B") }}',
                    columns: [{
                            data: 'phone_no',
                            name: 'phone_no',
                            "render": function (data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<a href="{{ route("admin.profile.table1") }}/' +
                                        row.phone_no + '">' + data + '</a>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'count',
                            name: 'count'
                        },
                        {
                            data: 'calculated',
                            name: 'calculated'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                    ]

                });
                break;
            case 'c':
                $('#table').DataTable({
                    serverSide: true,
                    ordering: true,
                    processing: true,
                   "lengthMenu": [10, 20, 50, 100, 200, 5000,1000000],
                    ajax: '{{ route("admin.message.getmessage", "C") }}',
                    columns: [{
                            data: 'phone_no',
                            name: 'phone_no',
                            "render": function (data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<a href="{{ route("admin.profile.table1") }}/' + row.phone_no + '">' + data + '</a>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'count',
                            name: 'count'
                        },
                        {
                            data: 'calculated',
                            name: 'calculated'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                    ]

                });
                break;
            case 'd':
                $('#table').DataTable({
                    serverSide: true,
                    ordering: true,
                    processing: true,
                  "lengthMenu": [10, 20, 50, 100, 200, 5000,1000000],
                    ajax: '{{ route("admin.message.getmessage", "D") }}',
                    columns: [{
                            data: 'phone_no',
                            name: 'phone_no',
                            "render": function (data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<a href="{{ route("admin.profile.table1") }}/' +
                                        row.phone_no + '">' + data + '</a>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'count',
                            name: 'count'
                        },
                        {
                            data: 'calculated',
                            name: 'calculated'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                    ]

                });
                break;
            case 'e':
                $('#table').DataTable({
                    serverSide: true,
                    ordering: true,
                    processing: true,
                   "lengthMenu": [10, 20, 50, 100, 200, 5000,1000000],
                    ajax: '{{ route("admin.message.getmessage", "E") }}',
                    columns: [{
                            data: 'phone_no',
                            name: 'phone_no',
                            "render": function (data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<a href="{{ route("admin.profile.table1") }}/' +
                                        row.phone_no + '">' + data + '</a>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'count',
                            name: 'count'
                        },
                        {
                            data: 'calculated',
                            name: 'calculated'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                    ]

                });
                break;
            case 'unknown':
                $('#table').DataTable({
                    serverSide: true,
                    ordering: true,
                    processing: true,
                    "lengthMenu": [10, 20, 50, 100, 200, 5000,1000000],
                    ajax: '{{ route("admin.message.getmessage", "unknown") }}',
                    columns: [{
                            data: 'phone_no',
                            name: 'phone_no',
                            "render": function (data, type, row, meta) {
                                if (type === 'display') {
                                    data = '<a href="{{ route("admin.profile.table1") }}/' +
                                        row.phone_no + '">' + data + '</a>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'count',
                            name: 'count'
                        },
                        {
                            data: 'calculated',
                            name: 'calculated'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                    ]

                });
                break;
            default:
                break;
        }

    }






</script>

<style>
    #table_length {
        float: left;
    }

    #table_length>label {
        display: inline-flex;
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