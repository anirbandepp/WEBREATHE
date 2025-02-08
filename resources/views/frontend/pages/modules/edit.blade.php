@extends('layouts.frontend')

@section('title', 'WEBREATHE - Home')

@section('content')

    <section class="container">
        <h2>Edit Module</h2>

        <form action="{{ route('modules.update', $module->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Module Name</label>
                <input type="text" class="form-control" name="name" value="{{ $module->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description">{{ $module->details->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </section>

@endsection
