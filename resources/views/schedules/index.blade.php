@extends('layouts.tables')

@section('title', 'Jadwal Mapel')

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
        <li class="list-inline-item pr-3"><a href="/guru-mapel" class="nav-link">Guru Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/jadwal" class="nav-link active">Jadwal</a></li>
    </ul>
@endsection

@section('index')
<div class="container">
  <div class="card mt-4">
      <div class="card-body">
          <table class="table table-info table-bordered table-hover table-lg" id="table-jadwal">
              <thead class="table-primary">
                  <tr>
                    <th>Siswa Mapel</th>
                    <th>Mapel</th>
                    <th>Guru Mapel</th>
                  </tr>
              </thead>
              <tbody>
                  @for ($i = 0; $i < $count; $i++)
                    <tr>
                    <td>{{ $dataStudent[$i]->student->nama }}</td>
                    <td>{{ $dataStudent[$i]->subject->nama }}</td>
                    @if ( !$dataStudent[$i]->subject->teacherSubject->isEmpty() )
                        <td>{{ $dataStudent[$i]->subject->teacherSubject[0]->teacher->nama }}</td>
                    @else
                        <td class="d-flex justify-content-center">
                            <div class="badge alert-danger p-2">
                                Mapel ini belum mempunyai guru mapel!
                            </div>                              
                        </td>
                    @endif
                    </tr>
                  @endfor
              </tbody>
          </table>
      </div>
  </div>
</div>
@endsection

@section('JS')
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('js/dataTable_schedule.js') }}"></script>
@endsection