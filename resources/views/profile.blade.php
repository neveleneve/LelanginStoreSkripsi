@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row justify-content-center">
                            <div class="col-6 col-xl-2">
                                <div class="ratio ratio-1x1">
                                    <img class="img-fluid mb-3 img-thumbnail rounded-circle"
                                        src="{{ asset('images/ajs.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4 class="fw-bold">{{ Auth::user()->name }}</h4>
                        <h6 class="fst-italic">
                            @if (Auth::user()->role == 1)
                                Administrator
                            @elseif (Auth::user()->role == 2)
                                Pelelang
                            @elseif (Auth::user()->role == 3)
                                Peserta
                            @endif
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
