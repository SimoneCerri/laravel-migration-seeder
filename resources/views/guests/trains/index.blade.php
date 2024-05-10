@extends('layouts.app')

@section('page-title')
    Trains
@endsection

@section('page-main')
    <div class="container py-5 text-center">
        <div class="row g-3">
            @forelse ($trains as $train)
                <div class="col-3">
                    <a href="{{ route('guests.trains.show', $train) }}">
                        <div class="card h-100 bg-secondary border-0">
                            <div class="card-title bg-dark text-danger">
                                {{ $train->company }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row flex-column justify-content-center align-items-center">
                                            <div class="col-6 w-100">
                                                <span class="text-warning">Departure: </span>
                                            </div>
                                            <div class="col-6 w-100">
                                                <span>{{ $train->departure_station }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6 w-100">
                                                <span class="text-warning">Arrival: </span>
                                            </div>
                                            <div class="col-6 w-100">
                                                <span>{{ $train->arrival_station }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                {{ $train->train_code }}
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div>
                    Nothing to show..
                </div>
            @endforelse
        </div>
    </div>
@endsection
