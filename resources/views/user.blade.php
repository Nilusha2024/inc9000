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
                    <h5>Register user</h5>
                </div>
                <div class="card-body ps-4 pe-4 pb-4">

                    {{-- form start --}}
                    <form method="POST" action="{{ route('store_user') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-user"></span></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('register_name') is-invalid @enderror"
                                    id="register_name" name="register_name" placeholder="Name"
                                    value="{{ old('register_name') }}">
                                <label for="register_name">Name</label>
                                @error('register_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;"><span
                                    class="fas fa-user-tie"></span></span>

                            <div class="form-floating">
                                <select
                                    class="form-select form-select-transparent @error('register_department') is-invalid @enderror"
                                    style="appearance:none;" name="register_department" id="register_department">
                                    <option value="" disabled selected hidden>Select your department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('register_department') == $department->id ? 'selected' : '' }}>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="register_department">Department</label>
                                @error('register_department')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror

                            </div>


                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;"><span
                                    class="fas fa-address-book"></span></span>
                            <div class="form-floating">

                                <select
                                    class="form-select form-select-transparent @error('register_role') is-invalid @enderror"
                                    style="appearance:none;" name="register_role" id="register_role">
                                    <option value="" disabled selected hidden>Select your role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('register_role') == $role->id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="register_role">Role</label>
                                @error('register_role')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-address-card"></span></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('register_username') is-invalid @enderror"
                                    id="register_username" name="register_username" placeholder="Username"
                                    value="{{ old('register_username') }}">
                                <label for="register_username">Username</label>
                                @error('register_username')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-envelope"></span></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('register_email') is-invalid @enderror"
                                    id="register_email" name="register_email" placeholder="Email"
                                    value="{{ old('register_email') }}">
                                <label for="register_email">Email</label>
                                @error('register_email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-key"></span></span>
                            <div class="form-floating">
                                <input type="password" class="form-control @error('register_password') is-invalid @enderror"
                                    id="register_password" name="register_password" placeholder="Password"
                                    value="{{ old('register_password') }}">
                                <label for="register_password">Password</label>
                                @error('register_password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color: transparent;">
                                <span class="fas fa-key"></span></span>
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control @error('register_password_confirmation') is-invalid @enderror"
                                    id="register_password_confirmation" name="register_password_confirmation"
                                    placeholder="Confirm password" value="{{ old('register_password_confirmation') }}">
                                <label for="register_password_confirmation">Confirm password</label>
                                @error('register_password_confirmation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse">
                            <div class="d-flex">
                                <button type="submit" class="pt-2 pb-2 btn btn-dark btn-block"
                                    style="font-weight:bold; letter-spacing:1px;">REGISTER</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


            {{-- user view table card --}}
            <div class="card shadow-lg mt-4 mb-3" style=" border-radius: 25px;">
                <div class="card-header m-3 mb-0" style="background-color: transparent;">
                    <h5>User list</h5>
                </div>
                <div class="card-body ps-4 pe-4 pb-4">

                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user['department']['department_name'] }}</td>
                                    <td>{{ $user['role']['role_name'] }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="row">
                                            {{-- to update --}}
                                            <div class="col">
                                                <a href="{{ route('edit_user', ['user' => $user]) }}"
                                                    class="btn btn-default btn-sm btn-flat" style="width: 100%">
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="col">
                                                {{-- delete --}}
                                                <form method="POST" action="{{ route('delete_user') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" class="form-control" name="user_id"
                                                        id="user_id" value="{{ $user->id }}">
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this user ?')"
                                                        class="btn btn-danger btn-sm btn-flat" style="width: 100%">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section>
@endsection
