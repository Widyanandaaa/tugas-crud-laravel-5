<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Subject;
use App\Teacher_Subject;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
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
    public function index(Request $request, Teacher $teacher, Subject $subject, Teacher_Subject $teacher_Subject)
    {
        $teacher_Subjects = Teacher_Subject::all();

        $teachers = Teacher::pluck('nama', 'id');
        $subjects = Subject::pluck('nama', 'id');

        if( $request->ajax() ) {
            return datatables()->of($teacher_Subjects)
                    ->addColumn('aksi', function($data) {
                        $button = '<div class="d-flex justify-content-center">';
                        $button .= '<a href="javascript:void(0)" id="tombol-edit" data-id="' . $data->id . '" class="badge text-decoration-none bg-warning text-dark edit-post">Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="javascript:void(0)" id="tombol-hapus" data-id="' . $data->id . '" class="badge text-decoration-none bg-danger text-light delete-post ml-2">Hapus</a>';
                        $button .= '</div>';
                        return $button;
                    })
                    ->addColumn('Nama Guru', function($data) {
                        $teach = Teacher_Subject::find($data->id)->teacher->nama;
                        
                        $value = "{$teach}";
                        return $value;
                    })
                    ->addColumn('mapel', function($data) {
                        $teach = Teacher_Subject::find($data->id)->subject->nama;

                        $value = "{$teach}";
                        return $value;
                        // $value = '<div class="d-sm-flex justify-content-center">';
                        // $value .= '<span class="badge rounded-pill bg-secondary mx-1">' . $teacher . '</span>';
                        // $value .= '</div>';
                    })
                    ->rawColumns(['aksi', 'Nama guru', 'mapel'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('teachers_subject.index', compact('teachers', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers_subject.index');
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
            'teacher_id' => 'required',
            'subject_id' => 'required',
        ]);

        $data = $request->all();
        // dd($data);

        $id = $data["teacher_id"];
        
        $teacher = Teacher::find($id);

        if( !is_null($data['subject_id']) ) {
            foreach( $data['subject_id'] as $key => $value ) {
                $finalData = [
                    'teacher_id' => $data['teacher_id'] ,
                    'subject_id' => $data['subject_id'][$key]
                ];
                $teacher->subjects()->create($finalData);
            }
        }

        return redirect('/guru-mapel')->with('success', 'data tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher_Subject  $teacher_Subject
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher_Subject $teacher_Subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher_Subject  $teacher_Subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher_Subject $teacher_Subject)
    {
        return view('teachers_subject.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher_Subject  $teacher_Subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required'
        ]);
        
        $data = $request->all();
        // dd($data);

        $teacher = Teacher_Subject::find($id);

        if( !is_null($data['subject_id']) ) {
            foreach( $data['subject_id'] as $key => $value ) {
                $finalData = [
                    'teacher_id' => $data['teacher_id'][$key],
                    'subject_id' => $data['subject_id'][$key]
                ];
                $teacher->teacher_id = $finalData['teacher_id'];
                $teacher->subject_id = $finalData['subject_id'];
                $teacher->save();
            }
        }

        return redirect('/guru-mapel')->with('success', 'data terubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher_Subject  $teacher_Subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher_Subject::destroy($id);

        return redirect('/guru-mapel')->with('deleted', 'Data Terhapus!');
    }
}
