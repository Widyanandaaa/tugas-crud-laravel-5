<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
        $teacher = Teacher::all();

        if( $request->ajax() ) {
            return datatables()->of($teacher)
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

        return view('teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.index');
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
            'JK' => 'required'
        ]);

        Teacher::create($request->all());

        return redirect('/guru')->with('success', 'Data Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required'
        ]);

        $teacher = Teacher::find($id);

        $teacher->nama = $request->input('nama');
        $teacher->alamat = $request->input('alamat');
        $teacher->JK = $request->input('JK');

        $teacher->save();

        return redirect('/guru')->with('success', 'Data Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher::destroy($id);

        return redirect('/guru')->with('deleted', 'Data Terhapus!');
    }
}
