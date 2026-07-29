@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<form action="{{ route('produk.update', $product->id) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('produk._form')
</form>
@endsection