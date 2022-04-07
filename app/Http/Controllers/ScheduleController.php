<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Subject;
use App\Student;
use App\Teacher_Subject;
use App\Student_Subject;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $teachers = Teacher::all();
        $subjects = Subject::all();
        // dd($subjects->find(12)->teacherSubject[0]);
        $students = Student::all();
        $teacherSubject = Teacher_Subject::all();
        foreach( $teacherSubject as $subject ) {
            $hasil[] = $subject->subject_id;
        }
        // dd($hasil);
        $studentSubject = Student_Subject::all();
        foreach( $studentSubject as $student ) {
            $dataStudent[] = $studentSubject->find($student);
        }
        // dd($dataStudent[11]->subject->teacherSubject);
        $count = count($dataStudent);
        // dd($count);

        return view('schedules.index', compact('count', 'dataStudent', 'teachers', 'subjects', 'students', 'teacherSubject', 'studentSubject'));
    }
}
