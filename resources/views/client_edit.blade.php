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
          <h3 class="card-title">Update Client</h3>
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

          <form action="{{ route('clientedit', $client->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" placeholder="Enter your first name" name="first_name" id="" value="{{$client->first_name}}">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" placeholder="Enter your last name" name="last_name" id="" value="{{$client->last_name}}">
                </div>
              </div>
              <div class="col-sm-3">
              <div class="form-group">
                <label>Email</label>
                <input type="text"  class="form-control" name="email" id="email" placeholder="Enter your email address" value="{{$client->email}}">
              </div>
            </div>
            </div>
           
            <div class="row">
            <label>Add two contact number</label>
            <div class="col-sm-3">
              <div class="form-group">                
                <label>Contact one</label>
                <input type="tel" name="phone_1" id="phone_number" placeholder="Enter first phone number" value="{{$client->phone_1}}">
                </div>
            </div>
                <div class="col-sm-3">
                <div class="form-group">
                <label>Contact two</label>
                <input type="tel" name="phone_2" id="phone_number" placeholder="Enter second phone number" value="{{$client->phone_2}}">
              </div>
            </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Enter your address" name="address" id="item_no" value="{{$client->address}}">
              </div>
            </div>            
            <div class="form-group">
              <input type="reset" name="reset" value="Reset" class="btn btn-dark">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        </form>
@endsection