@extends('pengelola.layouts.app')
@section('title','Edit Donatur - DonasiKita')
@section('page_title','Edit Donatur')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.donatur.update',$donatur) }}">@include('pengelola.donatur._form')</form></div>@endsection
