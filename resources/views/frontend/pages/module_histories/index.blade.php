@extends('layouts.frontend')

@section('title', 'WEBREATHE - Home')

@section('content')

    <section class="container">

        <h2>Module Histories</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Operation At</th>
                    <th>Measured Value</th>
                    <th>Data Items Sent</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $history->status }}</td>
                        <td>{{ $history->operation_at }}</td>
                        <td>{{ $history->measured_value }}</td>
                        <td>{{ $history->data_items_sent }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $histories->links() }}

        <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back</a>

    </section>

@endsection
