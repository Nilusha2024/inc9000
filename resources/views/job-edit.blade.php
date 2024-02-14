@extends('layouts.app')

@section('content')
    {{-- job edit page --}}

    {{-- header section --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-black-50">Edit job</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
                        <li class="breadcrumb-item active">Edit job</li>
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
                    <h5>Update job ticket : {{ $job->job_title }}</h5>
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

                        {{-- hidden field to store id --}}
                        <input type="hidden" class="form-control" name="job_id" id="job_id"
                            value="{{ $job->id }}">

                        {{-- input row 1 --}}
                        <div class="row mb-2">

                            {{-- job title --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('job_title') is-invalid @enderror"
                                        id="job_title" name="job_title" value="{{ $job->job_title }}"
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
                                        id="job_no" name="job_no" value="{{ $job->job_no }}"
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


                            {{-- job client ref : text --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('job_client_ref') is-invalid @enderror"
                                        id="job_client_ref" name="job_client_ref" value="{{ $job->client_reference_no }}"
                                        placeholder="Enter job client reference number">
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
                                        id="job_order_date" name="job_order_date"
                                        value="{{ $job->order_date->toDateString() }}" placeholder="Enter job order date">
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
                                        id="job_deliver_date" name="job_deliver_date"
                                        value="{{ $job->deliver_date->toDateString() }}"
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
                                    <select
                                        class="form-select form-select-transparent @error('job_material_option') is-invalid @enderror"
                                        style="appearance:none;" name="job_material_option" id="job_material_option">
                                        <option value="" disabled selected hidden>Select your material option
                                        </option>

                                        <option value="ICE BURG">ICE BURG</option>
                                        <option value="WET LOOK">WET LOOK</option>
                                        <option value="GRID FABRIC">GRID FABRIC</option>
                                        <option value="COMB WEB">COMB WEB</option>
                                        <option value="4 WAY">4 WAY</option>
                                        <option value="NET ATT">NET ATT</option>
                                        <option value="BABY PK">BABY PK</option>
                                        <option value="CORN GRID">CORN GRID</option>
                                        <option value="SNOWFLAKE">SNOWFLAKE</option>
                                        <option value="CLOSEHOLE">CLOSEHOLE</option>
                                        <option value="TRYCOAT">TRYCOAT</option>
                                        <option value="PIQUE">PIQUE</option>
                                        <option value="COTTON">COTTON</option>
                                        <option value="SINGLE JERSEY">SINGLE JERSEY</option>
                                        <option value="WAFFLE">WAFFLE</option>
                                        <option value="DOT">DOT</option>
                                        <option value="SMALL CHECK">SMALL CHECK</option>
                                        <option value="MESH">MESH</option>
                                        <option value="COOL TECK">COOL TECK</option>
                                    </select>
                                    <label for="job_material_option">Material option</label>
                                    @error('job_material_option')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        {{-- input row 4.5 --}}
                        <div class="row mb-2">

                            {{-- job sleeve detail option --}}
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <select
                                        class="form-select form-select-transparent @error('job_sleeve_details') is-invalid @enderror"
                                        style="appearance:none;" name="job_sleeve_details" id="job_sleeve_details">
                                        <option value="" disabled selected hidden>Select your sleeve detail</option>

                                        <option value="HEM">HEM</option>
                                        <option value="CUFF">CUFF</option>

                                    </select>
                                    <label for="job_sleeve_details">Sleeve details</label>
                                    @error('job_sleeve_details')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- input row 4.75 --}}
                        <div class="row mb-5">

                            {{-- job sleeve remark option --}}
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @error('job_sleeve_remarks') is-invalid @enderror"
                                        id="job_sleeve_remarks" name="job_sleeve_remarks"
                                        value="{{ $job->sleeve_remarks }}" placeholder="Enter sleeve remarks">
                                    <label for="job_sleeve_remarks" style="font-weight: bold">Sleeve remarks</label>
                                    @error('job_sleeve_remarks')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>



                        {{-- styles accordion --}}

                        <div class="accordion mt-4" id="styles_accordion">

                            <div class="accordion-item">
                                <h1 class="accordion-header" id="styles_accordion_header">
                                    <button class="accordion-button collapsed text-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#styles_accordion_collapse"
                                        aria-expanded="false" aria-controls="styles_accordion_collapse">
                                        Style Details
                                    </button>
                                </h1>
                                <div id="styles_accordion_collapse" class="accordion-collapse collapse"
                                    aria-labelledby="styles_accordion_header" data-bs-parent="#styles_accordion">
                                    <div class="accordion-body">

                                        {{-- styles card goes here --}}

                                        <div class="card border-0 shadow-none">
                                            <div class="card-header" style="background-color: transparent;">

                                                {{-- style update enabler on the card --}}
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="check_style_update">
                                                    <label class="form-check-label h6 ms-2" for="check_style_update">
                                                        Enable style update
                                                    </label>
                                                </div>
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
                                                            <th width="20%">Style remarks</th>
                                                            <th width="8%">Qty</th>

                                                        </tr>
                                                    </head>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <select id="style_category" class="form-control"
                                                                    name="style_category">
                                                                    <option value="" disabled selected hidden>
                                                                        Select a category
                                                                    </option>

                                                                    {{-- Category options here : --}}
                                                                    <option value="1">Mens</option>
                                                                    <option value="2">Ladies</option>
                                                                    <option value="3">Kids</option>
                                                                    <option value="4">Muslimaha</option>
                                                                    <option value="5">Muslimaha kids</option>

                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select id="style_design" class="form-control"
                                                                    name="style_design" onchange="onDesignSelect()">
                                                                    <option value="" disabled selected hidden>
                                                                        Select a design
                                                                    </option>

                                                                    {{-- Design options here : --}}
                                                                    <option value="1">T-shirt</option>
                                                                    <option value="2">Short</option>
                                                                    <option value="3">Skirt</option>
                                                                    <option value="4">Bottom</option>
                                                                    <option value="5">Arm cut</option>
                                                                    <option value="6">Bibs</option>

                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select id="style_sleeve" class="form-control"
                                                                    name="style_sleeve">
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
                                                                <select id="style_neck" class="form-control"
                                                                    name="style_neck">
                                                                    <option value="" disabled selected hidden>
                                                                        Select a neck type
                                                                    </option>

                                                                    {{-- Neck type options here : --}}
                                                                    <option value="0">None</option>
                                                                    <option value="1">C-neck</option>
                                                                    <option value="2">V-neck</option>
                                                                    <option value="3">Polo</option>
                                                                    <option value="4">Chinese Collar</option>
                                                                    <option value="5">Henley Collar (Box)</option>
                                                                    <option value="6">Henley Collar (Normal)</option>
                                                                    <option value="7">Double V</option>
                                                                    <option value="8">Insert Neck</option>
                                                                    <option value="9">Hoodie</option>
                                                                    <option value="10">Ninja hoodie</option>
                                                                    <option value="11">V. Collar</option>
                                                                    <option value="12">V. Chinese Collar</option>
                                                                    <option value="13">Skinny</option>
                                                                    <option value="14">Jacket</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select id="style_size" class="form-control"
                                                                    name="style_size">
                                                                    <option value="" disabled selected hidden>
                                                                        Select a size
                                                                    </option>

                                                                    {{-- Size options here : --}}

                                                                    <option value="6">3XS</option>
                                                                    <option value="7">2XS</option>
                                                                    <option value="8">XS</option>

                                                                    <option value="1">S</option>
                                                                    <option value="2">M</option>
                                                                    <option value="3">L</option>
                                                                    <option value="4">XL</option>
                                                                    <option value="5">2XL</option>

                                                                    <option value="9">3XL</option>
                                                                    <option value="10">4XL</option>
                                                                    <option value="11">5XL</option>
                                                                    <option value="12">6XL</option>
                                                                    <option value="13">7XL</option>
                                                                    <option value="14">8XL</option>

                                                                </select>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <textarea class="form-control" id="style_remark" rows="1"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="number" value="0" class="form-control"
                                                                    id="style_qty" min="0"
                                                                    oninput="this.value = Math.abs(this.value)" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="7" style="text-align:right"><button
                                                                    type="button" class="btn btn-sm text-bold bg-gr-mint"
                                                                    onclick="append_tr()"><span
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
                                                            <th width="20%">Style remarks</th>
                                                            <th width="8%">Qty</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </head>

                                                    <tbody id="styles_table_body">

                                                        {{-- load the current styles into this table --}}

                                                        @php
                                                            $styleRowCount = 0;
                                                        @endphp

                                                        @foreach ($styleDetailRecords as $styleDetailRecord)
                                                            {{-- hidden initial style id storage --}}
                                                            <input type="hidden"
                                                                class="form-control initial-previous-style-id"
                                                                name="initial_previous_style_id"
                                                                id="initial_previous_style_id"
                                                                value="{{ $styleDetailRecord->id }}">


                                                            <tr id="tr_{{ $styleRowCount }}" class="style-row"
                                                                value="{{ $styleRowCount }}">
                                                                <td>
                                                                    {{-- hidden style id storage --}}
                                                                    <input type="hidden"
                                                                        class="form-control previous-style-id"
                                                                        name="style_id_{{ $styleRowCount }}"
                                                                        id="style_id_{{ $styleRowCount }}"
                                                                        value="{{ $styleDetailRecord->id }}" />

                                                                    {{ $styleDetailRecord->category }}
                                                                    <input class="previous-style-category" type="hidden"
                                                                        value="{{ $styleDetailRecord->category }}"
                                                                        id="previous_style_category_{{ $styleRowCount }}"
                                                                        name="previous_style_category_{{ $styleRowCount }}" />
                                                                </td>
                                                                <td>{{ $styleDetailRecord->design }}
                                                                    <input class="previous-style-design" type="hidden"
                                                                        value="{{ $styleDetailRecord->design }}"
                                                                        id="previous_style_design_{{ $styleRowCount }}"
                                                                        name="previous_style_design_{{ $styleRowCount }}" />
                                                                </td>
                                                                <td>{{ $styleDetailRecord->sleeve }}
                                                                    <input class="previous-style-sleeve" type="hidden"
                                                                        value="{{ $styleDetailRecord->sleeve }}"
                                                                        id="previous_style_sleeve_{{ $styleRowCount }}"
                                                                        name="previous_style_sleeve_{{ $styleRowCount }}" />
                                                                </td>
                                                                <td>{{ $styleDetailRecord->neck_type }}
                                                                    <input class="previous-style-neck" type="hidden"
                                                                        value="{{ $styleDetailRecord->neck_type }}"
                                                                        id="previous_style_neck_{{ $styleRowCount }}"
                                                                        name="previous_style_neck_{{ $styleRowCount }}" />
                                                                </td>
                                                                <td>{{ $styleDetailRecord->size }}
                                                                    <input class="previous-style-size" type="hidden"
                                                                        value="{{ $styleDetailRecord->size }}"
                                                                        id="previous_style_size_{{ $styleRowCount }}"
                                                                        name="previous_style_size_{{ $styleRowCount }}" />
                                                                </td>
                                                                <td>{{ $styleDetailRecord->remarks }}
                                                                    <input class="previous-style-remark" type="hidden"
                                                                        value="{{ $styleDetailRecord->remarks }}"
                                                                        id="previous_style_remark_{{ $styleRowCount }}"
                                                                        name="previous_style_remark_{{ $styleRowCount }}"
                                                                        rows="1" />
                                                                </td>
                                                                <td>{{ $styleDetailRecord->qty }}
                                                                    <input class="previous-style-qty" type="hidden"
                                                                        value="{{ $styleDetailRecord->qty }}"
                                                                        id="previous_style_qty_{{ $styleRowCount }}"
                                                                        name="previous_style_qty_{{ $styleRowCount }}" />
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex justify-content-around">
                                                                        <button type="button"
                                                                            value="{{ $styleRowCount }}"
                                                                            class="btn btn-primary btn-sm"
                                                                            onclick="edit_row(this)"><span
                                                                                class="fas fa-edit"></span></button>
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm"
                                                                            onclick="delete_row(this)"><span
                                                                                class="fas fa-eraser"></span></button>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                            @php
                                                                $styleRowCount++;
                                                            @endphp
                                                        @endforeach

                                                    </tbody>

                                                    <input type="hidden" name="style_row_count" id="style_row_count"
                                                        value="{{ $styleDetailRecords->count() }}">

                                                    {{-- total style qty row --}}
                                                    <tr>
                                                        <td colspan="5">
                                                        </td>
                                                        <td class="font-weight-bold">Total:
                                                        </td>
                                                        <td class="font-weight-bold" id="total_styles_qty">0
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>

                                        </div>

                                        {{-- Style Groups --}}
                                        <div class="card border-0 shadow-none mt-3">
                                            <div class="card-header" style="background-color: transparent;">
                                                <h5>Current Style Groups</h5>
                                            </div>

                                            {{-- multiple style insert --}}

                                            <div class="card-body">

                                                {{-- style display --}}
                                                <table id="styles_group_table" class="table table-bordered">

                                                    <head>
                                                        <tr class="bg-gr-mint-light">
                                                            <th>Category</th>
                                                            <th>Design</th>
                                                            <th>Sleeve</th>
                                                            <th>Neck type</th>
                                                            <th width="8%">Qty</th>
                                                        </tr>
                                                    </head>

                                                    <tbody id="styles_group_table_body">

                                                    </tbody>

                                                    <input type="hidden" name="style_group_row_count"
                                                        id="style_group_row_count" value="0">

                                                    {{-- total style qty row --}}
                                                    <tr>
                                                        <td colspan="3">
                                                        </td>
                                                        <td class="font-weight-bold">Total:
                                                        </td>
                                                        <td class="font-weight-bold" id="total_group_styles_qty">0
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>

                                        </div>



                                    </div>
                                </div>
                            </div>

                        </div>


                        {{-- design accordion --}}

                        <div class="accordion mt-2 mb-2" id="design_accordion">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="design_accordion_header">
                                    <button class="accordion-button collapsed text-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#design_accordion_collapse"
                                        aria-expanded="false" aria-controls="design_accordion_collapse">
                                        Design References
                                    </button>
                                </h2>
                                <div id="design_accordion_collapse" class="accordion-collapse collapse"
                                    aria-labelledby="design_accordion_header" data-bs-parent="#design_accordion">
                                    <div class="accordion-body">

                                        {{-- design card goes here --}}

                                        <div class="card border-0 shadow-none">
                                            <div class="card-header" style="background-color: transparent;">

                                                {{-- design update enabler on the card --}}
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="check_design_update">
                                                    <label class="form-check-label h6 ms-2" for="check_design_update">
                                                        Enable design update
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="card-body">

                                                {{-- image row --}}
                                                <div class="row mb-4">

                                                    {{-- image 1 --}}
                                                    <div class="col-sm-6">
                                                        <div class="d-flex" style="height: 100%;">
                                                            <div class="border d-flex justify-content-center align-items-center"
                                                                style="width: 100%; height: 500px; border-radius: 20px;">

                                                                @if ($job->job_design_image_1 != null)
                                                                    <img id="job_design_image_view"
                                                                        src={{ asset('uploads/jobs/' . $job->job_design_image_1) }}
                                                                        width="100%" height="100%"
                                                                        style="border-radius: 20px;" alt="design image">
                                                                @else
                                                                    <img id="job_design_image_view"
                                                                        src={{ asset('image/design-empty-placeholder.png') }}
                                                                        width="100%" height="100%"
                                                                        style="border-radius: 20px;" alt="design image">
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- image 2 --}}
                                                    <div class="col-sm-6">
                                                        <div class="d-flex" style="height: 100%;">
                                                            <div class="border d-flex justify-content-center align-items-center"
                                                                style="width: 100%; height: 500px; border-radius: 20px;">

                                                                @if ($job->job_design_image_2 != null)
                                                                    <img id="job_design_image_view"
                                                                        src={{ asset('uploads/jobs/' . $job->job_design_image_2) }}
                                                                        width="100%" height="100%"
                                                                        style="border-radius: 20px;" alt="design image">
                                                                @else
                                                                    <img id="job_design_image_view"
                                                                        src={{ asset('image/design-empty-placeholder.png') }}
                                                                        width="100%" height="100%"
                                                                        style="border-radius: 20px;" alt="design image">
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                {{-- input row 5 --}}
                                                <div class="row">
                                                    {{-- job design image 1 --}}
                                                    <div class="col-sm-6">
                                                        <div class="form-floating">
                                                            <input type="file"
                                                                class="form-control @error('job_design_image_1') is-invalid @enderror"
                                                                id="job_design_image_1" name="job_design_image_1"
                                                                placeholder="Enter design image 1">
                                                            <label for="job_design_image_1"
                                                                style="font-weight: bold;">Design image
                                                                1</label>
                                                            @error('job_design_image_1')
                                                                <span
                                                                    class="error invalid-feedback">{{ $message }}</span>
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
                                                            <label for="job_design_image_2"
                                                                style="font-weight: bold;">Design image
                                                                2</label>
                                                            @error('job_design_image_2')
                                                                <span
                                                                    class="error invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- document accordion --}}

                        <div class="accordion mt-2 mb-2" id="document_accordion">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="document_accordion_header">
                                    <button class="accordion-button collapsed text-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#document_accordion_collapse"
                                        aria-expanded="false" aria-controls="document_accordion_collapse">
                                        Documents for reference
                                    </button>
                                </h2>
                                <div id="document_accordion_collapse" class="accordion-collapse collapse"
                                    aria-labelledby="document_accordion_header" data-bs-parent="#document_accordion">
                                    <div class="accordion-body">

                                        {{-- document card goes here --}}

                                        <div class="card border-0 shadow-none">
                                            <div class="card-header" style="background-color: transparent;">

                                                {{-- document update enabler on the card --}}
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="check_document_update">
                                                    <label class="form-check-label h6 ms-2" for="check_document_update">
                                                        Enable reference document update
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="card-body">

                                                {{-- input row --}}
                                                <div class="row">
                                                    {{-- job refernce document --}}
                                                    <div class="col-sm-12">
                                                        <div class="form-floating">
                                                            <input type="file"
                                                                class="form-control @error('job_reference_document') is-invalid @enderror"
                                                                id="job_reference_document" name="job_reference_document"
                                                                placeholder="Enter reference document">
                                                            <label for="job_reference_document"
                                                                style="font-weight: bold;">Reference
                                                                document</label>
                                                            @error('job_reference_document')
                                                                <span
                                                                    class="error invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- department accordion --}}

                        <div class="accordion mb-4" id="department_accordion">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="department_accordion_header">
                                    <button class="accordion-button collapsed text-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#department_accordion_collapse"
                                        aria-expanded="false" aria-controls="department_accordion_collapse">
                                        Department Selection
                                    </button>
                                </h2>
                                <div id="department_accordion_collapse" class="accordion-collapse collapse"
                                    aria-labelledby="department_accordion_header" data-bs-parent="#department_accordion">
                                    <div class="accordion-body">

                                        {{-- department card goes here --}}

                                        <div class="card border-0 shadow-none">
                                            <div class="card-header" style="background-color: transparent;">

                                                {{-- department update enabler on the card --}}
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="check_department_update">
                                                    <label class="form-check-label h6 ms-2" for="check_department_update">
                                                        Enable department update
                                                    </label>
                                                </div>

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

                                                        {{-- job department detail : data initialization --}}

                                                        @php

                                                            $designDepartmentRecordId = 0;
                                                            $printingDepartmentRecordId = 0;
                                                            $pressingDepartmentRecordId = 0;
                                                            $cuttingDepartmentRecordId = 0;
                                                            $sewingDepartmentRecordId = 0;

                                                            $designDepartmentIsSelected = false;
                                                            $printingDepartmentIsSelected = false;
                                                            $pressingDepartmentIsSelected = false;
                                                            $cuttingDepartmentIsSelected = false;
                                                            $sewingDepartmentIsSelected = false;
                                                        @endphp

                                                        @foreach ($departmentDetailRecords as $departmentDetailRecord)
                                                            @switch($departmentDetailRecord->department_id)
                                                                @case(1)
                                                                    @php
                                                                        $designDepartmentIsSelected = true;
                                                                        $designDepartmentRecordId = $departmentDetailRecord->id;
                                                                        $designDepartmentStartDate = $departmentDetailRecord->start_date->toDateString();
                                                                        $designDepartmentEndDate = $departmentDetailRecord->end_date->toDateString();
                                                                    @endphp
                                                                @break

                                                                @case(2)
                                                                    @php
                                                                        $printingDepartmentIsSelected = true;
                                                                        $printingDepartmentRecordId = $departmentDetailRecord->id;
                                                                        $printingDepartmentStartDate = $departmentDetailRecord->start_date->toDateString();
                                                                        $printingDepartmentEndDate = $departmentDetailRecord->end_date->toDateString();
                                                                    @endphp
                                                                @break

                                                                @case(3)
                                                                    @php
                                                                        $pressingDepartmentIsSelected = true;
                                                                        $pressingDepartmentRecordId = $departmentDetailRecord->id;
                                                                        $pressingDepartmentStartDate = $departmentDetailRecord->start_date->toDateString();
                                                                        $pressingDepartmentEndDate = $departmentDetailRecord->end_date->toDateString();
                                                                    @endphp
                                                                @break

                                                                @case(4)
                                                                    @php
                                                                        $cuttingDepartmentIsSelected = true;
                                                                        $cuttingDepartmentRecordId = $departmentDetailRecord->id;
                                                                        $cuttingDepartmentStartDate = $departmentDetailRecord->start_date->toDateString();
                                                                        $cuttingDepartmentEndDate = $departmentDetailRecord->end_date->toDateString();
                                                                    @endphp
                                                                @break

                                                                @case(5)
                                                                    @php
                                                                        $sewingDepartmentIsSelected = true;
                                                                        $sewingDepartmentRecordId = $departmentDetailRecord->id;
                                                                        $sewingDepartmentStartDate = $departmentDetailRecord->start_date->toDateString();
                                                                        $sewingDepartmentEndDate = $departmentDetailRecord->end_date->toDateString();
                                                                    @endphp
                                                                @break

                                                                @default
                                                            @endswitch
                                                        @endforeach

                                                        {{-- design department row --}}
                                                        <tr>
                                                            <td>

                                                                @if ($designDepartmentIsSelected)
                                                                    <input type="hidden" id="design_department_record_id"
                                                                        name="design_department_record_id"
                                                                        class="initial-previous-marked-department-id previous-marked-department-id"
                                                                        value="{{ $designDepartmentRecordId }}">
                                                                @endif

                                                                <div class="form-check form-switch">
                                                                    <input
                                                                        class="form-check-input @if ($designDepartmentIsSelected) previous-marked-department @endif"
                                                                        type="checkbox" value="1"
                                                                        onchange="markDepartment('check_design' , 'design_start_date', 'design_end_date', 'design_department_record_id')"
                                                                        id="check_design"
                                                                        @if ($designDepartmentIsSelected) checked @endif>
                                                                    <label class="form-check-label" for="check_design">
                                                                        Design Department
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($designDepartmentIsSelected) previous-marked-start-date @endif"
                                                                    id="design_start_date" name="design_start_date"
                                                                    @if ($designDepartmentIsSelected) value="{{ $designDepartmentStartDate }}" @endif>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($designDepartmentIsSelected) previous-marked-end-date @endif"
                                                                    id="design_end_date" name="design_end_date"
                                                                    @if ($designDepartmentIsSelected) value="{{ $designDepartmentEndDate }}" @endif>
                                                            </td>
                                                        </tr>

                                                        {{-- printing department row --}}
                                                        <tr>
                                                            <td>

                                                                @if ($printingDepartmentIsSelected)
                                                                    <input type="hidden"
                                                                        id="printing_department_record_id"
                                                                        name="printing_department_record_id"
                                                                        class="initial-previous-marked-department-id previous-marked-department-id"
                                                                        value="{{ $printingDepartmentRecordId }}">
                                                                @endif

                                                                <div class="form-check form-switch">
                                                                    <input
                                                                        class="form-check-input @if ($printingDepartmentIsSelected) previous-marked-department @endif"
                                                                        type="checkbox" value="2"
                                                                        onchange="markDepartment('check_printing' , 'printing_start_date', 'printing_end_date', 'printing_department_record_id')"
                                                                        id="check_printing"
                                                                        @if ($printingDepartmentIsSelected) checked @endif>
                                                                    <label class="form-check-label" for="check_printing">
                                                                        Printing Department
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($printingDepartmentIsSelected) previous-marked-start-date @endif"
                                                                    id="printing_start_date" name="printing_start_date"
                                                                    @if ($printingDepartmentIsSelected) value="{{ $printingDepartmentStartDate }}" @endif>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($printingDepartmentIsSelected) previous-marked-end-date @endif"
                                                                    id="printing_end_date" name="printing_end_date"
                                                                    @if ($printingDepartmentIsSelected) value="{{ $printingDepartmentEndDate }}" @endif>
                                                            </td>
                                                        </tr>

                                                        {{-- pressing department row --}}
                                                        <tr>
                                                            <td>

                                                                @if ($pressingDepartmentIsSelected)
                                                                    <input type="hidden"
                                                                        id="pressing_department_record_id"
                                                                        name="pressing_department_record_id"
                                                                        class="initial-previous-marked-department-id previous-marked-department-id"
                                                                        value="{{ $pressingDepartmentRecordId }}">
                                                                @endif

                                                                <div class="form-check form-switch">
                                                                    <input
                                                                        class="form-check-input @if ($pressingDepartmentIsSelected) previous-marked-department @endif"
                                                                        type="checkbox" value="3"
                                                                        onchange="markDepartment('check_pressing' , 'pressing_start_date', 'pressing_end_date', 'pressing_department_record_id')"
                                                                        id="check_pressing"
                                                                        @if ($pressingDepartmentIsSelected) checked @endif>
                                                                    <label class="form-check-label" for="check_pressing">
                                                                        Pressing Department
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($pressingDepartmentIsSelected) previous-marked-start-date @endif"
                                                                    id="pressing_start_date" name="pressing_start_date"
                                                                    @if ($pressingDepartmentIsSelected) value="{{ $pressingDepartmentStartDate }}" @endif>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($pressingDepartmentIsSelected) previous-marked-end-date @endif"
                                                                    id="pressing_end_date" name="pressing_end_date"
                                                                    @if ($pressingDepartmentIsSelected) value="{{ $pressingDepartmentEndDate }}" @endif>
                                                            </td>
                                                        </tr>

                                                        {{-- cutting department row --}}
                                                        <tr>
                                                            <td>

                                                                @if ($cuttingDepartmentIsSelected)
                                                                    <input type="hidden"
                                                                        id="cutting_department_record_id"
                                                                        name="cutting_department_record_id"
                                                                        class="initial-previous-marked-department-id previous-marked-department-id"
                                                                        value="{{ $cuttingDepartmentRecordId }}">
                                                                @endif

                                                                <div class="form-check form-switch">
                                                                    <input
                                                                        class="form-check-input @if ($cuttingDepartmentIsSelected) previous-marked-department @endif"
                                                                        type="checkbox" value="4"
                                                                        onchange="markDepartment('check_cutting' , 'cutting_start_date', 'cutting_end_date', 'cutting_department_record_id')"
                                                                        id="check_cutting"
                                                                        @if ($cuttingDepartmentIsSelected) checked @endif>
                                                                    <label class="form-check-label" for="check_cutting">
                                                                        Cutting Department
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($cuttingDepartmentIsSelected) previous-marked-start-date @endif"
                                                                    id="cutting_start_date" name="cutting_start_date"
                                                                    @if ($cuttingDepartmentIsSelected) value="{{ $cuttingDepartmentStartDate }}" @endif>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($cuttingDepartmentIsSelected) previous-marked-end-date @endif"
                                                                    id="cutting_end_date" name="cutting_end_date"
                                                                    @if ($cuttingDepartmentIsSelected) value="{{ $cuttingDepartmentEndDate }}" @endif>
                                                            </td>
                                                        </tr>

                                                        {{-- sewing department row --}}
                                                        <tr>
                                                            <td>

                                                                @if ($sewingDepartmentIsSelected)
                                                                    <input type="hidden" id="sewing_department_record_id"
                                                                        name="sewing_department_record_id"
                                                                        class="initial-previous-marked-department-id previous-marked-department-id"
                                                                        value="{{ $sewingDepartmentRecordId }}">
                                                                @endif

                                                                <div class="form-check form-switch">
                                                                    <input
                                                                        class="form-check-input @if ($sewingDepartmentIsSelected) previous-marked-department @endif"
                                                                        type="checkbox" value="5"
                                                                        onchange="markDepartment('check_sewing' , 'sewing_start_date', 'sewing_end_date', 'sewing_department_record_id')"
                                                                        id="check_sewing"
                                                                        @if ($sewingDepartmentIsSelected) checked @endif>
                                                                    <label class="form-check-label" for="check_sewing">
                                                                        Sewing Department
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($sewingDepartmentIsSelected) previous-marked-start-date @endif"
                                                                    id="sewing_start_date" name="sewing_start_date"
                                                                    @if ($sewingDepartmentIsSelected) value="{{ $sewingDepartmentStartDate }}" @endif>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    class="form-control @if ($sewingDepartmentIsSelected) previous-marked-end-date @endif"
                                                                    id="sewing_end_date" name="sewing_end_date"
                                                                    @if ($sewingDepartmentIsSelected) value="{{ $sewingDepartmentEndDate }}" @endif>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
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


                                    {{-- job t-shirt details --}}
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('job_tshirt_details') is-invalid @enderror"
                                                id="job_tshirt_details" name="job_tshirt_details"
                                                value="{{ $job->tshirt_details }}" placeholder="Enter tshirt details">
                                            <label for="job_tshirt_details" style="font-weight: bold">T-shirt
                                                details</label>
                                            @error('job_tshirt_details')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- job short details --}}
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('job_short_details') is-invalid @enderror"
                                                id="job_short_details" name="job_short_details"
                                                value="{{ $job->short_details }}" placeholder="Enter short details">
                                            <label for="job_short_details" style="font-weight: bold">Short
                                                details</label>
                                            @error('job_short_details')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- job special note --}}
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('job_special_note') is-invalid @enderror"
                                                id="job_special_note" name="job_special_note"
                                                value="{{ $job->special_note }}" placeholder="Enter special note">
                                            <label for="job_special_note" style="font-weight: bold">Special note</label>
                                            @error('job_special_note')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- job logo & number --}}
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('job_logo_and_number') is-invalid @enderror"
                                                id="job_logo_and_number" name="job_logo_and_number"
                                                value="{{ $job->logo_and_number }}" placeholder="Enter logo and number">
                                            <label for="job_logo_and_number" style="font-weight: bold">Logo and
                                                number</label>
                                            @error('job_logo_and_number')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- job size label details --}}
                                    <div class="col-sm-12 mb-2">

                                        <div class="form-floating">
                                            <select
                                                class="form-select form-select-transparent @error('job_size_label_details') is-invalid @enderror"
                                                style="appearance:none;" name="job_size_label_details"
                                                id="job_size_label_details">
                                                <option value="" disabled selected hidden>Select your size label
                                                    detail
                                                </option>

                                                <option value="XOOM">XOOM</option>
                                                <option value="DIHIZY">DIHIZY</option>
                                                <option value="KINGS SPORT">KINGS SPORT</option>
                                                <option value="PRINT CO">PRINT CO</option>
                                                <option value="JOZY MV">JOZY MV</option>
                                                <option value="MANY">MANY</option>
                                                <option value="BLINDU">BLINDU</option>
                                                <option value="TAT">TAT</option>
                                                <option value="TINGLE">TINGLE</option>

                                            </select>
                                            <label for="job_size_label_details">Size label details</label>
                                            @error('job_size_label_details')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    {{-- job pattern --}}
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('job_pattern') is-invalid @enderror"
                                                id="job_pattern" name="job_pattern" value="{{ $job->pattern }}"
                                                placeholder="Enter pattern">
                                            <label for="job_pattern" style="font-weight: bold">Pattern</label>
                                            @error('job_pattern')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- job comment --}}
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('job_comment') is-invalid @enderror"
                                                id="job_comment" name="job_comment" value="{{ $job->comment }}"
                                                placeholder="Enter comments">
                                            <label for="job_comment" style="font-weight: bold">Other comments</label>
                                            @error('job_comment')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="card border-0 shadow-none">
                            <div class="card-header" style="background-color: transparent;">
                                <h5>Packing</h5>
                            </div>
                            <div class="card-body">

                                {{-- input row 7 --}}
                                <div class="row mb-2">

                                    {{-- job packing : radio button options --}}
                                    <div class="col-sm-12">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="job-packing"
                                                id="job-packing-option-1" value="MASTER BAG"
                                                @if ($job->packing == 'MASTER BAG') checked @endif>
                                            <label class="form-check-label" for="job-packing-option-1">
                                                Master bag
                                            </label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="job-packing"
                                                id="job-packing-option-2" value="INDIVIDUAL POLY BAG WITH MASTER BAG"
                                                @if ($job->packing == 'INDIVIDUAL POLY BAG WITH MASTER BAG') checked @endif>
                                            <label class="form-check-label" for="job-packing-option-2">
                                                Individual polly bag with master bag
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="card border-0 shadow-none">
                            <div class="card-header" style="background-color: transparent;">
                                <h5>Danger zone</h5>
                            </div>
                            <div class="card-body">

                                <div class="row mb-2">

                                    {{-- cancel button --}}
                                    <div class="col-sm-12">

                                        @if ($job->record_status == 1)
                                            <button class="border-0 btn font-weight-bold bg-gr-crimson text-light"
                                                value="{{ $job->id }}" onclick="deactivateJob(this.value)">CANCEL
                                                JOB</button>
                                        @else
                                            <button class="border-0 btn font-weight-bold bg-secondary text-light"
                                                disabled>JOB CANCEL</button>
                                        @endif


                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- submit --}}
                    <div class="d-flex flex-row-reverse mt-1 mb-2 me-2">

                        @if ($job->record_status == 1)
                            <button type="submit" class="btn btn-primary border-0 m-1 text-bold bg-gr-blue"
                                onclick="updateJobTicket()">Update
                                job ticket</button>
                        @endif

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
        // style row and style id storage
        // -------------------------------------
        let styleRowHolderMap = new Map();
        let styleIdHolderMap = new Map();


        // previous values into drop downs
        // -----------------------------

        document.getElementsByName('job_client')[0].value = "{{ $job->client_id }}";
        document.getElementsByName('job_material_option')[0].value = "{{ $job->material_option }}";
        document.getElementsByName('job_sleeve_details')[0].value = "{{ $job->sleeve_details }}";
        document.getElementsByName('job_size_label_details')[0].value = "{{ $job->size_label_details }}";

        // initial call to set up the style sum
        // ------------------------------------
        sumUpStyleQty();

        // initial call to set up the style group table
        // --------------------------------------------
        groupStyles();


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

        // on design select in edit : upon selecting the design (while editing), change the available options accordingly
        // ------------------------   -----------------------------------------------------------------------------------

        function onDesignSelectInEdit(selector) {

            // get row num
            let row = selector.parentNode.parentNode.id;
            let rowNum = $(`#${row}`).attr("value");

            let select_design = document.getElementById(`style_design_${rowNum}`);
            let design = select_design.options[select_design.selectedIndex].text;

            if (design != "T-shirt") {
                $(`#style_sleeve_${rowNum}`).val('0');
                $(`#style_neck_${rowNum}`).val('0');

                $(`#style_sleeve_${rowNum}`).prop("disabled", true);
                $(`#style_neck_${rowNum}`).prop("disabled", true);
            } else {
                $(`#style_sleeve_${rowNum}`).val('');
                $(`#style_neck_${rowNum}`).val('');

                $(`#style_sleeve_${rowNum}`).prop("disabled", false);
                $(`#style_neck_${rowNum}`).prop("disabled", false);
            }


        }

        // mark department : upon checking a department box, marks that department as checked
        // ---------------   -----------------------------------------------------------------

        function markDepartment(checkbox, startDatePicker, endDatePicker, recordIdInput) {

            let targetCheckbox = $("#" + checkbox);
            let targetStartDatePicker = $("#" + startDatePicker);
            let targetEndDatePicker = $("#" + endDatePicker);
            let targetRecordIdInput = $("#" + recordIdInput);

            if (document.getElementById(checkbox).checked) {
                if (!(targetCheckbox.hasClass("previous-marked-department") || targetStartDatePicker.hasClass(
                        "previous-marked-start-date") || targetEndDatePicker.hasClass("previous-marked-end-date"))) {
                    targetCheckbox.addClass("department-marked");
                    targetStartDatePicker.addClass("start-date-marked");
                    targetEndDatePicker.addClass("end-date-marked");
                } else {
                    // when previous marked :

                    // add class to the hidden id field
                    targetRecordIdInput.addClass('previous-marked-department-id');

                    // add the previous-marked dates classes
                    targetStartDatePicker.addClass('previous-marked-start-date');
                    targetEndDatePicker.addClass('previous-marked-end-date');
                }
            } else {
                if (!(targetCheckbox.hasClass("previous-marked-department") || targetStartDatePicker.hasClass(
                        "previous-marked-start-date") || targetEndDatePicker.hasClass("previous-marked-end-date"))) {
                    targetCheckbox.removeClass("department-marked");
                    targetStartDatePicker.removeClass("start-date-marked");
                    targetEndDatePicker.removeClass("end-date-marked");
                } else {
                    // when previous marked :

                    // add class to the hidden id field
                    targetRecordIdInput.removeClass('previous-marked-department-id');

                    // remove the previous-marked dates classes
                    targetStartDatePicker.removeClass('previous-marked-start-date');
                    targetEndDatePicker.removeClass('previous-marked-end-date');
                }
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
            let style_remark = $('#style_remark').val();

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
                    '<td>' + style_remark +
                    '<input class="style-remark" type="hidden" value="' +
                    style_remark + '" id="style_remark_' + style_row_count + '" name="style_remark_' +
                    style_row_count +
                    '" /></td>' +
                    '<td>' + style_qty +
                    '<input class="style-qty" type="hidden" value="' +
                    style_qty + '" id="style_qty_' + style_row_count + '" name="style_qty_' + style_row_count +
                    '" /></td>' +
                    '<td style="text-align:center"><div class="d-flex justify-content-around"><button type="button" class="btn btn-danger btn-sm" onclick="delete_row(this)"><span class="fas fa-eraser"></span></button></div></td>' +
                    '</tr>');

                // sum up style qty when a row is added
                sumUpStyleQty();

                // groups up styles when a style is added
                groupStyles();

            }

        }

        // delete row : deletes a row from the styles table when the eraser button is clicked
        // ----------   ---------------------------------------------------------------------

        function delete_row(btn) {
            let row = btn.parentNode.parentNode.parentNode;
            row.parentNode.removeChild(row);

            let style_row_count = $('#style_row_count').val();
            $('#style_row_count').val(parseInt(style_row_count) - 1);

            // sum up style qty when a row is deleted, group em too
            sumUpStyleQty();

            groupStyles();
        }


        // edit row : enables the edit mode of the selected style row
        // --------   -----------------------------------------------

        function edit_row(btn) {

            // get row num
            let rowNum = btn.value;

            // store row & id
            let row = $(`#tr_${rowNum}`).html();
            let rowStyleId = $(`#tr_${rowNum}`).find(`#style_id_${rowNum}`).val();

            // store row values

            let rowStyleCategory = $(`#tr_${rowNum}`).find(`#previous_style_category_${rowNum}`).val();
            let rowStyleDesign = $(`#tr_${rowNum}`).find(`#previous_style_design_${rowNum}`).val();
            let rowStyleSleeve = $(`#tr_${rowNum}`).find(`#previous_style_sleeve_${rowNum}`).val();
            let rowStyleNeck = $(`#tr_${rowNum}`).find(`#previous_style_neck_${rowNum}`).val();
            let rowStyleSize = $(`#tr_${rowNum}`).find(`#previous_style_size_${rowNum}`).val();
            let rowStyleQty = $(`#tr_${rowNum}`).find(`#previous_style_qty_${rowNum}`).val();
            let rowStyleRemark = $(`#tr_${rowNum}`).find(`#previous_style_remark_${rowNum}`).val();

            // check if the row is in edit mode
            let isInEditMode = $(`#tr_${rowNum}`).hasClass("edit-mode");

            if (isInEditMode) {

                // Get out of edit mode
                $(`#tr_${rowNum}`).removeClass("edit-mode");

                $(`#tr_${rowNum}`).html(styleRowHolderMap.get(`tr_${rowNum}`));

            } else {

                // store row & id on the map
                styleRowHolderMap.set(`tr_${rowNum}`, row);

                // BYPASS : bypass the corruption by putting a condition check for undefined

                if (rowStyleId != undefined) {
                    styleIdHolderMap.set(`tr_${rowNum}`, rowStyleId);
                }

                // Go into edit mode
                $(`#tr_${rowNum}`).addClass("edit-mode");

                $(`#tr_${rowNum}`).html(
                    `<td>

                        <input type="hidden"
                        class="form-control previous-style-id"
                        name="style_id_${rowNum}"
                        id="style_id_${rowNum}"
                        value="${rowStyleId}"/>

                        <select id="previous_style_category_${rowNum}" class="form-control"
                            name="previous_style_category_${rowNum}">
                            <option value="" disabled selected hidden>
                                Select a category
                            </option>

                            <option value="1">Mens</option>
                            <option value="2">Ladies</option>
                            <option value="3">Kids</option>
                            <option value="4">Muslimaha</option>
                            <option value="5">Muslimaha kids</option>


                        </select>
                    </td>
                    <td>
                        <select id="previous_style_design_${rowNum}" class="form-control"
                            name="previous_style_design_${rowNum}" onchange="onDesignSelectInEdit(this)">
                            <option value="" disabled selected hidden>
                                Select a design
                            </option>

                            <option value="1">T-shirt</option>
                            <option value="2">Short</option>
                            <option value="3">Skirt</option>
                            <option value="4">Bottom</option>
                            <option value="5">Arm cut</option>
                            <option value="6">Bibs</option>


                        </select>
                    </td>
                    <td>
                        <select id="previous_style_sleeve_${rowNum}" class="form-control"
                            name="previous_style_sleeve_${rowNum}">
                            <option value="" disabled selected hidden>
                                Select a sleeve
                            </option>

                            <option value="0">None</option>
                            <option value="1">Short sleeves</option>
                            <option value="2">Long sleeves</option>

                        </select>
                    </td>
                    <td>
                        <select id="previous_style_neck_${rowNum}" class="form-control"
                            name="previous_style_neck_${rowNum}">
                            <option value="" disabled selected hidden>
                                Select a neck type
                            </option>

                            <option value="0">None</option>
                            <option value="1">C-neck</option>
                            <option value="2">V-neck</option>
                            <option value="3">Polo</option>
                            <option value="4">Chinese Collar</option>
                            <option value="5">Henley Collar (Box)</option>
                            <option value="6">Henley Collar (Normal)</option>
                            <option value="7">Double V</option>
                            <option value="8">Insert Neck</option>
                            <option value="9">Hoodie</option>
                            <option value="10">Ninja hoodie</option>
                            <option value="11">V. Collar</option>
                            <option value="12">V. Chinese Collar</option>
                            <option value="13">Skinny</option>
                            <option value="14">Jacket</option>
                        </select>
                    </td>
                    <td>
                        <select id="previous_style_size_${rowNum}" class="form-control"
                            name="previous_style_size_${rowNum}">
                            <option value="" disabled selected hidden>
                                Select a size
                            </option>

                            <option value="6">3XS</option>
                            <option value="7">2XS</option>
                            <option value="8">XS</option>

                            <option value="1">S</option>
                            <option value="2">M</option>
                            <option value="3">L</option>
                            <option value="4">XL</option>
                            <option value="5">2XL</option>

                            <option value="9">3XL</option>
                            <option value="10">4XL</option>
                            <option value="11">5XL</option>
                            <option value="12">6XL</option>
                            <option value="13">7XL</option>
                            <option value="14">8XL</option>

                        </select>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea class="form-control" id="previous_style_remark_${rowNum}" rows="1"></textarea>
                        </div>
                    </td>
                    <td>
                        <input type="number" value="0" class="form-control"
                            id="previous_style_qty_${rowNum}" min="0"
                            oninput="this.value = Math.abs(this.value)" />
                    </td>
                    <td>
                        <div class="d-flex justify-content-around">
                            <button type="button"
                                value="${rowNum}"
                                class="btn btn-primary btn-sm"
                                onclick="update_row(this)">
                                <span class="fas fa-check">
                                </span>
                            </button>
                            <button type="button"
                                value="${rowNum}"
                                class="btn btn-danger btn-sm"
                                onclick="edit_row(this)">
                                <span class="fas fa-ban">
                                </span>
                            </button>
                        </div>
                    </td>`
                );

                // set the previous values here

                $(`#previous_style_category_${rowNum} option:contains("${rowStyleCategory}")`).prop('selected', true);
                $(`#previous_style_design_${rowNum} option:contains("${rowStyleDesign}")`).prop('selected', true);
                $(`#previous_style_sleeve_${rowNum} option:contains("${rowStyleSleeve}")`).prop('selected', true);
                $(`#previous_style_neck_${rowNum} option:contains("${rowStyleNeck}")`).prop('selected', true);
                $(`#previous_style_size_${rowNum} option:contains("${rowStyleSize}")`).prop('selected', true);

                document.getElementById(`previous_style_qty_${rowNum}`).value = parseInt(rowStyleQty);
                document.getElementById(`previous_style_remark_${rowNum}`).value = rowStyleRemark;

            }

        }

        // update row : update the style row with information in the DOM
        // ----------  -------------------------------------------------

        function update_row(btn) {

            // get row num
            let rowNum = btn.value;

            // get the style id value from the hidden field or map

            // let style_id = document.getElementById(`style_id_${rowNum}`).value;
            let style_id = styleIdHolderMap.get(`tr_${rowNum}`);

            // get the values from selectors

            let select_style_category = document.getElementById(`previous_style_category_${rowNum}`);
            let select_style_design = document.getElementById(`previous_style_design_${rowNum}`);
            let select_style_sleeve = document.getElementById(`previous_style_sleeve_${rowNum}`);
            let select_style_neck = document.getElementById(`previous_style_neck_${rowNum}`);
            let select_style_size = document.getElementById(`previous_style_size_${rowNum}`);

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

            let style_qty = $(`#previous_style_qty_${rowNum}`).val();
            let style_remark = $(`#previous_style_remark_${rowNum}`).val();

            // Get out of edit mode
            $(`#tr_${rowNum}`).removeClass("edit-mode");

            // replace the selector row with a standard row

            $(`#tr_${rowNum}`).html(
                '<td>  <input type="hidden" class="form-control previous-style-id" name="style_id_' + rowNum +
                ' " id="style_id_' + rowNum + ' " value= "' +
                style_id + '" />' +
                style_category + '<input class="previous-style-category" type="hidden" value="' +
                style_category +
                '" id="previous_style_category_' + rowNum + '" name="previous_style_category_' + rowNum +
                '" /></td>' +
                '<td>' + style_design + '<input class="previous-style-design" type="hidden" value="' + style_design +
                '" id="previous_style_design_' +
                rowNum +
                '" name="previous_style_design_' + rowNum + '" /></td>' +
                '<td>' + style_sleeve + '<input class="previous-style-sleeve" type="hidden" value="' + style_sleeve +
                '" id="previous_style_sleeve_' + rowNum + '" name="previous_style_sleeve_' + rowNum +
                '" /></td>' +
                '<td>' + style_neck + '<input class="previous-style-neck" type="hidden" value="' + style_neck +
                '" id="previous_style_neck_' + rowNum + '" name="previous_style_neck_' + rowNum +
                '" /></td>' +
                '<td>' + style_size +
                '<input class="previous-style-size" type="hidden" value="' +
                style_size + '" id="previous_style_size_' + rowNum + '" name="previous_style_size_' + rowNum +
                '" /></td>' +
                '<td>' + style_remark +
                '<input class="previous-style-remark" type="hidden" value="' +
                style_remark + '" id="previous_style_remark_' + rowNum + '" name="previous_style_remark_' + rowNum +
                '" /></td>' +
                '<td>' + style_qty +
                '<input class="previous-style-qty" type="hidden" value="' +
                style_qty + '" id="previous_style_qty_' + rowNum + '" name="previous_style_qty_' + rowNum +
                '" /></td>' +
                '<td> <div class = "d-flex justify-content-around" ><button type = "button" value = "' + rowNum +
                '" class = "btn btn-primary btn-sm" onclick = "edit_row(this)" > <span class="fas fa-edit" > </span></button><button type = "button" class = "btn btn-danger btn-sm" onclick = "delete_row(this)"> <span class = "fas fa-eraser"> </span></button> </div> </td > '
            );

            // sum up style qty when a row is updated, group em too
            sumUpStyleQty();

            groupStyles();

        }


        // sum up style qty : sums up the style qty, and put it in the styles total cell when called
        // ----------------   -----------------------------------------------------------------------

        function sumUpStyleQty() {

            let style_qtys = [];
            let sum = 0;

            // pushing in the previous style qtys
            $('.previous-style-qty').each(function() {
                style_qtys.push(parseInt($(this).val()));
            })

            // pushing in the new style qtys
            $('.style-qty').each(function() {
                style_qtys.push(parseInt($(this).val()));
            })

            style_qtys.forEach(element => {
                sum += element;
            });

            $('#total_styles_qty').text(sum);
        }

        // deactivate job ticket : deactivates the job ticket
        // ---------------------   -------------------------

        function deactivateJob(jobId) {

            Swal.fire({
                icon: 'question',
                title: 'Confirm job ticket cancellation ?',
                text: 'Cancelling a job ticket will deactivate all the department and style records along with it. This action is irreversible! Are you sure you want to continue?',
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

                    let form_data = new FormData();
                    form_data.append('job_id', jobId);

                    $.ajax({
                        url: "{{ url('deactivate_job') }}",
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
                                    window.location.href = "{{ route('job') }}";
                                });
                            } else if (response.status == 500) {
                                Swal.fire({
                                    icon: 'error',
                                    title: response.message,
                                    footer: response.error,
                                    showConfirmButton: 1
                                });
                            }
                        }
                    });

                }
            });

        }

        // group styles : summerizes/groupes the styles when adding them (supports both styles and previous styles here)
        // ------------  -----------------------------------------------

        function groupStyles() {
            const groupedStyles = {};

            // Iterate over styles
            $('.style-category').each(function(index) {
                const category = $(this).val();
                const design = $('.style-design:eq(' + index + ')').val();
                const sleeve = $('.style-sleeve:eq(' + index + ')').val();
                const neck = $('.style-neck:eq(' + index + ')').val();
                const qty = parseInt($('.style-qty:eq(' + index + ')').val()) || 0;

                // Create a unique key based on category, design, sleeve, and neck
                const key = `${category}-${design}-${sleeve}-${neck}`;

                console.log(key);
                console.log(qty);

                // Update the grouped styles
                if (groupedStyles[key]) {
                    groupedStyles[key].qty += qty;
                } else {
                    groupedStyles[key] = {
                        category: category,
                        design: design,
                        sleeve: sleeve,
                        neck: neck,
                        qty: qty
                    };
                }
            });


            // Iterate over previous styles
            $('.previous-style-category').each(function(index) {
                const category = $(this).val();
                const design = $('.previous-style-design:eq(' + index + ')').val();
                const sleeve = $('.previous-style-sleeve:eq(' + index + ')').val();
                const neck = $('.previous-style-neck:eq(' + index + ')').val();
                const qty = parseInt($('.previous-style-qty:eq(' + index + ')').val()) || 0;

                // Create a unique key based on category, design, sleeve, and neck
                const key = `${category}-${design}-${sleeve}-${neck}`;

                console.log(key);
                console.log(qty);

                // Update the grouped styles
                if (groupedStyles[key]) {
                    groupedStyles[key].qty += qty;
                } else {
                    groupedStyles[key] = {
                        category: category,
                        design: design,
                        sleeve: sleeve,
                        neck: neck,
                        qty: qty
                    };
                }
            });

            // For each entry in groupedStyles add it to the style group table
            updateStyleGroupTable(groupedStyles);

        }

        // update styles group table : uses the groupedStyles as a parameter and updates the table
        // -------------------------   -----------------------------------------------------------

        function updateStyleGroupTable(groupedStyles) {
            const styleGroupTableBody = $('#styles_group_table_body');
            styleGroupTableBody.empty(); // Clear existing rows

            let totalQty = 0;

            // Add a row for each group
            Object.values(groupedStyles).forEach(value => {
                const {
                    category,
                    design,
                    sleeve,
                    neck,
                    qty
                } = value;

                styleGroupTableBody.append(`
                    <tr>
                        <td>${category}</td>
                        <td>${design}</td>
                        <td>${sleeve}</td>
                        <td>${neck}</td>
                        <td>${qty}</td>
                    </tr>
                `);

                totalQty += qty; // Update total quantity
            });

            // Update the total quantity in the group table
            $('#total_group_styles_qty').text(totalQty);

            // Update the style row count
            $('#style_group_row_count').val(Object.keys(groupedStyles).length);
        }



        // update job ticket : passes the page data into the job controller
        // -----------------  ---------------------------------------------

        function updateJobTicket() {

            // job core details :

            let job_id = $('#job_id').val();
            let job_no = $('#job_no').val();
            let job_client = $('#job_client').val();
            let job_client_ref = $('#job_client_ref').val();
            let job_order_date = $('#job_order_date').val();
            let job_deliver_date = $('#job_deliver_date').val();
            let job_title = $('#job_title').val();
            let job_material_option = $('#job_material_option').val();
            let job_sleeve_details = $('#job_sleeve_details').val();
            let job_sleeve_remarks = $('#job_sleeve_remarks').val();
            let job_packing = $('input[name="job-packing"]:checked').val();
            let job_tshirt_details = $('#job_tshirt_details').val();
            let job_short_details = $('#job_short_details').val();
            let job_special_note = $('#job_special_note').val();
            let job_logo_and_number = $('#job_logo_and_number').val();
            let job_size_label_details = $('#job_size_label_details').val();
            let job_pattern = $('#job_pattern').val();
            let job_comment = $('#job_comment').val();

            // job update enablers :

            let job_style_update_check = $('#check_style_update').is(":checked") ? $('#check_style_update').val() : 0;
            let job_design_update_check = $('#check_design_update').is(":checked") ? $('#check_design_update').val() : 0;
            let job_document_update_check = $('#check_document_update').is(":checked") ? $('#check_document_update').val() :
                0;
            let job_department_update_check = $('#check_department_update').is(":checked") ? $('#check_department_update')
                .val() : 0;


            // job styles update :

            let style_row_count = $('#style_row_count').val();

            // previous styles :

            let initial_previous_style_ids = [];

            let previous_style_ids = [];
            let previous_style_categories = [];
            let previous_style_designs = [];
            let previous_style_sleeves = [];
            let previous_style_necks = [];
            let previous_style_sizes = [];
            let previous_style_qtys = [];
            let previous_style_remarks = [];

            // new styles :

            let style_categories = [];
            let style_designs = [];
            let style_sleeves = [];
            let style_necks = [];
            let style_sizes = [];
            let style_qtys = [];
            let style_remarks = [];

            // pushing elements (old styles)

            $('.initial-previous-style-id').each(function() {
                initial_previous_style_ids.push($(this).val());
            })

            $('.previous-style-id').each(function() {
                previous_style_ids.push($(this).val());
            })

            $('.previous-style-category').each(function() {
                previous_style_categories.push($(this).val());
            })

            $('.previous-style-design').each(function() {
                previous_style_designs.push($(this).val());
            })

            $('.previous-style-sleeve').each(function() {
                previous_style_sleeves.push($(this).val());
            })

            $('.previous-style-neck').each(function() {
                previous_style_necks.push($(this).val());
            })

            $('.previous-style-size').each(function() {
                previous_style_sizes.push($(this).val());
            })

            $('.previous-style-qty').each(function() {
                previous_style_qtys.push($(this).val());
            })

            $('.previous-style-remark').each(function() {
                previous_style_remarks.push($(this).val());
            })

            // pushing elements (new styles)

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

            $('.style-remark').each(function() {
                style_remarks.push($(this).val());
            })


            // job design image update :
            // :D

            let job_design_image_1_input = document.getElementById('job_design_image_1');
            let job_design_image_1 = job_design_image_1_input.files[0];

            let job_design_image_2_input = document.getElementById('job_design_image_2');
            let job_design_image_2 = job_design_image_2_input.files[0];

            // job reference document update :
            // :>

            let job_reference_document_input = document.getElementById('job_reference_document');
            let job_reference_document = job_reference_document_input.files[0];


            // job department update :
            // :3

            // previous departments
            let initial_previous_marked_department_ids = [];
            let previous_marked_department_ids = [];
            let previous_marked_departments = [];
            let previous_marked_start_dates = [];
            let previous_marked_end_dates = [];

            // departments
            let marked_departments = [];
            let marked_start_dates = [];
            let marked_end_dates = [];

            // previous department element push
            $('.initial-previous-marked-department-id').each(function() {
                initial_previous_marked_department_ids.push($(this).val());
            })

            $('.previous-marked-department-id').each(function() {
                previous_marked_department_ids.push($(this).val());
            })

            $('.previous-marked-department').each(function() {
                previous_marked_departments.push($(this).val());
            })

            $('.previous-marked-start-date').each(function() {
                previous_marked_start_dates.push($(this).val());
            })

            $('.previous-marked-end-date').each(function() {
                previous_marked_end_dates.push($(this).val());
            })

            // deparment element push
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
            } else if (job_material_option == null) {
                validationWarning("Material option not selected", "Please select your material option before submitting");
            } else if (job_sleeve_details == null) {
                validationWarning("Sleeve details not selected", "Please select your sleeve detail before submitting");
            } else if (job_style_update_check != 0 && $('.edit-mode').length != 0) {
                validationWarning("Styles are in edit mode",
                    "Please exit out of edit mode of the relevant style records before submitting");
            } else if (job_design_update_check != 0 && (job_design_image_1 == null && job_design_image_2 == null)) {
                validationWarning("Design images not selected",
                    "Please select at least one design image before submitting");
            } else if (job_packing == "") {
                validationWarning("Packing details empty", "Please enter your packing details before submitting");
            } else if (job_department_update_check != 0 && (marked_start_dates.includes("") || marked_end_dates.includes(
                    ""))) {
                validationWarning("Missing department dates",
                    "Please make sure you have set all your department start and end dates before submitting");
            } else if (job_department_update_check != 0 && (previous_marked_start_dates.includes("") ||
                    previous_marked_end_dates.includes(
                        ""))) {
                validationWarning("Missing previously marked department dates",
                    "Please make sure you have set all your previously marked department start and end dates before submitting"
                );
            } else {

                // if all is valid

                // prepare confirmation message text

                let stylesUpdateMessage = (job_style_update_check != 0) ? ", styles details " : "";
                let designUpdateMessage = (job_design_update_check != 0) ? ", design images " : "";
                let documentUpdateMessage = (job_document_update_check != 0) ? ", reference document " : "";
                let departmentUpdateMessage = (job_department_update_check != 0) ? ", department details " : "";

                let confirmationMessage = "This will update : core job info";

                confirmationMessage = confirmationMessage.concat(stylesUpdateMessage);
                confirmationMessage = confirmationMessage.concat(designUpdateMessage);
                confirmationMessage = confirmationMessage.concat(documentUpdateMessage);
                confirmationMessage = confirmationMessage.concat(departmentUpdateMessage);

                Swal.fire({
                    icon: 'question',
                    title: 'Confirm job ticket update ?',
                    text: confirmationMessage,
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

                        // job core :
                        form_data.append('job_id', job_id);
                        form_data.append('job_no', job_no);
                        form_data.append('job_client', job_client);
                        form_data.append('job_client_ref', job_client_ref);
                        form_data.append('job_order_date', job_order_date);
                        form_data.append('job_deliver_date', job_deliver_date);
                        form_data.append('job_title', job_title);
                        form_data.append('job_material_option', job_material_option);
                        form_data.append('job_sleeve_details', job_sleeve_details);
                        form_data.append('job_sleeve_remarks', job_sleeve_remarks);
                        form_data.append('job_size_label_details', job_size_label_details);
                        form_data.append('job_tshirt_details', job_tshirt_details);
                        form_data.append('job_short_details', job_short_details);
                        form_data.append('job_special_note', job_special_note);
                        form_data.append('job_logo_and_number', job_logo_and_number);
                        form_data.append('job_pattern', job_pattern);
                        form_data.append('job_comment', job_comment);
                        form_data.append('job_packing', job_packing);

                        // enablers :
                        form_data.append('job_style_update_check', job_style_update_check);
                        form_data.append('job_design_update_check', job_design_update_check);
                        form_data.append('job_document_update_check', job_document_update_check);
                        form_data.append('job_department_update_check', job_department_update_check);

                        // job styles :
                        form_data.append('initial_previous_style_ids', initial_previous_style_ids);
                        form_data.append('previous_style_ids', previous_style_ids);
                        form_data.append('previous_style_categories', previous_style_categories);
                        form_data.append('previous_style_designs', previous_style_designs);
                        form_data.append('previous_style_sleeves', previous_style_sleeves);
                        form_data.append('previous_style_necks', previous_style_necks);
                        form_data.append('previous_style_sizes', previous_style_sizes);
                        form_data.append('previous_style_qtys', previous_style_qtys);
                        form_data.append('previous_style_remarks', previous_style_remarks);

                        form_data.append('style_categories', style_categories);
                        form_data.append('style_designs', style_designs);
                        form_data.append('style_sleeves', style_sleeves);
                        form_data.append('style_necks', style_necks);
                        form_data.append('style_sizes', style_sizes);
                        form_data.append('style_qtys', style_qtys);
                        form_data.append('style_remarks', style_remarks);

                        // job design images :
                        form_data.append('job_design_image_1', job_design_image_1);
                        form_data.append('job_design_image_2', job_design_image_2);

                        // job reference document :
                        form_data.append('job_reference_document', job_reference_document);

                        // job departments :
                        form_data.append('initial_previous_marked_department_ids',
                            initial_previous_marked_department_ids);
                        form_data.append('previous_marked_department_ids', previous_marked_department_ids);
                        form_data.append('previous_marked_departments', previous_marked_departments);
                        form_data.append('previous_marked_start_dates', previous_marked_start_dates);
                        form_data.append('previous_marked_end_dates', previous_marked_end_dates);
                        form_data.append('marked_departments', marked_departments);
                        form_data.append('marked_start_dates', marked_start_dates);
                        form_data.append('marked_end_dates', marked_end_dates);

                        $.ajax({
                            url: "{{ url('update_job') }}",
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
