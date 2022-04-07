<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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
    public function index(Request $request)
    {
        $student = Student::all();

        if( $request->ajax() ) {
            return datatables()->of($student)
                    ->addColumn('aksi', function($data) {
                        $button = '<div class="d-flex justify-content-center">';
                        $button .= '<a href="javascript:void(0)" id="tombol-edit" data-id="' . $data->id . '" class="badge text-decoration-none bg-warning text-dark edit-post">Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="javascript:void(0)" id="tombol-hapus" data-id="' . $data->id . '" class="badge text-decoration-none bg-danger text-light delete-post ml-2">Hapus</a>';
                        $button .= '</div>';
                        return $button;
                    })
                    ->rawColumns(['aksi'])
                    ->addIndexColumn()
                    ->make(true);
        }

        // $student = Student::find(1);
        // dd($student->subject->nama);
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.index');
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
            'nama' => 'required',
            'alamat' => 'required',
            'JK' => 'required',
            'kelas' => 'required'
        ]);

        Student::create($request->all());
        
        return redirect('/siswa')->with('success', 'data tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required'
        ]);
        
        $student = Student::find($id);
        
        $student->nama = $request->input('nama');
        $student->alamat = $request->input('alamat');
        $student->JK = $request->input('JK');
        $student->kelas = $request->input('kelas');
        
        $student->save();

        return redirect('/siswa')->with('success', 'data terubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::destroy($id);

        return redirect('/siswa')->with('deleted', 'Data Terhapus!');
    }
}
