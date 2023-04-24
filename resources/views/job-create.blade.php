@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div style="min-height: 1345.31px;">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!-- <h1>Item</h1> -->
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Job</li>
                                <li class="breadcrumb-item active">Create Job</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">


                <!-- general form elements disabled -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Job Order</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif


                        {{-- <form id="job_ticket_creation_form" method="POST" enctype="multipart/form-data"> --}}
                        @csrf
                        <div class="card">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Job Order No: </label>
                                            <input class="form-control" name="job_no" id="job_no"
                                                placeholder="Enter job number ..." />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Client:</label>
                                            <select class="form-control" name="job_client" id="job_client">
                                                <option value="" disabled selected hidden>Select client ...
                                                </option>

                                                {{-- Temporary client options --}}
                                                <option value="1">Danny Gonzales</option>
                                                <option value="2">Drew Gooden</option>
                                                <option value="3">Kurtis Conner</option>

                                                @foreach ($clients as $client)
                                                    <option value="{{ $client['client_id'] }}">
                                                        {{ $client['firstName'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Job Date: </label>
                                            <input type="date" class="form-control" name="job_order_date"
                                                id="job_order_date" placeholder="date" />
                                        </div>
                                    </div>

                                    {{-- Testing error handling --}}
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Client Ref. No: </label>
                                            <input class="form-control @error('job_client_ref') is-invalid @enderror"
                                                name="job_client_ref" id="job_client_ref"
                                                placeholder="Enter client job reference number ..." />
                                            @error('job_client_ref')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Deliver Date: </label>
                                                <input type="date" class="form-control" name="job_deliver_date"
                                                    id="job_deliver_date" placeholder="Deliver Date" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><u>Job Title </u></label>
                                                <input class="form-control" name="job_title" id="job_title"
                                                    placeholder="Enter job title ..." />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Style Details</h3>
                                    </div>

                                    {{-- multiple style insert --}}

                                    <div class="card-body">
                                        {{-- style adder --}}
                                        <table class="table table-striped table-bordered">

                                            <head>
                                                <tr class="table-primary">
                                                    <th width="25%">Design</th>
                                                    <th width="25%">Type</th>
                                                    <th width="25%">Size</th>
                                                    <th width="25%">Qty</th>
                                                </tr>
                                            </head>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select id="style_design" class="form-control" name="style_design">
                                                            <option value="" disabled selected hidden>
                                                                Select a design
                                                            </option>

                                                            {{-- Design options here : --}}
                                                            <option value="1">Mens</option>
                                                            <option value="2">Ladies</option>
                                                            <option value="3">Kids</option>

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="style_type" class="form-control" name="style_type">
                                                            <option value="" disabled selected hidden>
                                                                Select a type
                                                            </option>

                                                            {{-- Type options here : --}}
                                                            <option value="1">Short sleeves</option>
                                                            <option value="2">Long sleeves</option>

                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select id="style_size" class="form-control" name="style_size">
                                                            <option value="" disabled selected hidden>
                                                                Select a size
                                                            </option>

                                                            {{-- Size options here : --}}
                                                            <option value="1">S</option>
                                                            <option value="2">M</option>
                                                            <option value="3">L</option>
                                                            <option value="4">XL</option>
                                                            <option value="5">XXL</option>

                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input type="number" value="0" class="form-control"
                                                            id="style_qty" min="0"
                                                            oninput="this.value = Math.abs(this.value)" />
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4" style="text-align:right"><button type="button"
                                                            class="btn btn-primary btn-sm text-bold"
                                                            onclick="append_tr()"><span
                                                                class="fas fa-plus mr-2"></span>ADD</button></td>
                                                </tr>

                                            </tbody>


                                        </table>

                                        {{-- style display --}}
                                        <table id="styles_table" class="table table-striped table-bordered">

                                            <head>
                                                <tr class="table-primary">
                                                    <th>Design</th>
                                                    <th>Type</th>
                                                    <th>Size</th>
                                                    <th>Qty</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </head>
                                            <tbody id="styles_table_body">
                                            </tbody>
                                            <input type="hidden" name="style_row_count" id="style_row_count"
                                                value="0">
                                        </table>
                                    </div>

                                </div>
                                <br>
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><u>Other Comments </u></label>
                                            <input class="form-control" name="job_comments" id="job_comments"
                                                placeholder="Enter comments ..." />
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Packing </label>
                                                <input class="form-control" name="job_packing" id="job_packing"
                                                    placeholder="Enter packing details ..." />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Customer Document </label><br>
                                                <input class="form-control" type="file" id="job_customer_doc_input"
                                                    name="job_customer_doc_input">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <section class="content">
                                <!-- general form elements disabled -->
                                <div class="card card-primary">
                                    <!-- /.card-header -->
                                    <div class="card-body">


                                        <div class="row">
                                            <label>Design Department &ensp; &ensp;</label>
                                            <input id="check_design" class="form-check-input" type="checkbox"
                                                onchange="markDepartment('check_design' , 'design_start_date', 'design_end_date')"
                                                value="1">
                                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;

                                            <div class="col-sm-3">

                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="design_start_date"
                                                        name="design_start_date">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" class="form-control" id="design_end_date"
                                                        name="design_end_date">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <label>Printing Department &ensp;</label>
                                            <input id="check_printing" class="form-check-input" type="checkbox"
                                                onchange="markDepartment('check_printing' , 'printing_start_date', 'printing_end_date')"
                                                value="2">
                                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;

                                            <div class="col-sm-3">

                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="printing_start_date"
                                                        name="printing_start_date">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" class="form-control" id="printing_end_date"
                                                        name="printing_end_date">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <label>Pressing Department &ensp; </label>
                                            <input id="check_pressing" class="form-check-input" type="checkbox"
                                                onchange="markDepartment('check_pressing' , 'pressing_start_date', 'pressing_end_date')"
                                                value="3">
                                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;

                                            <div class="col-sm-3">

                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="pressing_start_date"
                                                        name="pressing_start_date">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" class="form-control" id="pressing_end_date"
                                                        name="pressing_end_date">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <label>Cutting Department &ensp; </label>
                                            <input id="check_cutting" class="form-check-input" type="checkbox"
                                                onchange="markDepartment('check_cutting', 'cutting_start_date', 'cutting_end_date')"
                                                value="4">
                                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;

                                            <div class="col-sm-3">

                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="cutting_start_date"
                                                        name="cutting_start_date">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" class="form-control" id="cutting_end_date"
                                                        name="cutting_end_date">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <label>Sewing Department </label>
                                            <input id="check_sewing" class="form-check-input" type="checkbox"
                                                onchange="markDepartment('check_sewing', 'sewing_start_date', 'sewing_end_date')"
                                                value="5">
                                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;

                                            <div class="col-sm-3">

                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="sewing_start_date"
                                                        name="sewing_start_date">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" class="form-control" id="sewing_end_date"
                                                        name="sewing_end_date">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </section>

                            <div class="d-flex flex-row-reverse mt-1 mb-2 me-2">
                                <button type="submit" class="btn btn btn-success m-1" onclick="submitJobTicket()">Submit
                                    job ticket</button>
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
                <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <br>
    </div>
    </section>
    </div>
    </div>
    {{-- re importing jQuery because it won't load for some reason  --}}
    <script src="plugins/jquery/jquery.min.js"></script>

    {{-- custom script --}}
    <script>
        // append tr : appends a table row to the styles table when the add button is clicked
        // ---------   ----------------------------------------------------------------------

        function append_tr() {

            let select_style_design = document.getElementById('style_design');
            let select_style_type = document.getElementById('style_type');
            let select_style_size = document.getElementById('style_size');

            let style_design = select_style_design.options[select_style_design.selectedIndex].text;
            let style_type = select_style_type.options[select_style_type.selectedIndex].text;
            let style_size = select_style_size.options[select_style_size.selectedIndex].text;

            let style_qty = $('#style_qty').val();

            // removed validations

            let style_row_count = $('#style_row_count').val();
            $('#style_row_count').val(parseInt(style_row_count) + 1);

            $('#styles_table_body').append('<tr id=tr_"' + style_row_count + '">' +
                '<td>' + style_design + '<input class="style_design" type="hidden" value="' + style_design +
                '" id="style_design_' +
                style_row_count +
                '" name="style_design_' + style_row_count + '" /></td>' +
                '<td>' + style_type + '<input class="style_type" type="hidden" value="' + style_type +
                '" id="style_type_' + style_row_count + '" name="style_type_' + style_row_count +
                '" /></td>' +
                '<td>' + style_size +
                '<input class="style_size" type="hidden" value="' +
                style_size + '" id="price_' + style_row_count + '" name="price_' + style_row_count + '" /></td>' +
                '<td>' + style_qty +
                '<input class="style_qty" type="hidden" value="' +
                style_qty + '" id="qty_' + style_row_count + '" name="qty_' + style_row_count + '" /></td>' +
                '<td style="text-align:center"><button type="button" class="btn btn-danger btn-sm" onclick="delete_row(this)"><span class="fas fa-eraser"></span></button></td>' +
                '</tr>');

        }


        // delete row : deletes a row from the styles table when the eraser button is clicked
        // ----------   ---------------------------------------------------------------------

        function delete_row(btn) {
            let row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);

            let style_row_count = $('#style_row_count').val();
            $('#style_row_count').val(parseInt(style_row_count) - 1);
        }


        // mark department : upon checking a department box, marks that department as checked
        // ---------------   ---------------------------------------------------------------

        function markDepartment(checkbox, startDatePicker, endDatePicker) {

            if (document.getElementById(checkbox).checked) {
                $("#" + checkbox).addClass("department-marked");
                $("#" + startDatePicker).addClass("start-date-marked");
                $("#" + endDatePicker).addClass("end-date-marked");
            } else {
                $("#" + checkbox).removeClass("department-marked");
                $("#" + startDatePicker).removeClass("start-date-marked");
                $("#" + endDatePicker).removeClass("end-date-marked");
            }

        }


        // submit job ticket : passes the entire page data to the job controller
        // -----------------   ------------------------------------------------

        function submitJobTicket() {

            // job core details :

            let job_no = $('#job_no').val();
            let job_client = $('#job_client').val();
            let job_client_ref = $('#job_client_ref').val();
            let job_order_date = $('#job_order_date').val();
            let job_deliver_date = $('#job_deliver_date').val();
            let job_title = $('#job_title').val();

            // job customer doc :

            let job_customer_doc_input = document.getElementById('job_customer_doc_input');
            let job_customer_doc = job_customer_doc_input.files[0];

            // job styles row count :

            let style_row_count = $('#style_row_count').val();

            // validations removed

            Swal.fire({
                icon: 'question',
                title: 'Confirm job ticket submission ?',
                showDenyButton: true,
                confirmButtonText: 'Submit',
                denyButtonText: `Cancel`,
            }).then((result) => {
                if (result.isConfirmed) {

                    // styles
                    let style_designs = [];
                    let style_types = [];
                    let style_sizes = [];
                    let style_qtys = [];

                    // departments
                    let marked_departments = [];
                    let marked_start_dates = [];
                    let marked_end_dates = [];

                    // pushing in elements
                    $('.style_design').each(function() {
                        style_designs.push($(this).val());
                    })

                    $('.style_type').each(function() {
                        style_types.push($(this).val());
                    })

                    $('.style_size').each(function() {
                        style_sizes.push($(this).val());
                    })

                    $('.style_qty').each(function() {
                        style_qtys.push($(this).val());
                    })

                    $('.department-marked').each(function() {
                        marked_departments.push($(this).val());
                    })

                    $('.start-date-marked').each(function() {
                        marked_start_dates.push($(this).val());
                    })

                    $('.end-date-marked').each(function() {
                        marked_end_dates.push($(this).val());
                    })

                    // ajax setup
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // Form Data
                    // ---------

                    let form_data = new FormData();

                    form_data.append('job_no', job_no);
                    form_data.append('job_client', job_client);
                    form_data.append('job_client_ref', job_client_ref);
                    form_data.append('job_order_date', job_order_date);
                    form_data.append('job_deliver_date', job_deliver_date);
                    form_data.append('job_title', job_title);
                    form_data.append('job_customer_doc', job_customer_doc);
                    form_data.append('style_designs', style_designs);
                    form_data.append('style_types', style_types);
                    form_data.append('style_sizes', style_sizes);
                    form_data.append('style_qtys', style_qtys);
                    form_data.append('marked_departments', marked_departments);
                    form_data.append('marked_start_dates', marked_start_dates);
                    form_data.append('marked_end_dates', marked_end_dates);

                    $.ajax({
                        url: "{{ url('store_job') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: form_data,
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: 1
                                }).then(function() {
                                    location.reload();
                                });
                            } else if (response.status == 500) {
                                Swal.fire({
                                    icon: 'error',
                                    title: response.message,
                                    footer: response.error,
                                    showConfirmButton: 1
                                });
                            }
                        },
                        // server side validation errors response
                        error: function(err) {
                            if (err.status == 422) {

                                // error object
                                console.log(err.responseJSON.errors);

                                // alert
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Invalid inputs',
                                    text: 'Please id the validity of the data you entered and try again',
                                    footer: response.error,
                                    showConfirmButton: 1
                                });
                            }
                        },
                    });

                }
            });



        }

        // Without FormData : Files just won't pass this way
        // ----------------   -----------------------------
        // url: "{{ url('store_job') }}",
        //     method: "POST",
        //     enctype: 'multipart/form-data',
        //     data: {
        //         'job_no': job_no,
        //         'job_client': job_client,
        //         'job_client_ref': job_client_ref,
        //         'job_order_date': job_order_date,
        //         'job_deliver_date': job_deliver_date,
        //         'job_title': job_title,
        //         'job_customer_doc': job_customer_doc,
        //         'style_designs': style_designs,
        //         'style_sizes': style_sizes,
        //         'style_types': style_types,
        //         'style_qtys': style_qtys,
        //         'marked_departments': marked_departments,
        //         'marked_start_dates': marked_start_dates,
        //         'marked_end_dates': marked_end_dates
        //     },
    </script>


@endsection
