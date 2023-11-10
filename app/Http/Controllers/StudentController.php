<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const VIEW_PATH = 'students.';
    private const PUBLIC_PATH = 'students';
    public function index()
    {
        $data = Student::latest()->paginate(5);
        return view(self::VIEW_PATH . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'std_id' => 'required|unique:students',
            'class_name' => 'required',
            'name' => 'required',
            'avatar' => 'image|file',
        ]);
        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $data['avatar'] = Storage::put(self::PUBLIC_PATH, $request->file('avatar'));
        }
        Student::create($data);
        Alert::success('Successfully', 'Created Student Successfully');
        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'std_id' => 'required|unique:students,std_id,' . $student->id,
            'class_name' => 'required',
            'name' => 'required',
            'avatar' => 'image|file',
        ]);
        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $data['avatar'] = Storage::put(self::PUBLIC_PATH, $request->file('avatar'));
        }
        $currentAvatar = $student->avatar;
        $student->update($data);
        if ($request->hasFile('avatar')) {
            Storage::delete($currentAvatar);
        }
        Alert::success('Successfully', 'Updated Student Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if (Storage::exists($student->avatar)) {
            Storage::delete($student->avatar);
        }
        $student->delete();
        Alert::success('Successfully', 'Deleted Student Successfully');
        return back();
    }
}
