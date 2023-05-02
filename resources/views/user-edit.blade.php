@extends('layouts.app')

@section('content')
    {{-- header section --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-black-50">Manage users</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- content section --}}
    <section class="content">
        <div class="container-fluid">
            {{-- user registration card --}}
            <div class="card shadow-lg mb-3" style=" border-radius: 25px;">
                <div class="card-header m-3 mb-0" style="background-color: transparent;">
                    <h5>Edit user</h5>
                </div>
                <div class="card-body ps-4 pe-4 pb-4">

                    {{-- success alert --}}
                    @if ($message = Session::get('success'))
                        <div class="alert alert-block bg-gr-green">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    {{-- form start --}}
                    <form method="POST" action="{{ route('update_user') }}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- hidden field to store id --}}
                        <input type="hidden" class="form-control" name="user_id" id="user_id"
                            value="{{ $user->id }}">

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-user"></span></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('update_name') is-invalid @enderror"
                                    id="update_name" name="update_name" placeholder="Name" value="{{ $user->name }}">
                                <label for="update_name">New name</label>
                                @error('update_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;"><span
                                    class="fas fa-user-tie"></span></span>
                            <div class="form-floating">

                                <select
                                    class="form-select form-select-transparent @error('update_department') is-invalid @enderror"
                                    style="appearance:none;" name="update_department" id="update_department">
                                    <option disabled selected hidden>Select your new
                                        department
                                    </option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('update_department') == $department->id ? 'selected' : '' }}>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="update_department">New department</label>
                                @error('update_department')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;"><span
                                    class="fas fa-address-book"></span></span>
                            <div class="form-floating">

                                <select
                                    class="form-select form-select-transparent @error('update_role') is-invalid @enderror"
                                    style="appearance:none;" name="update_role" id="update_role">
                                    <option value="" disabled selected hidden>Select your role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('update_role') == $role->id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="update_role">Role</label>
                                @error('update_role')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-address-card"></span></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('update_username') is-invalid @enderror"
                                    id="update_username" name="update_username" placeholder="Username"
                                    value="{{ $user->username }}">
                                <label for="update_username">New username</label>
                                @error('update_username')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-envelope"></span></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('update_email') is-invalid @enderror"
                                    id="update_email" name="update_email" placeholder="Email" value="{{ $user->email }}">
                                <label for="update_email">New email</label>
                                @error('update_email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse">
                            <div class="d-flex">
                                <button type="submit" class="pt-2 pb-2 btn btn-dark btn-block"
                                    style="font-weight:bold; letter-spacing:1px;">UPDATE</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementsByName('update_department')[0].value = "{{ $user->department_id }}";
        document.getElementsByName('update_role')[0].value = "{{ $user->role_id }}";
    </script>
@endsection
