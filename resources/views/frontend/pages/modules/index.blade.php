@extends('layouts.frontend')

@section('title', 'WEBREATHE - Home')

@section('content')

    <section class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Modules</h2>
            <a href="{{ route('modules.create') }}" class="btn btn-primary">Add Module</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $module)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->type }}</td>
                        <td>{{ $module->details->description }}</td>
                        <td>
                            <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('modules.destroy', $module->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            <a href="{{ route('module_details.index', $module->id) }}" class="btn btn-info btn-sm">
                                Details
                            </a>
                            <a href="{{ route('module_histories.index', $module->id) }}" class="btn btn-secondary btn-sm">
                                History
                            </a>
                            <a href="{{ route('modules.sinleStatus', $module->id) }}" class="btn btn-dark btn-sm">
                                Status
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@endsection
