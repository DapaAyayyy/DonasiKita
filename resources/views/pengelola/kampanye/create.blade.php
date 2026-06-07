@extends('pengelola.layouts.app')
@section('title','Tambah Kampanye - DonasiKita')
@section('page_title','Tambah Kampanye')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.kampanye.store') }}" enctype="multipart/form-data">@include('pengelola.kampanye._form')</form></div>@endsection
