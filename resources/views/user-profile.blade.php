@extends('layouts.app')

@section('content')
    {{-- header section --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-black-50">Your user profile</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- content section --}}
    <section class="content">
        <div class="container-fluid">
            {{-- user credentials card --}}
            <div class="card shadow-lg mb-3" style=" border-radius: 25px;">
                <div class="card-header m-3 mb-0" style="background-color: transparent;">
                    <h5>Edit credentials</h5>
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
                    <form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- hidden field to store id --}}
                        <input type="hidden" class="form-control" name="user_id" id="user_id"
                            value="{{ $user->id }}">

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-address-card"></span></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Username" value="{{ $user->username }}">
                                <label for="username">Username</label>
                                @error('username')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-key"></span></span>
                            <div class="form-floating">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" placeholder="Password"
                                    value="{{ old('new_password') }}">
                                <label for="current_password">Current password</label>
                                @error('current_password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-key"></span></span>
                            <div class="form-floating">
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password" placeholder="Password"
                                    value="{{ old('new_password') }}">
                                <label for="new_password">New password</label>
                                @error('new_password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-key"></span></span>
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    id="new_password_confirmation" name="new_password_confirmation"
                                    placeholder="Confirm password" value="{{ old('new_password_confirmation') }}">
                                <label for="new_password_confirmation">Confirm new password</label>
                                @error('new_password_confirmation')
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
        document.getElementsByName('department')[0].value = "{{ $user->department_id }}";
        document.getElementsByName('role')[0].value = "{{ $user->role_id }}";
    </script>
@endsection
