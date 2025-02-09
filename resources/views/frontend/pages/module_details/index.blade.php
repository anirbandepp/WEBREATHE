@extends('layouts.frontend')

@section('title', 'WEBREATHE - Home')

@section('content')

    <section class="container">
        <h2>Module Details</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Detail Name</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->description }}</td>
                        <td>{{ $detail->version }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back</a>
    </section>

@endsection
