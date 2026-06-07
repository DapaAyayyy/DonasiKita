@extends('pengelola.layouts.app')
@section('title','Edit Penerima - DonasiKita')
@section('page_title','Edit Penerima')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.penerima.update',$penerima) }}">@include('pengelola.penerima._form')</form></div>@endsection
