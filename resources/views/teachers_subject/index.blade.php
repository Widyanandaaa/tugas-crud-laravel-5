@extends('layouts.tables')

@section('title', 'Data Guru Mapel')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('nav')
    <ul class="list-inline">
        <li class="list-inline-item px-3"><a href="/home" class="nav-link">Home</a></li>
        <li class="list-inline-item pr-3"><a href="/siswa" class="nav-link">Siswa</a></li>
        <li class="list-inline-item pr-3"><a href="/guru" class="nav-link">Guru</a></li>
        <li class="list-inline-item pr-3"><a href="/mapel" class="nav-link">Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/siswa-mapel" class="nav-link">Siswa Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/guru-mapel" class="nav-link active">Guru Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/jadwal" class="nav-link">Jadwal</a></li>
    </ul>
@endsection

@section('index')
<div class="container">
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if (session('deleted'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('deleted') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <div class="card mt-4">
      <div class="card-body">
          <a href="javascript:void(0)" class="btn btn-outline-success mb-3" id="tombol-tambah">Tambah Guru Mapel</a>
          <table class="table table-info table-bordered border-dark table-hover table-lg" id="table-guru">
              <thead class="table-primary">
                  <tr>
                    <th>ID Guru</th>
                    <th>Nama Guru</th>
                    <th>ID Mapel</th>
                    <th>Mapel</th>
                    <th>Aksi</th>
                  </tr>
              </thead>
          </table>
      </div>
  </div>
</div>
@endsection

@section('tambah')
  <div class="modal fade" id="modal-tambah" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light" id="ModalTitle">Tambah Data Guru Mapel</h5>
        </div>
        <div class="modal-body">
          <form id="form-tambah" name="form-tambah" action="{{ action('TeacherSubjectController@store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id">
            <div class="mb-4">
              <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="tambah-nama" name="teacher_id" required>
                <option selected>Nama Guru</option>
                @foreach ($teachers as $id => $teacher)
                  <option value="{{ $id }}">{{ $teacher }}</option>
                @endforeach
              </select>         
            </div>
            <div class="mb-3">
              <div class="col-12">
                <div class="btn-group d-flex flex-wrap" role="group" aria-label="Basic checkbox toggle button group">
                  @foreach ($subjects as $id => $subject)
                    <input type="checkbox" class="btn-check" id="tambah-mapel{{ $id }}" value="{{ $id }}" name="subject_id[]" autocomplete="off">
                    <label class="btn btn-outline-success mx-1" for="tambah-mapel{{ $id }}">{{ $subject }}</label>
                  @endforeach
                </div>
              </div>
              <div class="col"></div>
            </div>
            <div class="d-grid gap-2">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success" id="tombol-simpan">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@section('edit')
  <div class="modal fade" id="modal-edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="judul-modal-edit">Edit Data Guru Mapel</h5>
        </div>
        <div class="modal-body">
          <form action="/siswa" method="post" name="form-edit" id="form-edit">
              {{ csrf_field() }}
              @method('PATCH')
              <input type="hidden" name="id" value="" id="id">
              <div class="mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="edit-nama" name="teacher_id">
                  <option selected>Nama Guru</option>
                  @foreach ($teachers as $id => $teacher)
                      <option value="{{ $id }}">{{ $teacher }}</option>
                  @endforeach
                </select>         
              </div>
              <div class="mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="edit-mapel" name="subject_id[]">
                  <option selected>Mapel</option>
                  @foreach ($subjects as $id => $subject)
                      <option value="{{ $id }}">{{ $subject }}</option>
                  @endforeach
                </select>         
              </div>
              <div class="d-grid gap-2">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-warning" id="tombol-simpan">Simpan</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('hapus')
  <div class="modal fade" id="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-light" id="judul-modal-hapus">Hapus Data Guru Mapel</h5>
        </div>
        <div class="modal-body">
          <h5 id="teks-hapus">Yakin hapus data ini?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="/siswa" method="post" name="form-edit" id="form-hapus">
            {{ csrf_field() }}
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yakin</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@endsection
@section('JS')
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('js/dataTable_teacherSubject.js') }}"></script>
@endsection