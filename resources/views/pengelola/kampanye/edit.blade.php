@extends('pengelola.layouts.app')
@section('title','Edit Kampanye - DonasiKita')
@section('page_title','Edit Kampanye')
@section('content')<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6"><form method="POST" action="{{ route('pengelola.kampanye.update',$kampanye) }}" enctype="multipart/form-data">@include('pengelola.kampanye._form')</form></div>@endsection
