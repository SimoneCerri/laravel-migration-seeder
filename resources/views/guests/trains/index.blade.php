@extends('layouts.app')

@section('page-title')
    Trains
@endsection

@section('page-main')
    <div class="container py-5 text-center">
        <div class="row">
            @forelse ($trains as $train)
                <div class="col">
                    <div class="card">
                        <div class="card-title">
                            {{$train->company}}
                        </div>
                        <div class="card-body">
                            {{$train->train_code}}
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    Nothing to show..
                </div>
            @endforelse
        </div>
    </div>
@endsection
