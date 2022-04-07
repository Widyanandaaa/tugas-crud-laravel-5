@extends('layouts.app')

@section('title', 'Home')

@section('nav')
    <ul class="list-inline">
        <li class="list-inline-item px-3"><a href="/home" class="nav-link active">Home</a></li>
        <li class="list-inline-item pr-3"><a href="/siswa" class="nav-link">Siswa</a></li>
        <li class="list-inline-item pr-3"><a href="/guru" class="nav-link">Guru</a></li>
        <li class="list-inline-item pr-3"><a href="/mapel" class="nav-link">Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/siswa-mapel" class="nav-link">Siswa Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/guru-mapel" class="nav-link">Guru Mapel</a></li>
        <li class="list-inline-item pr-3"><a href="/jadwal" class="nav-link">Jadwal</a></li>
    </ul>
@endsection

@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-3 pl-5">
            <div class="rounded-circle" style="background-color: brown; height: 150px; width: 150px"></div>
        </div>
        <div class="col-9 pt-3">
            <span>
                <h2>Azriel Zidane Widyananda</h2>
            </span>
            <span>XI RPL 3</span>
        </div>
    </div>
</div>
@endsection
