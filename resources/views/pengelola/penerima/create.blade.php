@extends('pengelola.layouts.app')
@section('title','Tambah Penerima - DonasiKita')
@section('page_title','Tambah Penerima')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.penerima.store') }}">@include('pengelola.penerima._form')</form></div>@endsection
