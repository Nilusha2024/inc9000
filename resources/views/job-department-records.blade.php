<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Department Record List</title>
</head>

<body>

    <table id="dataTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Job Number</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Status</th>
                <th>Token</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departmentDetailRecords as $departmentDetailRecord)
                <tr>
                    <td>{{ $departmentDetailRecord->job_id }}</td>

                    @if ($departmentDetailRecord['job'] != null)
                        <td>{{ $departmentDetailRecord['job']['job_no'] }}</td>
                        <td>{{ $departmentDetailRecord['job']['job_title'] }}</td>
                    @else
                        <td>...</td>
                        <td>...</td>
                    @endif

                    <td>{{ $departmentDetailRecord['department']['department_name'] }}</td>
                    <td>{{ $departmentDetailRecord->start_date->toDateString() }}</td>
                    <td>{{ $departmentDetailRecord->end_date->toDateString() }}</td>
                    <td>
                        @if ($departmentDetailRecord->department_status == 0)
                            <span class="badge badge-info">PENDING</span>
                        @elseif ($departmentDetailRecord->department_status == 1)
                            <span class="badge badge-success">COMPLETE</span>
                        @elseif ($departmentDetailRecord->department_status == 2)
                            <span class="badge badge-warning">ONGOING</span>
                        @elseif ($departmentDetailRecord->department_status == 3)
                            <span class="badge badge-secondary">HOLD</span>
                        @elseif ($departmentDetailRecord->department_status == 4)
                            <span class="badge badge-danger">NOT READY</span>
                        @endif
                    </td>
                    <td><span class="badge badge-warning">{{ $departmentDetailRecord->token }}</span></td>
                    <td class="d-flex justify-content-center">
                        <button type="button" value="{{ $departmentDetailRecord->id }}"
                            class="btn btn-sm btn-primary token-edit"
                            onclick="editToken(this.value , '{{ $departmentDetailRecord->token }}')">
                            <span class="fas fa-edit"> </span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            order: [
                [4, 'asc']
            ],
            buttons: [
                'excel', 'csv', 'pdf', 'print'
            ]
        });
    });
</script>

</html>
