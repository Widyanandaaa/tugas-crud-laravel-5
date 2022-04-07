<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
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
        $subject = Subject::all();

        if( $request->ajax() ) {
            return datatables()->of($subject)
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

        return view('subjects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.index');
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
            'nama' => 'required'
        ]);

        Subject::create($request->all());

        return redirect('/mapel')->with('success', 'Data Tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subjects.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $subject = Subject::find($id);

        $subject->nama = $request->input('nama');

        $subject->save();

        return redirect('/mapel')->with('success', 'Data Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::destroy($id);

        return redirect('/mapel')->with('deleted', 'Data Terhapus!');
    }
}
