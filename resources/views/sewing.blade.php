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

        .label-info {
            background-color: #003d7c;
        }

        .label-danger {
            background-color: #ae0000;
        }

        .label-warning {
            background-color: #c7a42a;
        }


        .greeting_tag {
            font-size: 3em;
            color: limegreen;
            text-align: center;
            padding: 8px;
        }

        .sort-btn {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 12px;
            color: black;
            /* Set the button icon color to black */
            padding: 0;
        }
    </style>

</head>

<body class="sticky-header" onload="setTotal()"
    style="font-size:24px;background-color:#000;color:#fff;text-transform:uppercase;">


    <div class="slider-container">


        {{-- slide 1 --}}

        <div class="slide" onmouseover="pauseSlides()" onmouseout="resumeSlides()">

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
                                
                                if ($Hour >= 5 && $Hour <= 11) {
                                    $greeting = 'Good Morning';
                                } elseif ($Hour >= 12 && $Hour <= 18) {
                                    $greeting = 'Good Afternoon';
                                } elseif ($Hour >= 19 || $Hour <= 4) {
                                    $greeting = 'Good Evening';
                                }
                                ?>

                                <header class="panel-heading" style="text-align:right">
                                    <div class="row">
                                        <div class="col-md-1"><span id='ct'></span></div>
                                        <div class="col-md-8">
                                            <marquee width="100%" class="greeting_tag" direction="right"
                                                height="100%">
                                                {{ $greeting }} Team!
                                            </marquee>
                                        </div>
                                        <div style="float:right;padding-top:10px" class="col-md-3">
                                            <span
                                                style="color:#FFF;background-color:#AE0000;padding:10px; border-radius: 25px 0px 0px 25px;margin-bottom:10px;font-size:26px;">
                                                Sewing Department
                                            </span>
                                        </div>
                                    </div>
                                </header>

                                <div class="panel-body">

                                    <table class="table general-table"
                                        style="border-left:10px solid #af600b; border-bottom:10px solid #af600b; border-right:10px solid #af600b">

                                        <thead>

                                            <tr style="background-color:#af600b;font-size:22px">

                                                <th style="text-align:center"> #</th>

                                                <th>Token</th>

                                                <th>Job No</th>

                                                <th>Customer</th>

                                                <th>Order No</th>

                                                <th>Job Title</th>

                                                <th>Fabric</th>

                                                <th>
                                                    Delivery Date
                                                    <button class="sort-btn" data-column="deliveryDate"
                                                        data-order="asc">&#x25B2;</button>
                                                    <button class="sort-btn" data-column="deliveryDate"
                                                        data-order="desc">&#x25BC;</button>
                                                </th>
                                                <th>
                                                    Start Date
                                                    <button class="sort-btn" data-column="startDate"
                                                        data-order="asc">&#x25B2;</button>
                                                    <button class="sort-btn" data-column="startDate"
                                                        data-order="desc">&#x25BC;</button>
                                                </th>

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
                                                    <td
                                                        style="background-color:#c28206;text-align:center;color:#000;border-bottom:1px solid #fff">
                                                        {{ $recordId }}</td>
                                                    @php
                                                        $recordId = $recordId + 1;
                                                    @endphp
                                                    @if ($tv)
                                                        <td>{{ $tv->token }}</td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                    @if ($tv)
                                                        <td><a href="{{ route('sewing_details', ['job_no' => $tv->job_no]) }}"
                                                                style="width: 100%">{{ $tv->job_no }}</a></td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                    @if ($tv)
                                                        <td>{{ $tv['client']['first_name'] }} </td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                    @if ($tv)
                                                        <td>{{ $tv['client_reference_no'] }}</td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                    @if ($tv)
                                                        <td>{{ $tv->job_title }}</td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                    @if ($tv)
                                                        <td>{{ $tv->material_option }}</td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                    @if ($tv)
                                                        <td data-deliveryDate="{{ $tv->deliver_date }}">
                                                            {{ date('d-m-Y', strtotime($tv->deliver_date)) }}</td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                    @if ($tv)
                                                        <td data-startDate="{{ $tv->start_date }}">
                                                            {{ date('d-m-Y', strtotime($tv->start_date)) }}</td>
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                    @foreach (['T-shirt', 'Short', 'Skirt', 'Bottom'] as $design)
                                                        @php
                                                            $style = $tv->jobdetails->firstWhere('design', $design);
                                                        @endphp
                                                        @if ($style)
                                                            <td style="background-color:#191919;text-align:center">
                                                                {{ $style->qty }}</td>
                                                        @else
                                                            <td style="background-color:#191919;text-align:center"> 0
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    @if ($tv)
                                                        <td style="background-color:#191919;text-align:center">
                                                            {{ $tv->qty }}</td>
                                                    @else
                                                        <td style="background-color:#191919;text-align:center">0</td>
                                                    @endif
                                                    <td style="background-color:#191919;text-align:center">
                                                        @if ($tv->department_status == 0)
                                                            <span class="label label-info label-mini">Pending</span>
                                                        @elseif ($tv->department_status == 1)
                                                            <span
                                                                class="label label-success label-mini">Completed</span>
                                                        @elseif ($tv->department_status == 2)
                                                            <span class="label label-warning label-mini">Ongoing</span>
                                                        @elseif ($tv->department_status == 3)
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



    </div>

    {{-- job broadcast listening --}}
    <div id="TV">
        {{-- vue app target div --}}
    </div>
    @vite(['resources/js/broadcast.js'])
    {{-- -------------------- --}}



    <!-- Placed js at the end of the document so the pages load faster -->

    <script src="js/jquery-1.10.2.min.js"></script>

    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>

    <script src="js/jquery-migrate-1.2.1.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/modernizr.min.js"></script>

    <script src="js/jquery.nicescroll.js"></script>

    <!--common scripts for all pages-->

    <script src="js/scripts.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <!-- custom scripts -->
    <script>
        // set the total qty
        function setTotal() {

            function display_c() {
                var x = new Date()
                var x1 = x.toUTCString(); // changing the display to UTC string
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
            let sum2XL = 0;
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

            $(".style-2XL-qty").each(function() {
                sum2XL += parseFloat($(this).text());
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
            $('#style-2XL-total-qty').text(sum2XL);
            $('#style-3XL-total-qty').text(sum3XL);
            $('#style-4XL-total-qty').text(sum4XL);
            $('#style-5XL-total-qty').text(sum5XL);
            $('#style-6XL-total-qty').text(sum6XL);

            $('#style-final-total-qty').text(sumFinal);

        }

        document.addEventListener("DOMContentLoaded", function() {
            const table = document.querySelector(".general-table");
            const sortButtons = document.querySelectorAll(".sort-btn");

            sortButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const column = button.dataset.column;
                    const order = button.dataset.order;

                    const rows = Array.from(table.tBodies[0].querySelectorAll("tr"));

                    rows.sort((a, b) => {
                        const aValue = a.querySelector(`td[data-${column}]`).getAttribute(
                            `data-${column}`);
                        const bValue = b.querySelector(`td[data-${column}]`).getAttribute(
                            `data-${column}`);

                        return (order === "asc" ? 1 : -1) * (aValue.localeCompare(bValue));
                    });

                    while (table.tBodies[0].firstChild) {
                        table.tBodies[0].removeChild(table.tBodies[0].firstChild);
                    }

                    rows.forEach(row => {
                        table.tBodies[0].appendChild(row);
                    });

                    // Toggle the order for next click
                    button.dataset.order = order === "asc" ? "desc" : "asc";
                });
            });
        });
    </script>


    {{-- slider --}}

    <!-- <script>
        var slideIndex = 0;
        var slideInterval;

        function showSlides() {
            var slides = document.getElementsByClassName("slide");

            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slideIndex++;

            if (slideIndex > slides.length) {
                slideIndex = 1;
            }

            slides[slideIndex - 1].style.display = "";

            slideInterval = setTimeout(showSlides, 8000); // Change slide every 8 seconds
        }

        function pauseSlides() {
            clearTimeout(slideInterval);
        }

        function resumeSlides() {
            slideInterval = setTimeout(showSlides, 8000); // Change slide every 8 seconds
        }

        // Call the showSlides function initially to start the automatic slide change
        showSlides();
    </script> -->


</body>

</html>
