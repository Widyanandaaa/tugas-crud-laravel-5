<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use App\Student_Subject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
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
    public function index(Request $request, Student $student, Subject $subject, Student_Subject $student_Subject)
    {
        $student_Subjects = Student_Subject::all();

        $students = Student::pluck('nama', 'id');
        $subjects = Subject::pluck('nama', 'id');

        if( $request->ajax() ) {
            return datatables()->of($student_Subjects)
                    ->addColumn('aksi', function($data) {
                        $button = '<div class="d-flex justify-content-center">';
                        $button .= '<a href="javascript:void(0)" id="tombol-edit" data-id="' . $data->id . '" class="badge text-decoration-none bg-warning text-dark edit-post">Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="javascript:void(0)" id="tombol-hapus" data-id="' . $data->id . '" class="badge text-decoration-none bg-danger text-light delete-post ml-2">Hapus</a>';
                        $button .= '</div>';
                        return $button;
                    })
                    ->addColumn('Nama Siswa', function($data) {
                        $stud = Student_Subject::find($data->id)->student->nama;
                        
                        $value = "{$stud}";
                        return $value;
                    })
                    ->addColumn('mapel', function($data) {
                        $stud = Student_Subject::find($data->id)->subject->nama;

                        $value = "{$stud}";
                        return $value;
                    })
                    ->rawColumns(['aksi'], ['Nama Siswa'], ['mapel'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('student_subjects.index', compact('students', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students_subject.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'subject_id' => 'required',
        ]);
        
        $data = $request->all();

        $id = $data['student_id'];
        
        $student = Student::find($id);
        
        if( !is_null($data['subject_id']) ) {
            foreach( $data['subject_id'] as $key => $value ) {
                $finalData = [
                    'student_id' => $data['student_id'] ,
                    'subject_id' => $data['subject_id'][$key]
                ];
                $student->subjects()->create($finalData);
            }
        }

        return redirect('siswa-mapel')->with('success', 'data tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student_Subject  $student_Subject
     * @return \Illuminate\Http\Response
     */
    public function show(Student_Subject $student_Subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student_Subject  $student_Subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Student_Subject $student_Subject)
    {
        return view('students_subject.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student_Subject  $student_Subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required',
            'subject_id' => 'required'
        ]);
        
        $student = Student_Subject::find($id);
        
        $student->student_id = $request->input('student_id');
        $student->subject_id = $request->input('subject_id');
        
        $student->save();

        return redirect('/siswa-mapel')->with('success', 'data terubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student_Subject  $student_Subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student_Subject::destroy($id);

        return redirect('/siswa-mapel')->with('deleted', 'Data Terhapus!');
    }
}
