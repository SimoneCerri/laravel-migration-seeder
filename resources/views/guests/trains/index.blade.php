@extends('layouts.app')

@section('page-title')
    Trains
@endsection

@section('page-main')
    <div class="container py-5 text-center">
        <div class="row">
            @forelse ($trains as $train)
                <div class="col-3">
                    <a href="{{ route('guests.trains.show', $train) }}">
                        <div class="card bg-secondary border-0">
                            <div class="card-title bg-dark text-danger">
                                {{ $train->company }}
                            </div>
                            <div class="card-body">
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
