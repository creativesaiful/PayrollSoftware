@extends('layouts.admin') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Leave Requests</div>
                <div class="card-body">
                    @if (count($leaves) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Leave Category</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    @if($role->type =='manager')
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $leave)
                                    <tr>
                                        <td>{{ $leave->id }}</td>
                                        <td>{{ $leave->leave_category }}</td>
                                        <td>{{ $leave->start_date }}</td>
                                        <td>{{ $leave->end_date }}</td>
                                        <td>{{ $leave->status }}</td>



                                        @if($role->type =='manager')

                                            <td>

                                                    @if ($leave->status === 'pending')
                                                        <form action="{{ route('leave.approve', $leave->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                        </form>
                                                        <form action="{{ route('leave.reject', $leave->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                        </form>
                                                    @else
                                                        {{ ucfirst($leave->status) }}
                                                    @endif

                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No leave requests found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
