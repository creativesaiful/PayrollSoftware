@extends('layouts.admin') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Leave Request</div>
                <div class="card-body">
                    <form action="{{ route('leave.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="leave_category">Leave Category</label>
                            <select name="leave_category" id="leave_category" class="form-control">
                                <option value="vacation">Vacation</option>
                                <option value="sick">Sick Leave</option>
                                <!-- Add more leave categories as needed -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea name="reason" id="reason" class="form-control" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
