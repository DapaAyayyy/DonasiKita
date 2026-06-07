@extends('pengelola.layouts.app')
@section('title','Tambah Admin - DonasiKita')
@section('page_title','Tambah Admin')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.admin.store') }}">@include('pengelola.admin._form')</form></div>@endsection
