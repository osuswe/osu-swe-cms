<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $attendance = Attendance::paginate(15);

        return view('admin.attendance.index', compact('attendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['user_id' => 'required', 'event_id' => 'required', ]);

        Attendance::create($request->all());

        Session::flash('flash_message', 'Attendance added!');

        return redirect('admin/attendance');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);

        return view('admin.attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);

        return view('admin.attendance.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['user_id' => 'required', 'event_id' => 'required', ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->all());

        Session::flash('flash_message', 'Attendance updated!');

        return redirect('admin/attendance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Attendance::destroy($id);

        Session::flash('flash_message', 'Attendance deleted!');

        return redirect('admin/attendance');
    }
}
