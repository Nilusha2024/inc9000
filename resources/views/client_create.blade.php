@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div style="min-height: 1345.31px;">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <!-- general form elements disabled -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add Client</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if (count($errors) > 0)
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

          <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" placeholder="Enter your first name" name="first_name"
                    id="item_no">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" placeholder="Enter your last name" name="last_name"
                    id="item_no">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" id="email"
                    placeholder="Enter your email address">
                </div>
              </div>
            </div>

            <div class="row">
              <label>Add two contact number</label>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Contact one</label>
                  <input type="tel" name="phone_1" id="phone_number" placeholder="Enter first phone number">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Contact two</label>
                  <input type="tel" name="phone_2" id="phone_number" placeholder="Enter second phone number">
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Enter your address" name="address" id="item_no">
              </div>
            </div>
            <div class="form-group">
              <input type="reset" name="reset" value="Reset" class="btn btn-dark">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
        <!-- view tabale -->
        <div class="row">
          <div class="col-sm-12 form-grop">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Client List</h3>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered" id="dataTabl">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Contact one</th>
                      <th>Contact two</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($clientdetals as $client)
                    <tr>
                      <td><a>{{$client->first_name}}</a></td>
                      <td>{{$client->last_name}}</td>
                      <td>{{$client->email}}</td>
                      <td>{{$client->phone_1}}</td>
                      <td>{{$client->phone_2}}</td>
                      <td>{{$client->address}}</td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <a href="{{ route('clientedit',$client->id) }}" class="btn btn-default btn-sm btn-flat"
                              style="width: 100%">Edit</a>
                          </div>
                          {{-- delete --}}
                          <div class="col">
                            <form method="POST" action="{{ route('delete_client', $client->id) }}">
                              @csrf
                              @method('PUT')
                              <input type="hidden" class="form-control" name="status" id="" value="0">
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
        </div>


      </div>
    </section>

  </div>
</div>
@endsection