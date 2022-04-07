@extends('layouts.tables')

@section('title', 'Data Guru')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('nav')
    <ul class="list-inline">
        <li class="list-inline-item px-3"><a href="/home" class="nav-link">Home</a></li>
        <li class="list-inline-item pr-3"><a href="/siswa" class="nav-link">Siswa</a></li>
        <li class="list-inline-item pr-3"><a href="/guru" class="nav-link active">Guru</a></li>
        <li class="list-inline-item pr-3"><a href="/mapel" class="nav-link">Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/siswa-mapel" class="nav-link">Siswa Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/guru-mapel" class="nav-link">Guru Mapel</a></li>
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
          <a href="javascript:void(0)" class="btn btn-outline-success mb-3" id="tombol-tambah">Tambah Guru</a>
          <table class="table table-info table-bordered border-dark table-hover table-lg" id="table-guru">
              <thead class="table-primary">
                  <tr>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Jenis Kelamin</th>
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
          <h5 class="modal-title text-light" id="ModalTitle">Tambah Data Guru</h5>
        </div>
        <div class="modal-body">
          <form id="form-tambah" name="form-tambah" action="{{ action('TeacherController@store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama :</label>
              <input type="text" class="form-control" id="tambah-nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat :</label>
              <input type="text" class="form-control" id="tambah-alamat" name="alamat">
            </div>
            <div class="mb-3">
              <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="tambah JK" name="JK">
                <option selected>Jenis Kelamin</option>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
              </select>         
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
          <h5 class="modal-title" id="judul-modal-edit">Edit Data Guru</h5>
        </div>
        <div class="modal-body">
          <form action="/siswa" method="post" name="form-edit" id="form-edit">
              {{ csrf_field() }}
              @method('PATCH')
              <input type="hidden" name="id" value="" id="id">
              <div class="mb-3">
              <label for="nama" class="form-label">Nama :</label>
              <input type="text" class="form-control" id="edit-nama" name="nama" value="" required>
              </div>
              <div class="mb-3">
              <label for="alamat" class="form-label">Alamat :</label>
              <input type="text" class="form-control" id="edit-alamat" name="alamat" value="">
              </div>
              <div class="mb-3">
              <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="edit-JK" name="JK">
                  <option selected value="">Jenis Kelamin</option>
                  <option value="Pria">Pria</option>
                  <option value="Wanita">Wanita</option>
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
          <h5 class="modal-title text-light" id="judul-modal-hapus">Hapus Data Guru</h5>
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
    <script src="{{ asset('js/dataTable_teacher.js') }}"></script>
@endsection