@extends('pengelola.layouts.app')
@section('title','Edit Akun Pengelola - DonasiKita')
@section('page_title','Edit Akun Pengelola')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.admin.update',$admin) }}">@include('pengelola.admin._form')</form></div>@endsection
