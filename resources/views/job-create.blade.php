@extends('layouts.app')

@section('content')

    {{-- job create --}}

    {{-- header section --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-black-50">Create job</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
                        <li class="breadcrumb-item active">Create job</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    {{-- content section --}}
    <section class="content">

        <div class="content-fluid">

            {{-- card  --}}
            <div class="card shadow-lg mb-3" style=" border-radius: 25px;">

                {{-- card header --}}
                <div class="card-header m-3 mb-0" style="background-color: transparent;">
                    <h5>Job ticket</h5>
                </div>
                {{-- / card header --}}

                {{-- card body --}}
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


                    <div class="col-sm-12">

                        {{-- input row 1 --}}
                        <div class="row mb-2">

                            {{-- job title --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('job_title') is-invalid @enderror"
                                        id="job_title" name="job_title" value="{{ old('job_title') }}"
                                        placeholder="Enter job title">
                                    <label for="job_title" style="font-weight: bold">Job title</label>
                                    @error('job_title')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- job no --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control @error('job_no') is-invalid @enderror"
                                        id="job_no" name="job_no" value="{{ old('job_no') }}"
                                        placeholder="Enter job number" min="0"
                                        oninput="this.value = Math.abs(this.value)">
                                    <label for="job_no" style="font-weight: bold">Job No:</label>
                                    @error('job_no')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- input row 2 --}}
                        <div class="row mb-2">

                            {{-- job client --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <select
                                        class="form-select form-select-transparent @error('job_client') is-invalid @enderror"
                                        style="appearance:none;" name="job_client" id="job_client">
                                        <option value="" disabled selected hidden>Select your client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}"
                                                {{ old('job_client') == $client->id ? 'selected' : '' }}>
                                                {{ $client->first_name }} {{ $client->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="job_client">Client</label>
                                    @error('job_client')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            {{-- job client ref --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control @error('job_client_ref') is-invalid @enderror"
                                        id="job_client_ref" name="job_client_ref" value="{{ old('job_client_ref') }}"
                                        placeholder="Enter job client reference number" min="0"
                                        oninput="this.value = Math.abs(this.value)">
                                    <label for="job_client_ref" style="font-weight: bold">Client Ref No:</label>
                                    @error('job_client_ref')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- input row 3 --}}
                        <div class="row mb-2">

                            {{-- job order date --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control @error('job_order_date') is-invalid @enderror"
                                        id="job_order_date" name="job_order_date" value="{{ old('job_order_date') }}"
                                        placeholder="Enter job order date">
                                    <label for="job_order_date" style="font-weight: bold">Job order date</label>
                                    @error('job_order_date')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            {{-- job deliver date --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="date"
                                        class="form-control @error('job_deliver_date') is-invalid @enderror"
                                        id="job_deliver_date" name="job_deliver_date" value="{{ old('job_deliver_date') }}"
                                        placeholder="Enter job deliver date">
                                    <label for="job_deliver_date" style="font-weight: bold">Job deliver date</label>
                                    @error('job_deliver_date')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- input row 4 --}}
                        <div class="row mb-2">

                            {{-- job material option --}}
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @error('job_material_option') is-invalid @enderror"
                                        id="job_material_option" name="job_material_option"
                                        value="{{ old('job_material_option') }}" placeholder="Enter material option">
                                    <label for="job_material_option" style="font-weight: bold">Material option</label>
                                    @error('job_material_option')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="card border-0 shadow-none mt-5">
                            <div class="card-header" style="background-color: transparent;">
                                <h5>Style Details</h5>
                            </div>

                            {{-- multiple style insert --}}

                            <div class="card-body">
                                {{-- style adder --}}
                                <table class="table table-striped table-bordered">

                                    <head>
                                        <tr class="bg-gr-mint-light">
                                            <th>Category</th>
                                            <th>Design</th>
                                            <th>Sleeve</th>
                                            <th>Neck type</th>
                                            <th>Size</th>
                                            <th width="10%">Qty</th>
                                        </tr>
                                    </head>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select id="style_category" class="form-control" name="style_category">
                                                    <option value="" disabled selected hidden>
                                                        Select a category
                                                    </option>

                                                    {{-- Category options here : --}}
                                                    <option value="1">Mens</option>
                                                    <option value="2">Ladies</option>
                                                    <option value="3">Kids</option>

                                                </select>
                                            </td>
                                            <td>
                                                <select id="style_design" class="form-control" name="style_design"
                                                    onchange="onDesignSelect()">
                                                    <option value="" disabled selected hidden>
                                                        Select a design
                                                    </option>

                                                    {{-- Design options here : --}}
                                                    <option value="1">T-shirt</option>
                                                    <option value="2">Short</option>
                                                    <option value="3">Skirt</option>
                                                    <option value="4">Bottom</option>

                                                </select>
                                            </td>
                                            <td>
                                                <select id="style_sleeve" class="form-control" name="style_sleeve">
                                                    <option value="" disabled selected hidden>
                                                        Select a sleeve
                                                    </option>

                                                    {{-- Type options here : --}}
                                                    <option value="0">None</option>
                                                    <option value="1">Short sleeves</option>
                                                    <option value="2">Long sleeves</option>

                                                </select>
                                            </td>

                                            <td>
                                                <select id="style_neck" class="form-control" name="style_neck">
                                                    <option value="" disabled selected hidden>
                                                        Select a neck type
                                                    </option>

                                                    {{-- Neck type options here : --}}
                                                    <option value="0">None</option>
                                                    <option value="1">C-neck</option>
                                                    <option value="2">V-neck</option>
                                                    <option value="3">Polo</option>

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
                                                <input type="number" value="0" class="form-control" id="style_qty"
                                                    min="0" oninput="this.value = Math.abs(this.value)" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="6" style="text-align:right"><button type="button"
                                                    class="btn btn-sm text-bold bg-gr-mint" onclick="append_tr()"><span
                                                        class="fas fa-plus mr-2"></span>ADD</button></td>
                                        </tr>

                                    </tbody>


                                </table>

                                {{-- style display --}}
                                <table id="styles_table" class="table table-bordered">

                                    <head>
                                        <tr class="bg-gr-mint-light">
                                            <th>Category</th>
                                            <th>Design</th>
                                            <th>Sleeve</th>
                                            <th>Neck type</th>
                                            <th>Size</th>
                                            <th width="10%">Qty</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </head>

                                    <tbody id="styles_table_body">
                                    </tbody>
                                    <input type="hidden" name="style_row_count" id="style_row_count" value="0">
                                </table>
                            </div>

                        </div>

                        <div class="card border-0 shadow-none">
                            <div class="card-header" style="background-color: transparent;">
                                <h5>Design references</h5>
                            </div>
                            <div class="card-body">

                                {{-- input row 5 --}}
                                <div class="row mb-2">
                                    {{-- job design image 1 --}}
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="file"
                                                class="form-control @error('job_design_image_1') is-invalid @enderror"
                                                id="job_design_image_1" name="job_design_image_1"
                                                placeholder="Enter design image 1">
                                            <label for="job_design_image_1" style="font-weight: bold;">Design image
                                                1</label>
                                            @error('job_design_image_1')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- job design image 2 --}}
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="file"
                                                class="form-control @error('job_design_image_2') is-invalid @enderror"
                                                id="job_design_image_2" name="job_design_image_2"
                                                placeholder="Enter design image 2">
                                            <label for="job_design_image_2" style="font-weight: bold;">Design image
                                                2</label>
                                            @error('job_design_image_2')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card border-0 shadow-none">
                            <div class="card-header" style="background-color: transparent;">
                                <h5>Extras</h5>
                            </div>
                            <div class="card-body">

                                {{-- input row 6 --}}
                                <div class="row mb-2">

                                    {{-- job comment --}}
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('job_comment') is-invalid @enderror"
                                                id="job_comment" name="job_comment" value="{{ old('job_comment') }}"
                                                placeholder="Enter comments">
                                            <label for="job_comment" style="font-weight: bold">Other comments</label>
                                            @error('job_comment')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- job packing --}}
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('job_packing') is-invalid @enderror"
                                                id="job_packing" name="job_packing" value="{{ old('job_packing') }}"
                                                placeholder="Enter neck type">
                                            <label for="job_packing" style="font-weight: bold">Packing</label>
                                            @error('job_packing')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    {{-- deparments & dates section --}}
                    <section class="content mt-3">

                        <div class="card border-0 shadow-none">
                            <div class="card-header" style="background-color: transparent;">
                                <h5>Department Selection</h5>
                            </div>
                            <div class="card-body">

                                {{-- table --}}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">Departments</th>
                                            <th class="text-center">Start dates</th>
                                            <th class="text-center">End dates</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        {{-- design department row --}}
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        onchange="markDepartment('check_design' , 'design_start_date', 'design_end_date')"
                                                        id="check_design">
                                                    <label class="form-check-label" for="check_design">
                                                        Design Department
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="design_start_date"
                                                    name="design_start_date">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="design_end_date"
                                                    name="design_end_date">
                                            </td>
                                        </tr>

                                        {{-- printing department row --}}
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        onchange="markDepartment('check_printing' , 'printing_start_date', 'printing_end_date')"
                                                        id="check_printing">
                                                    <label class="form-check-label" for="check_printing">
                                                        Printing Department
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="printing_start_date"
                                                    name="printing_start_date">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="printing_end_date"
                                                    name="printing_end_date">
                                            </td>
                                        </tr>

                                        {{-- pressing department row --}}
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="3"
                                                        onchange="markDepartment('check_pressing' , 'pressing_start_date', 'pressing_end_date')"
                                                        id="check_pressing">
                                                    <label class="form-check-label" for="check_pressing">
                                                        Pressing Department
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="pressing_start_date"
                                                    name="pressing_start_date">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="pressing_end_date"
                                                    name="pressing_end_date">
                                            </td>
                                        </tr>

                                        {{-- cutting department row --}}
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="4"
                                                        onchange="markDepartment('check_cutting' , 'cutting_start_date', 'cutting_end_date')"
                                                        id="check_cutting">
                                                    <label class="form-check-label" for="check_cutting">
                                                        Cutting Department
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="cutting_start_date"
                                                    name="cutting_start_date">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="cutting_end_date"
                                                    name="cutting_end_date">
                                            </td>
                                        </tr>

                                        {{-- sewing department row --}}
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="5"
                                                        onchange="markDepartment('check_sewing' , 'sewing_start_date', 'sewing_end_date')"
                                                        id="check_sewing">
                                                    <label class="form-check-label" for="check_sewing">
                                                        Sewing Department
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="sewing_start_date"
                                                    name="sewing_start_date">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" id="sewing_end_date"
                                                    name="sewing_end_date">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <hr>

                    </section>

                    <div class="d-flex flex-row-reverse mt-1 mb-2 me-2">
                        <button type="submit" class="btn btn-primary border-0 m-1 text-bold bg-gr-blue"
                            onclick="submitJobTicket()">Submit
                            job ticket</button>
                    </div>

                </div>
                {{-- / card body --}}
            </div>
        </div>
    </section>

    {{-- re importing jQuery because it won't load for some reason  --}}
    <script src="plugins/jquery/jquery.min.js"></script>

    {{-- custom script --}}
    <script>
        // on design select : upon selecting the design, change the available options accordingly
        // ----------------   ------------------------------------------------------------------

        function onDesignSelect() {

            let select_design = document.getElementById('style_design');
            let design = select_design.options[select_design.selectedIndex].text;

            if (design != "T-shirt") {

                $('#style_sleeve').val('0');
                $('#style_neck').val('0');

                $('#style_sleeve').prop("disabled", true);
                $('#style_neck').prop("disabled", true);
            } else {

                $('#style_sleeve').val('');
                $('#style_neck').val('');

                $('#style_sleeve').prop("disabled", false);
                $('#style_neck').prop("disabled", false);
            }


        }


        // append tr : appends a table row to the styles table when the add button is clicked
        // ---------   ----------------------------------------------------------------------

        function append_tr() {

            let select_style_category = document.getElementById('style_category');
            let select_style_design = document.getElementById('style_design');
            let select_style_sleeve = document.getElementById('style_sleeve');
            let select_style_neck = document.getElementById('style_neck');
            let select_style_size = document.getElementById('style_size');

            let style_category = select_style_category.options[select_style_category.selectedIndex].text;
            let style_design = select_style_design.options[select_style_design.selectedIndex].text;
            let style_sleeve = select_style_sleeve.options[select_style_sleeve.selectedIndex].text;
            let style_neck = select_style_neck.options[select_style_neck.selectedIndex].text;
            let style_size = select_style_size.options[select_style_size.selectedIndex].text;

            let style_category_val = select_style_category.options[select_style_category.selectedIndex].value;
            let style_design_val = select_style_design.options[select_style_design.selectedIndex].value;
            let style_sleeve_val = select_style_sleeve.options[select_style_sleeve.selectedIndex].value;
            let style_neck_val = select_style_neck.options[select_style_neck.selectedIndex].value;
            let style_size_val = select_style_size.options[select_style_size.selectedIndex].value;


            let style_qty = $('#style_qty').val();

            let style_row_count = $('#style_row_count').val();
            $('#style_row_count').val(parseInt(style_row_count) + 1);

            // style append validations

            if (style_category_val == "") {
                validationWarning("Style category not selected", "Please select a category for your style");
            } else if (style_design_val == "") {
                validationWarning("Style design not selected", "Please select a design for your style");
            } else if (style_sleeve_val == "") {
                validationWarning("Style sleeve not selected", "Please select a sleeve for your style");
            } else if (style_neck_val == "") {
                validationWarning("Style neck type not selected", "Please select a neck type for your style");
            } else if (style_size_val == "") {
                validationWarning("Style size not selected", "Please select a size for your style");
            } else if (style_qty <= 0) {
                validationWarning("Style quantity is 0",
                    "Please increase the quantity for your style");
            } else {

                // if all is valid

                $('#styles_table_body').append('<tr id=tr_"' + style_row_count + '">' +
                    '<td>' + style_category + '<input class="style-category" type="hidden" value="' + style_category +
                    '" id="style_category_' + style_row_count + '" name="style_category_' + style_row_count +
                    '" /></td>' +
                    '<td>' + style_design + '<input class="style-design" type="hidden" value="' + style_design +
                    '" id="style_design_' +
                    style_row_count +
                    '" name="style_design_' + style_row_count + '" /></td>' +
                    '<td>' + style_sleeve + '<input class="style-sleeve" type="hidden" value="' + style_sleeve +
                    '" id="style_sleeve_' + style_row_count + '" name="style_sleeve_' + style_row_count +
                    '" /></td>' +
                    '<td>' + style_neck + '<input class="style-neck" type="hidden" value="' + style_neck +
                    '" id="style_neck_' + style_row_count + '" name="style_neck_' + style_row_count +
                    '" /></td>' +
                    '<td>' + style_size +
                    '<input class="style-size" type="hidden" value="' +
                    style_size + '" id="style_size_' + style_row_count + '" name="style_size_' + style_row_count +
                    '" /></td>' +
                    '<td>' + style_qty +
                    '<input class="style-qty" type="hidden" value="' +
                    style_qty + '" id="style_qty_' + style_row_count + '" name="style_qty_' + style_row_count +
                    '" /></td>' +
                    '<td style="text-align:center"><button type="button" class="btn btn-danger btn-sm" onclick="delete_row(this)"><span class="fas fa-eraser"></span></button></td>' +
                    '</tr>');

            }

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
            let job_material_option = $('#job_material_option').val();
            let job_packing = $('#job_packing').val();
            let job_comment = $('#job_comment').val() != '' ? $('#job_comment').val() : 'No comment';

            // job design image :

            let job_design_image_1_input = document.getElementById('job_design_image_1');
            let job_design_image_1 = job_design_image_1_input.files[0];

            let job_design_image_2_input = document.getElementById('job_design_image_2');
            let job_design_image_2 = job_design_image_2_input.files[0];

            // job styles row count :

            let style_row_count = $('#style_row_count').val();

            // styles

            let style_categories = [];
            let style_designs = [];
            let style_sleeves = [];
            let style_necks = [];
            let style_sizes = [];
            let style_qtys = [];

            // departments

            let marked_departments = [];
            let marked_start_dates = [];
            let marked_end_dates = [];

            // pushing in elements

            $('.style-category').each(function() {
                style_categories.push($(this).val());
            })

            $('.style-design').each(function() {
                style_designs.push($(this).val());
            })

            $('.style-sleeve').each(function() {
                style_sleeves.push($(this).val());
            })

            $('.style-neck').each(function() {
                style_necks.push($(this).val());
            })

            $('.style-size').each(function() {
                style_sizes.push($(this).val());
            })

            $('.style-qty').each(function() {
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


            if (job_title == "") {
                validationWarning("Job title empty", "Please enter your job title before submitting");
            } else if (job_no == "") {
                validationWarning("Job number empty", "Please enter your job number before submitting");
            } else if (job_client == null) {
                validationWarning("Client not selected", "Please select a client before submitting");
            } else if (job_client_ref == "") {
                validationWarning("Client reference number empty",
                    "Please enter your client reference number before submitting");
            } else if (job_order_date == "") {
                validationWarning("Order date not set", "Please set an order date to the job before submitting");
            } else if (job_deliver_date == "") {
                validationWarning("Deliver date not set", "Please set an deliver date to the job before submitting");
            } else if (job_material_option == "") {
                validationWarning("Material option empty", "Please enter your material option before submitting");
            } else if (style_row_count == 0) {
                validationWarning("No styles added", "Please add at least one style before submitting");
            } else if (job_design_image_1 == null && job_design_image_2 == null) {
                validationWarning("Design images not selected",
                    "Please select at least one design image before submitting");
            } else if (job_packing == "") {
                validationWarning("Packing details empty", "Please enter your packing details before submitting");
            } else if (marked_departments.length == 0) {
                validationWarning("No departments selected", "Please select at least one department before submitting");
            } else if (marked_start_dates.includes("") || marked_end_dates.includes("")) {
                validationWarning("Missing department dates",
                    "Please make sure you have set all your department start and end dates before submitting");
            } else {

                // if all is valid

                Swal.fire({
                    icon: 'question',
                    title: 'Confirm job ticket submission ?',
                    showDenyButton: true,
                    confirmButtonText: 'Submit',
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    if (result.isConfirmed) {

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
                        form_data.append('job_material_option', job_material_option);
                        form_data.append('job_design_image_1', job_design_image_1);
                        form_data.append('job_design_image_2', job_design_image_2);
                        form_data.append('job_comment', job_comment);
                        form_data.append('job_packing', job_packing);
                        form_data.append('style_categories', style_categories);
                        form_data.append('style_designs', style_designs);
                        form_data.append('style_sleeves', style_sleeves);
                        form_data.append('style_necks', style_necks);
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

        }


        // Making sweet alert fires less verbose
        // -------------------------------------

        function validationWarning(title, text) {
            Swal.fire({
                icon: "warning",
                title: title,
                text: text,
                showConfirmButton: 1
            });
        }
    </script>


@endsection
