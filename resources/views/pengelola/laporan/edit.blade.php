@extends('pengelola.layouts.app')
@section('title','Edit Laporan - DonasiKita')
@section('page_title','Edit Laporan')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.laporan.update',$laporan) }}" enctype="multipart/form-data">@include('pengelola.laporan._form')</form></div>@endsection
