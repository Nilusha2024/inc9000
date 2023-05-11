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
          <h3 class="card-title">Add Department</h3>
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

          <form action="{{ route('departmentstore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Department Name</label>
                  <input type="text" class="form-control" placeholder="Enter ..." name="departmentName" id="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <input type="reset" name="reset" value="Reset" class="btn btn-dark">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>

        <!-- /.card-body -->
      </div>
    </section>

  </div>
</div>
@endsection