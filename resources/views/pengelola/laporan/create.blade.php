@extends('pengelola.layouts.app')
@section('title','Tambah Laporan - DonasiKita')
@section('page_title','Tambah Laporan')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.laporan.store') }}" enctype="multipart/form-data">@include('pengelola.laporan._form')</form></div>@endsection
