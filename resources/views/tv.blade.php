@section('content')
<HTML>

<HEAD>
    <TITLE>Orders</TITLE>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
    <meta name="viewport" content="width=device-width, initial-scale=1,
        shrink-to-fit=no">
    <link rel="stylesheet" href="resources.css.style.css">
    <link rel="stylesheet" href="resources.css.table.css">
    @vite(['resources/css/style.css'])
    @vite(['resources/css/table.css'])
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

</HEAD>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item ">
            <div class="body-style">
                <div>
                <div class="panel-body">
                    <table class="table  table-hover general-table"  style="border: solid 2px #ffffff;
                                    border-collapse: collapse;
                                    border-spacing: 30px;
                                    font: normal 25px Arial, sans-serif;" align="center" width="100%">
                                    <div>
                                    <h1 style="vertical-align : middle;text-align:center;color:#ffffff;">INC9000 Sewing Department</h1>
                                   </div>
                                <thead>
                                <tr>
                                	<th> #</th>
                                    <th>Job No</th>
                                    <th>Custome</th>
                                    <th>Client Order No</th>
                                    <th>Job Title</th>
                                    <th>Fabric</th>
                                    <th>Delivery Date</th>
                                    <th>T-shirt</th>
                                    <th>Short</th>
                                    <th>Skirt</th>
                                    <th>Bottom</th>
                                    <th>Total Qty</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                @foreach($tvdetals as $tv)                                    
                                        <tr>
                                            <td><a>{{$tv->id}}</a></td>
                                            <td><a>{{$tv->job_no}}</a></td>
                                            <td><a>{{$tv['client']['first_name']}}</a> </td>
                                            <td><a>{{$tv['client_reference_no']}}</a></td>
                                            <td><a>{{$tv->job_title}}</a></td>
                                            <td><a>{{$tv->material_option}}</a></td>
                                            <td><a>{{date('d-m-Y', strtotime($tv->deliver_date))}}</a></td>                                            
                                            @foreach ($tv->jobdetails as $style)
                                            @if ($style->design == 'T-shirt')
                                                <td>{{ $style->design }} : {{ $style->qty }}</td>
                                            @elseif ($style->design == 'Short')    
                                                <td>{{ $style->design }} : {{ $style->qty }}</td>
                                            @elseif ($style->design == 'Skirt')
                                                <td>{{ $style->design }} : {{ $style->qty }}</td>
                                            @elseif ($style->design == 'Bottom')
                                                <td>{{ $style->design }} : {{ $style->qty }}</td>
                                            @else
                                                <td>0</td>
                                            @endif
                                            @endforeach                                             
                                            <td><a>{{$tv->qty}}</a></td>
                                            <td><span class="btn btn-success">Ongoin</span></td>
                                            
                                        </tr>                                    
                                @endforeach

                                </tbody>
                            </table>
                        </div>                         
                    
                </div>
            </div>
        </div>

        <!-- second slide -->

        <div class="carousel-item active">
            <div class="body-style2">
                <div>
                    <h1 style="vertical-align :
                  middle;text-align:center;color:#000000;">Sewing Department</h1>
                    <h1 style="vertical-align :
                  middle;text-align:center;color:#000000;">Job No - {{$activejob[0]->job_no}}
                        ({{$activejob[0]->job_title}})</h1>
                </div>
                <div class="row">
                    <div class="column">
                        <div style="width: 500px;margin: 100px;; border-style: do">
                            <table class="zui-table">
                                <tr>
                                    <td>
                                        <h4 class="fo-colour">JOB NUMBER</h4>
                                    </td>
                                    <td>
                                        <h4 class="fo-colour">{{$activejob[0]->job_no}}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="fo-colour">CUSTOMER</h4>
                                    </td>
                                    <td>
                                        <h4 class="fo-colour">{{$activejob[0]['client']->first_name}}
                                            {{$activejob[0]['client']->last_name}}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="fo-colour">DELIVERY DATE</h4>
                                    </td>
                                    <td>
                                        <h4 class="fo-colour">{{$activejob[0]->deliver_date}}</h4>
                                    </td>
                                </tr>
                                <!-- <tr>
                                        <td>
                                            <h4 class="fo-colour2">NECK TYPE</h4>
                                        </td>
                                        <td bgcolor="yellow">
                                            <h4 style="color:rgb(255, 1, 1);">{{$activejob[0]->job_no}}</h4>
                                        </td>
                                    </tr> -->
                                <tr>
                                    <td>
                                        <h4 class="fo-colour2">MATERIAL OPTION</h4>
                                    </td>
                                    <td>
                                        <h4 class="fo-colour2">{{$activejob[0]->material_option}}</h4>
                                    </td>
                                </tr>
                                <!-- <tr>
                                        <td>
                                            <h4 class="fo-colour2">SLEEVE DETAILS</h4>
                                        </td>
                                        <td>
                                            <h4 class="fo-colour2">{{$activejob[0]->job_no}}</h4>
                                        </td>
                                    </tr> -->
                                <div style="width: 500px;margin: 10px;">
                            </table>

                        </div>
                    </div>

                    <div class="column">
                        <div class="row">
                            <div class="column">
                                <div style="margin-top:100px;">
                                    <img src="{{ url('uploads/jobs')}}/{{$activejob[0]->job_design_image_1}}"
                                        style="width:350px;height:250px;">
                                </div>

                                <div style="width: 500px; border-style: do">
                                    <table class="zui-table">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <h4 class="fo-colour">SLEVE</h4>
                                                </td>
                                                <td>
                                                    <h4 class="fo-colour">SIZE</h4>
                                                </td>
                                                <td>
                                                    <h4 class="fo-colour">QTY</h4>
                                                </td>
                                            </tr>
                                        </thead>
                                        @foreach($activejob[0]['jobdetails'] as $jbd)
                                        <tr>
                                            <td>
                                                <h4 class="fo-colour">{{$jbd->sleeve}} ({{$jbd->category}})</h4>
                                            </td>
                                            <td>
                                                <h4 class="fo-colour">{{$jbd->size}}</h4>
                                            </td>
                                            <td>
                                                <h4 class="fo-colour">{{$jbd->qty}}</h4>
                                            </td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="2">
                                                <h4 class="fo-colour2">TOTAL</h4>
                                            </td>
                                            <td>
                                                <h4 class="fo-colour">9</h4>
                                            </td>
                                            <!-- <td bgcolor="yellow"><h4 style="color:rgb(255, 1, 1);">ROUND NECK</h4></td> -->
                                        </tr>
                                        <div style="width: 40px;margin: 10px;">
                                    </table>
                                    
                                </div>


                            </div>
                            <div class="column">
                                <div style="margin-top:100px;">
                                    <img src="{{ url('uploads/jobs')}}/{{$activejob[0]->job_design_image_2}}"
                                        style="width:350px;height:250px;">
                                </div>

                                <div style="width: 500px; border-style: do">
                                    <!-- tabale3 -->
                                </div>
                            </div>




                        </div>
                    </div>
                    <div>

                    </div>
                </div>

                <div class="row">

                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

</HTML>