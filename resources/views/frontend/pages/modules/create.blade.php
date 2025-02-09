@extends('layouts.frontend')

@section('title', 'WEBREATHE - Home')

@section('content')

    <section class="container">


        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Register a New Module</h2>

            <a href="{{ route('modules.index') }}" class="btn btn-primary">Go Back</a>
        </div>

        <form action="{{ route('modules.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Module Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Module Type</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="version" class="form-label">Version</label>
                <input type="text" class="form-control" id="version" name="version">
            </div>
            <button type="submit" class="btn btn-primary">Register Module</button>
        </form>
    </section>

@endsection
