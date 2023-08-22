<?php

namespace App\Http\Controllers;

use App\Mail\LeaveRequestNotification;
use App\Mail\LeaveStatusNotification;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LeaveController extends Controller
{
    public function index()
    {
        // Show a list of leave requests for the authenticated employee
        $leaves = Leave::where('employee_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        $role = Employee::where('email',Auth::user()->email)->first();

        return view('pages.leaves.index', compact(['leaves', 'role']));
    }

    public function create()
    {
        // Show the leave request form
        return view('pages.leaves.create');
    }

    public function store(Request $request)
    {


        // Store the submitted leave request
        $request->validate([
            'leave_category' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reason' => 'required',
        ]);


        $leave = Leave::create([
            'employee_id' => Auth::user()->id,
            'leave_category' => $request->leave_category,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        // Send email notification to manager
        // $managerEmail = 'manager@example.com'; // Replace with actual manager's email
        // Mail::to($managerEmail)->send(new LeaveRequestNotification($leave));

        return redirect()->route('leave.index')->with('success', 'Leave request submitted.');
    }

    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'approved']);

        // Send email notification to the employee
        Mail::to($leave->employee->email)->send(new LeaveStatusNotification($leave));

        return redirect()->route('leave.index')->with('success', 'Leave request approved.');
    }

    public function reject($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'rejected']);

        // Send email notification to the employee
        Mail::to($leave->employee->email)->send(new LeaveStatusNotification($leave));

        return redirect()->route('leave.index')->with('success', 'Leave request rejected.');
    }
}
