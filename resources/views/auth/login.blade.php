<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - Login</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{-- Font awesome link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    {{-- bootstrap cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    {{-- custom styles --}}
    @vite(['resources/css/auth.css'])

</head>

<body>

    {{-- split in two grid --}}
    <div class="container-fluid p-3">
        <div class="row align-items-center justify-content-center" style="min-height: 95vh;">

            {{-- left --}}
            <div class="col d-flex flex-column">
                <div class="row justify-content-center">
                    <img src="{{ URL::asset('image/threads-&-needles.png') }}" class="w-50" alt="Your Image">
                </div>
                <div class="row m-5">
                    <h1 class="massive-header text-center">inc9000</h1>
                </div>
            </div>

            {{-- right --}}
            <div class="col d-flex justify-content-center">

                {{-- card --}}
                <div class="card shadow-lg" style="width: 75%; border-radius: 25px;">
                    <div class="card-header m-3 mb-0" style="background-color: transparent;">
                        <div class="row d-flex align-items-center justify-content-center text-center">
                            <div class="col">
                                <h1>Login</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-5">

                        {{-- login form --}}
                        <form method="post" action="{{ url('/login') }}">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}"
                                    placeholder="Enter username">
                                <label for="username" style="font-weight: bold">Username</label>
                                @error('username')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-floating mb-2">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Enter password">
                                <label for="password" style="font-weight: bold">Password</label>
                                @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex flex-row-reverse mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="show_password_check">
                                    <label class="form-check-label" for="show_password_check" style="font-weight: 600;">
                                        Show password
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="pt-3 pb-3 ps-5 pe-5 mt-3 btn btn-dark btn-block"
                                    style="font-weight:bold; letter-spacing:1px;">LOGIN</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- jQuery import --}}
    <script src="plugins/jquery/jquery.min.js"></script>

    {{-- custom script --}}
    <script>
        $('#show_password_check').on('change', function() {
            $('#password').prop('type', $('#show_password_check').prop('checked') == true ?
                "text" :
                "password");
        });
    </script>

</body>

</html>
