@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('produk._form')
</form>

@endsection