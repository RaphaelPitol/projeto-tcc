@extends('layouts.app')
@section('title', 'Quarto')
@section('content')

@php
$dados = ["um", "dois", "tres"]
@endphp

<div class="container h-100 mt-5">
<h2 class="mb-3">Multi-Select Dropdown</h2>
<form action="{{route('vistoria.store')}}" method="POST" class="mx-1 mx-md-3 ">
@csrf
    <div class="form-group">

        <select class="form-control" id="number" name="number[]" multiple>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
            <option value="4">Four</option>
            <option value="5">Five</option>
            <option value="6">Six</option>
            <option value="7">Seven</option>
            <option value="8">Eight</option>
        </select>

    </div>
    <button class="btn btn-primary" type="submit">Enviar</button>
</form>
</div>

<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
<!-- jQuery -->
<script>
    new MultiSelectTag('number') // id
</script>


@endsection