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


                            {{-- job client ref --}}
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control @error('job_client_ref') is-invalid @enderror"
                                        id="job_client_ref" name="job_client_ref" value="{{ $job->client_reference_no }}"
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
                        <div class="row mb-4">

                            {{-- job material option --}}
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @error('job_material_option') is-invalid @enderror"
                                        id="job_material_option" name="job_material_option"
                                        value="{{ $job->material_option }}" placeholder="Enter material option">
                                    <label for="job_material_option" style="font-weight: bold">Material option</label>
                                    @error('job_material_option')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="card border-0 shadow-none">
                            <div class="card-header" style="background-color: transparent;">
                                <h5>Design references</h5>
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
                                                        width="100%" height="100%" style="border-radius: 20px;"
                                                        alt="design image">
                                                @else
                                                    <img id="job_design_image_view"
                                                        src={{ asset('image/design-empty-placeholder.png') }}
                                                        width="100%" height="100%" style="border-radius: 20px;"
                                                        alt="design image">
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
                                                        width="100%" height="100%" style="border-radius: 20px;"
                                                        alt="design image">
                                                @else
                                                    <img id="job_design_image_view"
                                                        src={{ asset('image/design-empty-placeholder.png') }}
                                                        width="100%" height="100%" style="border-radius: 20px;"
                                                        alt="design image">
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                </div>



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
                                                id="job_comment" name="job_comment" value="{{ $job->comment }}"
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
                                                id="job_packing" name="job_packing" value="{{ $job->packing }}"
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


                    <div class="d-flex flex-row-reverse mt-1 mb-2 me-2">
                        <button type="submit" class="btn btn-primary border-0 m-1 text-bold bg-gr-blue">Update
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
        document.getElementsByName('job_client')[0].value = "{{ $job->client_id }}";

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
