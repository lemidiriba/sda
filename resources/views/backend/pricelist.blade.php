@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="row bg-white p-2">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="float-right bg-success d-inline-flex rounded p-2" data-toggle="modal" data-target="#addprice"><i
                class="fas fa-plus-square "></i></div>

        <h2 class="card-title text-center">Message Pricing State</h2>

        <div class="list-group">

            <table id="pricetable" class="table font-weight-normal pb-0 fade-in" width="100%">
                <thead>
                    <tr>

                        <th>Message Type</th>
                        <th>Value (ETB)</th>
                        <th>Last Chang</th>
                        <th>Action</th>



                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>

            <!-- Modal Add-->
            <div class="modal fade" id="addprice" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">

                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center">Add Price</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="addpriceform" action="" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">

                                        <input type="text" class="form-control" name="mesagetype" id="mestype"
                                            placeholder="Message Type" onkeypress="return validateKeyStrokes(event)">

                                    </div>
                                    <div class="form-group">

                                        <input type="text" class="form-control" name="messageprice" id="mesprice"
                                            onkeypress="return isNumberKey(event);" placeholder="Message Price">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button id="addpricesetting" type="submit" class="btn btn-primary">Save</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Modal Add-->
            <div class="modal fade" id="updatepricemodel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">

                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Price</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="updatepriceform" action="" method="POST">
                            @csrf

                            <div class="modal-body">
                                <div class="container-fluid">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="messagepriceupdate"
                                            id="mespriceupdate" onkeypress="return isNumberKey(event);"
                                            placeholder="Message Price">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button id="updateprice" type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>




        </div>
    </div>

</div>



<script>

</script>

<style>
    #pricetable_length {
        float: left;

    }

    #pricetable_length>label {
        display: inline-flex;
        margin-right: 5px;
    }

    #pricetable_filter {
        float: right;
    }

    #pricetable_filter>label {
        display: inline-flex;
    }

    #pricetable_paginate {
        float: right;
    }

    .table th,
    .table td {
        padding: 0.2rem !important;
    }
</style>
@endsection
@push('after-scripts')
<script>
    $('#pricetable').DataTable({
        serverSide: true,
        ordering: true,
        processing: true,
        "lengthMenu": [10, 20, 50, 100, 200],
        "ajax": '{{ route("admin.pricelist.pricedata") }}',
        columns: [{
                data: 'message_type_name',
                name: 'message_type_name'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },
            {
                data: 'id',
                name: 'id',
                "render": function (data, type, row, meta) {
                    if (type === 'display') {
                        data =
                            '<button class="btn btn-success p-2 rounded d-inline-flex mr-2 edit" value="' +
                            row.id + '"' +
                            ' data-toggle="modal" data-target="#updatepricemodel"><i class="fas fa-edit"></i>' +
                            '</button><button class="btn btn-danger p-2 rounded d-inline-flex remove" value="' +
                            row.id + '">' +
                            '<i class="fas fa-trash"></i></div>';

                    }
                    return data;
                }
            },

        ]

    });





    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '.remove', function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{{ route("admin.pricelist.delete")."/delete/" }}' + $(this).val(),
                    type: 'get',
                    data: {
                        "id": $(this).val(),
                    },

                }).done(function (e) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $('#pricetable').DataTable().ajax.reload();

                    console.log(e);
                }).fail(function (e) {
                    console.log(e);
                })
            }
        })

    });


    $(document).on('click', '.edit', function (e) {
        $('#updateprice').attr('value', $(this).val());
    })



    $(document).on('click', '#updateprice', function (e) {
        e.preventDefault();
        let updateformdata = $('#updatepriceform')[0];
        let formdatatwo = new FormData(updateformdata);

        //console.log(formdatatwo);    // console.log(updateformdata);

        $.ajax({
            url: '{{ route("admin.pricelist.delete")."/update/" }}' + $(this).val(),
            type: 'POST',
            data: formdatatwo,
            cache: false,
            contentType: false,
            processData: false,
        }).done(function (e) {
            $('#updatepricemodel').modal('hide');
            Swal.fire(
                'success!',
                'Price Updated.',
                'success',
                'showConfirmButton:false',

            )
            $('#pricetable').DataTable().ajax.reload();
            console.log(e);
        }).fail(function (e) {
            Swal.fire({
                icon: 'error',
                'title': 'Opps....',
                text: e.responseJSON.message,
            })
            console.log(e);
        })


    });

    $(document).on('click', '#addpricesetting', function (e) {
        e.preventDefault();

        let priceform = $('#addpriceform')[0];
        let formdata = new FormData(priceform);
        $.ajax({
            url: '{{ route("admin.pricelist.addprice") }}',
            method: "post",
            data: formdata,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (e) {
            $('#addprice').modal('hide');
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Message Type saved',
                showConfirmButton: false,
                timer: 2000
            })
            $('#pricetable').DataTable().ajax.reload();

            console.log(e);
        }).fail(function (e) {
            Swal.fire({
                icon: 'error',
                'title': 'Opps....',
                text: e.responseJSON.message,
            })
            console.log(e);
        });
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function validateKeyStrokes(event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return true;
        }
        return false;
    }
</script>
@endpush