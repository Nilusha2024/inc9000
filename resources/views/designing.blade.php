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

    <style>
        .slider-container {

            width: 100%;

            height: 100%;

            /* overflow: hidden; */

            position: center;

        }

        .slide {

            width: 100%;

            height: 100%;

            justify-content: center;

            align-items: center;

            /* font-size: 20px; */

        }

        .label-info{
            background-color:#003d7c;
        }

        .label-danger{
            background-color:#ae0000;
        }

        .label-warning{
            background-color:#c7a42a;
        }


        .greeting_tag {
            font-size: 3em;
            color: limegreen;
            text-align: center;
            padding:8px;
        }

    </style>

</head>

<body class="sticky-header" onload="setTotal()" style="font-size:24px;background-color:#000;color:#fff;text-transform:uppercase;">


    <div class="slider-container">
   

        {{-- slide 1 --}}

        <div class="slide">

            <section>

                <!--body wrapper start-->

                <div class="wrapper">

                    <div class="row">

                        <div class="col-sm-12">

                            <section class="panel" style="background-color:#000">
                            <?php
                                // I'm India so my timezone is Asia/Calcutta
                                date_default_timezone_set('Asia/Colombo');

                                // 24-hour format of an hour without leading zeros (0 through 23)
                                $Hour = date('G');

                                if ( $Hour >= 5 && $Hour <= 11 ) {
                                    $greeting =  "Good Morning";
                                } else if ( $Hour >= 12 && $Hour <= 18 ) {
                                    $greeting = "Good Afternoon";
                                } else if ( $Hour >= 19 || $Hour <= 4 ) {
                                    $greeting = "Good Evening";
                                }
                                ?>
                               
                                <header class="panel-heading" style="text-align:right">
                                <div class="row">
                                <div class="col-md-1" ><span id='ct' ></span></div>    
                                <div class="col-md-8" >
                                    <marquee width="100%" class="greeting_tag" direction="right" height="100%">
                                        {{$greeting}} Team!
                                    </marquee>
                                </div>
                                <div style="float:right;padding-top:10px" class="col-md-3">
                                    <span style="color:#FFF;background-color:#AE0000;padding:10px; border-radius: 25px 0px 0px 25px;margin-bottom:10px;font-size:26px;">
                                        Cutting Department
                                    </span>
                                </div>
                                </div>
                                </header>

                                <div class="panel-body">

                                    <table class="table general-table" style="border-left:10px solid #af600b; border-bottom:10px solid #af600b; border-right:10px solid #af600b">

                                        <thead>

                                            <tr style="background-color:#af600b;font-size:22px">

                                                <th style="text-align:center"> #</th>

                                                <th>Job No</th>

                                                <th>Customer</th>

                                                <th>Order No</th>

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
                                            @foreach ($tvdetals as $tv)
                                                <tr>
                                                    <td style="background-color:#c28206;text-align:center;color:#000;border-bottom:1px solid #fff">{{ $recordId }}</td>
                                                    @php
                                                        $recordId = $recordId + 1;
                                                    @endphp
                                                    <td>{{ $tv->job_no }}</td>
                                                    <td>{{ $tv['client']['first_name'] }} </td>
                                                    <td>{{ $tv['client_reference_no'] }}</td>
                                                    <td>{{ $tv->job_title }}</td>
                                                    <td>{{ $tv->material_option }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($tv->deliver_date)) }}</td>



                                                    @foreach (['T-shirt', 'Short', 'Skirt', 'Bottom'] as $design)
                                                        @php
                                                            $style = $tv->jobdetails->firstWhere('design', $design);
                                                        @endphp
                                                        @if ($style)
                                                            <td style="background-color:#191919;text-align:center">{{ $style->qty }}</td>
                                                        @else
                                                            <td style="background-color:#191919;text-align:center"> 0 </td>
                                                        @endif
                                                    @endforeach




                                                    <td style="background-color:#191919;text-align:center">{{ $tv->qty }}</td>
                                                    <td style="background-color:#191919;text-align:center">
                                                        @if ($tv->job_status == 0)
                                                            <span class="label label-info label-mini">Pending</span>
                                                        @elseif ($tv->job_status == 1)
                                                            <span
                                                                class="label label-success label-mini">Completed</span>
                                                        @elseif ($tv->job_status == 2)
                                                            <span class="label label-warning label-mini">Ongoing</span>
                                                        @elseif ($tv->job_status == 3)
                                                            <span class="label label-danger label-mini">Hold</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            </section>

                        </div>

                    </div>

                </div>

               

        </div>

        <!-- main content end-->

        </section>

    </div>

    {{-- slide 1 end --}}

    {{-- slide 2 --}}

<div class="slide" style="background-color:#000;color:#FFF;font-size:24px">

    <section>

        <!-- page heading start-->
        <div class="page-heading" align="center">
            <div class="col-sm-8" style="padding-top:10px">
                <div style="border-radius: 25px 25px 25px 25px;padding:10px;color:#FFF;background-color:#006A00; ">
                    <ul class="breadcrumb">

                        <li>Job Titles : {{ $activejob[0]->job_title }} </li>
                        <li style="color:#FFF;">{{ $activejob[0]->job_no }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4" align="right" style="padding-top:10px;margin-bottom:10px">
                <h4>
                    <span
                        style="color:#FFF;background-color:#AE0000;padding:10px; border-radius: 25px 0px 25px 0px;font-size:26px;margin-bottom:20px;border-bottom:0px solid #ddd;">Cutting
                        Department</span>
                </h4>
            </div>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        @if(sizeof($activejob) > 0)
        <div class="wrapper"><br>

            <div class="row" style="border: 1px solid white;margin-top:20px">
                <div class="col-sm-8">
                    <section class="panel" style="background-color:#000;color:#FFF;">
                        <header class="panel-heading">
                        
                            <div align="center" style="color:#FFF;border-bottom:0px solid #ddd;padding:10px;font-size:26px"> Customer
                                Name : {{ $activejob[0]['client']->first_name }}
                                {{ $activejob[0]['client']->last_name }}
                                <div style="float:right;font-size:22px">
                                    @if ($activejob[0]->job_status == 0)
                                        <span class="label label-info label-mini">Pending</span>
                                    @elseif ($activejob[0]->job_status == 1)
                                        <span class="label label-success label-mini">Completed</span>
                                    @elseif ($activejob[0]->job_status == 2)
                                        <span class="label label-warning label-mini">Ongoing</span>
                                    @elseif ($activejob[0]->job_status == 3)
                                        <span class="label label-danger label-mini">Hold</span>
                                    @endif
                                </div>
                            </div>                                    
                        </header>
                        <div class="panel-body" style="padding-top:0px;">
                            <table class="table" style="background-color:#000;color:#FFF;">
                                <tr style="border-bottom:1px solid #ddd;border-top:1px solid #ddd;">
                                    <td style="width:25%"><strong>Delivery Date : </strong></td>
                                    <td style="width:25%">{{$activejob[0]->deliver_date}}</td>
                                    <td style="width:25%;border-left:1px solid #ddd;"><strong>Material Option :
                                        </strong></td>
                                    <td style="width:25%;text-align:left">{{$activejob[0]->material_option}}</td>
                                </tr>

                            </table>
                            <table class="table general-table" style="border-left:10px solid #af600b; border-bottom:10px solid #af600b; border-right:10px solid #af600b">
                                <thead>
                                    <tr style="background-color:#af600b">
                                        <th style="text-align:center"> #</th>
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
                                        <th >Total Qty</th>

                                    </tr>
                                </thead>


                                @php
                                    $recordId = 1;
                                @endphp

                                <tbody>
                                    @if (!empty($activejob[0]['jobdetails']))
                                        @foreach ($activejob[0]['jobdetails'] as $jbd)
                                            <tr>

                                                <td style="background-color:#c28206;text-align:center;color:#000;border-bottom:1px solid #fff">{{ $recordId }}</td>

                                                @php
                                                    $recordId = $recordId + 1;
                                                @endphp

                                                <td>{{ $jbd->category }}</td>
                                                <td>{{ $jbd->design }}</td>
                                                <td>{{ $jbd->sleeve }}</td>
                                                @foreach (['3XS', '2XS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL', '5XL', '6XL'] as $size)
                                                    @if ($jbd->size == $size)
                                                        @php
                                                            $class = 'style-' . $size . '-qty';
                                                        @endphp
                                                        <td style="text-align:center;background-color:#191919;" class={{ $class }}>
                                                            {{ $jbd->qty }}</td>
                                                    @else
                                                        <td style="text-align:center;background-color:#191919;">0</td>
                                                    @endif
                                                @endforeach
                                                <!-- total -->
                                                <td style="text-align:center;background-color:#191919" class="style-final-qty">{{ $jbd->qty }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr style="background-color:#191919">
                                        <td></td>
                                        <td colspan="3">Total</td>
                                        <td style="text-align:center" id="style-3XS-total-qty">0</td>
                                        <td style="text-align:center" id="style-2XS-total-qty">0</td>
                                        <td style="text-align:center" id="style-XS-total-qty">0</td>
                                        <td style="text-align:center" id="style-S-total-qty">0</td>
                                        <td style="text-align:center" id="style-M-total-qty">0</td>
                                        <td style="text-align:center" id="style-L-total-qty">0</td>
                                        <td style="text-align:center" id="style-XL-total-qty">0</td>
                                        <td style="text-align:center" id="style-XXL-total-qty">0</td>
                                        <td style="text-align:center" id="style-3XL-total-qty">0</td>
                                        <td style="text-align:center" id="style-4XL-total-qty">0</td>
                                        <td style="text-align:center" id="style-5XL-total-qty">0</td>
                                        <td style="text-align:center" id="style-6XL-total-qty">0</td>
                                        <td style="text-align:center" id="style-final-total-qty">0</td>
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

                <div class="col-sm-4" style="background-color:#000;color:#FFF;">
                    <section class="panel" style="background-color:#000;color:#FFF;">

                        <div class="panel-body" align="center">
                            <img src="{{ url('uploads/jobs') }}/{{ $activejob[0]->job_design_image_1 }}"
                                width="100%" height="auto">
                        </div>
                    </section>

                </div>

            </div>
        </div>
        @endif


</div>

 <!--body wrapper end-->

            <!--footer section start-->

            <footer style="text-align: center;font-size: 16px;background-color: #4e4b4b;color: white;border-top: 0;">

                2023 &copy; Rabbit Solutions PVT Ltd

            </footer>

            <!--footer section end-->
<!-- main content end-->
</section>

</div>

{{-- slide 2 end --}}

    </div>

    
    <!-- Placed js at the end of the document so the pages load faster -->

    <script src="js/jquery-1.10.2.min.js"></script>

    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>

    <script src="js/jquery-migrate-1.2.1.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/modernizr.min.js"></script>

    <script src="js/jquery.nicescroll.js"></script>

    <!--common scripts for all pages-->

    <script src="js/scripts.js"></script>

    <script src=
"https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js">
    </script>

    <!-- custom scripts -->
    <script>
        // set the total qty
        function setTotal() {

           function display_c(){
            var x = new Date()
            var x1=x.toUTCString();// changing the display to UTC string
            document.getElementById('ct').innerHTML = x1;
            display_c();
           }
            

            // variables

            let sum3XS = 0;
            let sum2XS = 0;
            let sumXS = 0;
            let sumS = 0;
            let sumM = 0;
            let sumL = 0;
            let sumXL = 0;
            let sumXXL = 0;
            let sum3XL = 0;
            let sum4XL = 0;
            let sum5XL = 0;
            let sum6XL = 0;

            let sumFinal = 0;

            // iterators

            $(".style-3XS-qty").each(function() {
                sum3XS += parseFloat($(this).text());
            });

            $(".style-2XS-qty").each(function() {
                sum2XS += parseFloat($(this).text());
            });

            $(".style-XS-qty").each(function() {
                sumXS += parseFloat($(this).text());
            });

            $(".style-S-qty").each(function() {
                sumS += parseFloat($(this).text());
            });

            $(".style-M-qty").each(function() {
                sumM += parseFloat($(this).text());
            });

            $(".style-L-qty").each(function() {
                sumL += parseFloat($(this).text());
            });

            $(".style-XL-qty").each(function() {
                sumXL += parseFloat($(this).text());
            });

            $(".style-XXL-qty").each(function() {
                sumXXL += parseFloat($(this).text());
            });

            $(".style-3XL-qty").each(function() {
                sum3XL += parseFloat($(this).text());
            });

            $(".style-4XL-qty").each(function() {
                sum4XL += parseFloat($(this).text());
            });

            $(".style-5XL-qty").each(function() {
                sum5XL += parseFloat($(this).text());
            });

            $(".style-6XL-qty").each(function() {
                sum6XL += parseFloat($(this).text());
            });

            $(".style-final-qty").each(function() {
                sumFinal += parseFloat($(this).text());
            });


            // setting values

            $('#style-3XS-total-qty').text(sum3XS);
            $('#style-2XS-total-qty').text(sum2XS);
            $('#style-XS-total-qty').text(sumXS);
            $('#style-S-total-qty').text(sumS);
            $('#style-M-total-qty').text(sumM);
            $('#style-L-total-qty').text(sumL);
            $('#style-XL-total-qty').text(sumXL);
            $('#style-XXL-total-qty').text(sumXXL);
            $('#style-3XL-total-qty').text(sum3XL);
            $('#style-4XL-total-qty').text(sum4XL);
            $('#style-5XL-total-qty').text(sum5XL);
            $('#style-6XL-total-qty').text(sum6XL);

            $('#style-final-total-qty').text(sumFinal);

        }
    </script>


    {{-- slider --}}

    <script>
        var slideIndex = 0;

        showSlides();

        function showSlides() {

            var i;

            var slides = document.getElementsByClassName("slide");

            for (i = 0; i < slides.length; i++) {

                slides[i].style.display = "none";

            }

            slideIndex++;

            if (slideIndex > slides.length) {

                slideIndex = 1;

            }

            slides[slideIndex - 1].style.display = "";

            setTimeout(showSlides, 8000); // Change slide every 2 seconds

        }

        function display_c(){
            var refresh=1000; // Refresh rate in milli seconds
            mytime=setTimeout('display_ct()',refresh)
        }

      

    </script>




</body>

</html>
