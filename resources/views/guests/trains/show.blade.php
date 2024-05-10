@extends('layouts.app')

@section('page-title')
    Single Train
@endsection

@section('page-main')
    <div class="container py-5 text-center">
        <div class="card bg-secondary border-0">
            <div class="card-title bg-dark text-danger">
                {{ $train->company }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4 text-warning">
                        Code: <span class="text-danger">{{ $train->train_code }}</span>
                    </div>
                    <div class="col-4 text-warning">
                        Carriages: <span class="text-danger">{{ $train->number_of_carriages }}</span>
                    </div>
                    <div class="col-4 text-warning">
                        On Time: <span class="text-danger">
                            @if ($train->on_time)
                                <span>Yes</span>
                            @else
                                <span>
                                    Nope
                                </span>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
