@extends('layouts.app')

@section('content')
    {{-- <div class="container-fluid p-4">
        <h1 class="text-black-50">You are logged in!</h1>
    </div> --}}
<div class="py-3" > </div>
    <section class="content">
        {{-- <br> <br> <br> --}}

        <div class="container-fluid">
            {{-- job view table card --}}
            <div class="card shadow-lg mb-3" style=" border-radius: 20px;">
                <div class="card-header m-3 mb-0" style="background-color: transparent;">
                    <div class="d-flex justify-content-between">
                        <h5>Orders</h5>

                    </div>
                </div>

                <div class="card-body ps-4 pe-4 pb-4">

                    <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <div class="row justify-content-md-center">
                            <div class="col-lg-5 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{$ongoing}}</h3>

                                        <p>Ongoing</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <!-- <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a> -->
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-5 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $pending}}</h3>

                                        <p>Pending Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <!-- <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a> -->
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                    <div class="row justify-content-md-center"> 
                            <div class="col-lg-5 col-6">
                                <!-- small box -->
                                
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$complete}}</h3>

                                        <p>Complete Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <!-- <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a> -->
                                </div>
                                
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-5 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{$waiting}}</h3>

                                        <p>Hold</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <!-- <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a> -->
                                </div>
                            </div>
                        </div> 
                        </div>

                    </div>

                </div>

            </div>

            <div class="container-fluid" style="width: 100%">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card shadow-lg mb-3"  style=" border-radius: 20px;">
                      <div class="card-header ">
                        <h3 class="card-title" style="font-weight: bold;">Today Ongoin Job Counts</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Department</th>
                              <th>Progress</th>
                              <th style="width: 60px">Count</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1.</td>
                              <td>Design</td>
                              <td>
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-danger" style="{{$designPercentage}}"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-danger">{{$designCount}}</span></td>
                            </tr>
                            <tr>
                              <td>2.</td>
                              <td>Printing</td>
                              <td>
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-warning" style="{{$printingPercentage}}"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-warning">{{$printingCount}}</span></td>
                            </tr>
                            <tr>
                              <td>3.</td>
                              <td>Pressing</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar bg-primary" style="{{$pressingPercentage}}}}"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-primary">{{$pressingCount}}</span></td>
                            </tr>
                            <tr>
                              <td>4.</td>
                              <td>Sewing</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar bg-success" style="{{$sewingPercentage}}"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-success">{{$sewingCount}}</span></td>
                            </tr>
                            <tr>
                              <td>5.</td>
                              <td>Cutting</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar bg-info" style="{{$cuttingPercentage}}"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-info">{{$cuttingCount}}</span></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                      
                    </div>

        </div>
 
    </section>
</div>



    
    
@endsection


