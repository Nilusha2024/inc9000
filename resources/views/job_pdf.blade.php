{{-- custom styles --}}
@vite(['resources/css/core.css'])
{{-- bootstrap cdn --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

{{-- header section --}}
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="text-black-50">Job Details</h2>
            </div>
            <!-- <div class="col-sm-6 text-end">
                <input type="button" value="print" class="btn btn-lg btn-primary  print-window" onclick="printpdfd()">
            </div> -->
        </div>
    </div>
</section>

{{-- content section --}}
<section class="content">
    <div class="container-fluid">
        {{-- job view table card --}}
        <div class="card shadow-lg mb-3" style="border-radius: 25px; ">

            <div class="card-body ps-4 pe-4 pb-4">
                {{-- elements go here : --}}
                <div class="col-sm-12">
                    {{-- 1st row --}}
                    <div class="row mb-4">


                        {{-- right : info holder --}}
                        <div class="col-sm-12 ">

                            {{-- core info card --}}
                            <div class="card border-0 shadow-none">
                                <div class="card-header" style="background-color: transparent;">
                                    <h5>Info</h5>
                                </div>
                                <div class="card-body">

                                    {{-- core info table --}}
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="width: 25%;">Job no :</td>
                                                <td>{{ $job->job_no }}</td>
                                            </tr>
                                            <tr>
                                                <td>For client :</td>
                                                <td>{{ $job['client']['first_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Client Ref no :</td>
                                                <td>{{ $job->client_reference_no }}</td>
                                            </tr>
                                            <tr>
                                                <td>Material option :</td>
                                                <td>{{ $job->material_option }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sleeve details :</td>
                                                <td>{{ $job->sleeve_details }}</td>
                                            </tr>
                                            <!-- <tr>
                                                <td>Sleeve remarks :</td>
                                                <td>{{ $job->sleeve_remarks }}</td>
                                            </tr> -->
                                            <!-- <tr>
                                                <td>Order date :</td>
                                                <td>{{ $job->order_date->toDateString() }}</td>
                                            </tr> -->
                                            <tr>
                                                <td>Deliver date :</td>
                                                <td>{{ $job->deliver_date->toDateString() }}</td>
                                            </tr>
                                            <tr>
                                                <td>T-shirt details :</td>
                                                <td>{{ $job->tshirt_details }}</td>
                                            </tr>
                                            <tr>
                                                <td>Short details :</td>
                                                <td>{{ $job->short_details }}</td>
                                            </tr>
                                            <tr <?php if (!empty($job->special_note)) {
                                                echo 'style="background-color: red;"';
                                                } ?>>
                                                <td>Special note :</td>
                                                <td>{{ $job->special_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>Logo & number :</td>
                                                <td>{{ $job->logo_and_number }}</td>
                                            </tr>
                                            <!-- <tr> -->
                                                <!-- <td>Size label details :</td> -->
                                                <!-- Use the null coalescing operator to provide a default value -->
                                                <!-- <td>{{ ($job->size_label_details !== null && $job->size_label_details
                                                    !== 'null') ? $job->size_label_details : '' }}</td> -->
                                            <!-- </tr> -->

                                            <!-- <tr>
                                                <td>Pattern :</td>
                                                <td>{{ $job->pattern }}</td>
                                            </tr> -->
                                            <tr>
                                                <td>Packing :</td>
                                                <td>{{ $job->packing }}</td>
                                            </tr>                                 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- style info card --}}
                    <div class="card border-0 shadow-none">                        
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Design</th>
                                        <th>Sleeve</th>
                                        <th>Neck type</th>
                                        <th>Size</th>
                                        <th>remarks</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($styleDetailRecords as $styleDetailRecord)
                                    <tr>
                                        <td>{{ $styleDetailRecord->category }}</td>
                                        <td>{{ $styleDetailRecord->design }}</td>
                                        <td>{{ $styleDetailRecord->sleeve }}</td>
                                        <td>{{ $styleDetailRecord->neck_type }}</td>
                                        <td>{{ $styleDetailRecord->size }}</td>
                                        <td>{{ $styleDetailRecord->remarks }}</td>
                                        <td>{{ $styleDetailRecord->qty }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5"></td>
                                        <td class="font-weight-bold">Sub total:</td>
                                        <td class="font-weight-bold">{{ $styleSubTotal }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        function printpdfd() {
            window.print();
        }

        $(window).on("load", function () {
            window.print();
        });

        $('.print-window').click(function () {
            window.print();
        });
    });
</script>