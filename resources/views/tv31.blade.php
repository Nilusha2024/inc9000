<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>Basic Table</title>

  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">


        <!--body wrapper start-->
        <div class="wrapper">
           
           
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            General Table
                       
                        </header>
                        <div class="panel-body">
                            <table class="table  table-hover general-table">
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
                                @php
                                    $recordId = 1;
                                @endphp
                                <tbody>
                                @foreach($tvdetals as $tv)                                    
                                        <tr>
                                            <td><a>{{$recordId}}</a></td>
                                            @php
                                                $recordId = $recordId + 1;
                                            @endphp
                                            <td><a>{{$tv->job_no}}</a></td>
                                            <td><a>{{$tv['client']['first_name']}}</a> </td>
                                            <td><a>{{$tv['client_reference_no']}}</a></td>
                                            <td><a>{{$tv->job_title}}</a></td>
                                            <td><a>{{$tv->material_option}}</a></td>
                                            <td><a>{{date('d-m-Y', strtotime($tv->deliver_date))}}</a></td>                                            
                                            
                                           

                                        @foreach (['T-shirt', 'Short', 'Skirt', 'Bottom'] as $design)
                                            @php
                                                $style = $tv->jobdetails->firstWhere('design', $design);
                                            @endphp
                                            @if ($style)
                                                <td>{{ $style->qty }}</td>
                                            @else
                                                <td> 0 </td>
                                            @endif
                                         @endforeach

                                            
                                            

                                            <td><a>{{$tv->qty}}</a></td>
                                            <td>
                                            @if($tv->job_status == 0)
                                            <span class="label label-info label-mini">Pending</span>
                                            @elseif ($tv->job_status == 1)
                                            <span class="label label-success label-mini">Completed</span>
                                            @elseif ($tv->job_status == 2)
                                            <span class="label label-warning label-mini">Ongoin</span>
                                            @elseif ($tv->job_status == 3)
                                            <span class="label label-danger label-mini">Not Redy</span>
                                            @endif
                                            </td>
                                            
                                        </tr>                                    
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    
                </div>
            </div>
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer>
            2023 &copy; Rabbit Solutions PVT Ltd
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

</body>
</html>
