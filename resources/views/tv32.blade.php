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

<body class="sticky-header" onload="setTotal()">

    <section>

        <!-- page heading start-->
        <div class="page-heading" align="center">
            <h3>
                <span style="color:#FFF;">Cutting Department</span>
            </h3>
            <ul class="breadcrumb">

                <li class="active"> Job Titles : ({{ $activejob[0]->job_title }}) </li>
                <li style="color:#FFF;">{{ $activejob[0]->job_no }} </li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">


            <div class="row">
                <div class="col-sm-8">
                    <section class="panel">
                        <header class="panel-heading">

                            Custome Name : {{ $activejob[0]['client']->first_name }}
                            {{ $activejob[0]['client']->last_name }}

                        </header>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td style="width:20%"><strong>Delivery Date : </strong></td>
                                    <td style="width:20%">{{ date('d-m-Y', strtotime($activejob[0]->deliver_date)) }}
                                    </td>
                                    <td style="width:25%"><strong>Material Option : </strong></td>
                                    <td style="width:35%;text-align:left">{{ $activejob[0]->material_option }}</td>
                                </tr>

                            </table>
                            <table class="table  table-hover general-table">
                                <thead>
                                    <tr>

                                        <th> #</th>
                                        <th>Category</th>
                                        <th>Design</th>
                                        <th>Type</th>
                                        <th>3xs</th>
                                        <th>2xs</th>
                                        <th>xs</th>
                                        <th>s</th>
                                        <th>M</th>
                                        <th>L</th>
                                        <th>xl</th>
                                        <th>2xl</th>
                                        <th>3xl</th>
                                        <th>4xl</th>
                                        <th>5xl</th>
                                        <th>6xl</th>

                                        <th>Total Qty</th>

                                    </tr>
                                </thead>

                                @php
                                    $recordId = 1;
                                @endphp

                                <tbody>
                                    @if (!empty($activejob[0]['jobdetails']))
                                        @foreach ($activejob[0]['jobdetails'] as $jbd)
                                            <tr>

                                                <td>{{ $recordId }}</td>

                                                @php
                                                    $recordId = $recordId + 1;
                                                @endphp

                                                <td>{{ $jbd->category }}</td>
                                                <td>{{ $jbd->design }}</td>
                                                <td>{{ $jbd->sleeve }}</td>
                                                @foreach (['3XS', '2XS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL', '5XL', '6XL'] as $size)
                                                    @if ($jbd->size == $size)
                                                        <td>{{ $jbd->qty }}</td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                @endforeach
                                                <!-- total -->
                                                <td class="style-qty">{{ $jbd->qty }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    <tr>
                                        <td></td>
                                        <td colspan="3">Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td id="style-total-qty">0</td>
                                    </tr>



                                </tbody>
                            </table>

                            <table class="table">
                                <tr>
                                    <td style="width:20%"><strong>Special Note : </strong></td>
                                    <td style="width:80%">{{ $activejob[0]->comment }}</td>
                                </tr>
                                <tr>
                                    <td style="width:15%"><strong>Packing : </strong></td>
                                    <td style="width:85%;text-align:left">{{ $activejob[0]->packing }}</td>
                                </tr>

                            </table>
                        </div>
                    </section>
                </div>

                <div class="col-sm-4">
                    <section class="panel">
                        <header class="panel-heading">


                        </header>
                        <div class="panel-body" align="center">
                            <img src="{{ url('uploads/jobs') }}/{{ $activejob[0]->job_design_image_2 }}"
                                width="500px" height="435px">
                        </div>
                    </section>
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
    {{-- <script src="js/jquery-1.10.2.min.js"></script> --}}

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/modernizr.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>

    <!--common scripts for all pages-->
    <script src="js/scripts.js"></script>

    <!-- custom scripts -->
    <script>
        // set the total qty
        function setTotal() {

            var sum = 0;
            $(".style-qty").each(function() {
                sum += parseFloat($(this).text());
            });

            $('#style-total-qty').text(sum);
        }
    </script>

</body>

</html>
