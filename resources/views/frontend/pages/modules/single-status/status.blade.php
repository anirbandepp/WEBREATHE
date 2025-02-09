@extends('layouts.frontend')

@section('title', 'WEBREATHE - Home')

@section('content')

    <section class="container">


        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Module Operating Status</h2>

            <a href="{{ route('modules.index') }}" class="btn btn-primary">Go Back</a>
        </div>

        @foreach ($modules as $module)
            @php
                $latestHistory = $module->histories;
                $isMalfunctioning = false;
                $malfunctionMessage = '';

                $hasIssue = collect($latestHistory)->contains(
                    fn($latestHistory) => in_array($latestHistory->status, ['inactive', 'error']),
                );

                if ($latestHistory) {
                    $isMalfunctioning = true;
                    $malfunctionMessage = 'Module is not active!';
                }
            @endphp

            <div class="card mb-3 {{ $isMalfunctioning ? 'border-danger' : 'border-success' }}">

                <div class="card-header d-flex justify-content-between">
                    <h5>{{ $module->name }} ({{ $module->type }})</h5>

                    @if ($isMalfunctioning)
                        <span class="badge bg-danger">⚠ Malfunction</span>
                    @else
                        <span class="badge bg-success">✔ Operational</span>
                    @endif
                </div>

                <div class="card-body">
                    @if ($module->histories->isNotEmpty())
                        @php $latestHistory = $module->histories->first(); @endphp
                        <p><strong>Measured Value:</strong> {{ $latestHistory->measured_value ?? 'N/A' }}</p>
                        <p><strong>Operating Time:</strong> {{ $latestHistory->operating_time ?? 'N/A' }}</p>
                        <p><strong>Data Items Sent:</strong> {{ $latestHistory->data_items_sent }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($latestHistory->status) }}</p>

                        @if ($isMalfunctioning)
                            <div class="alert alert-danger">
                                <strong>⚠ Warning:</strong> {{ $malfunctionMessage }}
                            </div>
                        @endif

                        <!-- Chart -->
                        <canvas id="chart-{{ $module->id }}" width="400" height="200"></canvas>

                        <!-- Include Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var ctx = document.getElementById("chart-{{ $module->id }}").getContext("2d");
                                var chart = new Chart(ctx, {
                                    type: "line",
                                    data: {
                                        labels: {!! json_encode($module->histories->pluck('operation_at')->map(fn($date) => $date)) !!},
                                        datasets: [{
                                            label: "Measured Value",
                                            data: {!! json_encode($module->histories->pluck('measured_value')) !!},
                                            borderColor: "blue",
                                            fill: false
                                        }]
                                    }
                                });
                            });
                        </script>
                    @else
                        <p>No history available for this module.</p>
                    @endif
                </div>
            </div>
        @endforeach

    </section>

@endsection
