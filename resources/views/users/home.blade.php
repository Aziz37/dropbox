@extends('layouts.user.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::guard('web')->check())
                            <div class="card-body">
                                <img src="{{ asset('img/team.png') }}" class="rounded float-right" alt="team">
                                <p class="h5">Business Innovation works as an open innovation funnel for Grameenphone. Fostering focused innovation, incubation managers in the team look into new problems, create prototypes and validate them in the market.</p>

                                <p class="h5">This department also works as a platform for employees from other functions to come and explore problems and validate ideas</p>

                                <h5 class="title">Continually exploring</h5>
                                <p class="h5">For us, digital transformation is constant - not a one-off event. It's our obsession. We continually experiment with ways to make our journeys more intuitive, simple and enjoyable. Take a look at what we've been working on recently:</p>
                                <p>
                                    <img src="{{ asset('img/liquid-eye.jpg') }}" class="rounded float-left" alt="liquid-eye">
                                    <img src="{{ asset('img/liquid-eye-logo.jpg') }}" class="rounded float-left" alt="liquid-eye">
                                </p>
                                <p>
                                    <img src="{{ asset('img/eagle-eye.jpg') }}" class="rounded float-right" alt="eagle-eye">
                                    <img src="{{ asset('img/eagle-eye-logo.jpg') }}" class="rounded float-right" alt="eagle-eye">
                                </p>
                                <p>
                                    <img src="{{ asset('img/digi-cow.jpg') }}" class="rounded float-left" alt="digi-cow">
                                    <img src="{{ asset('img/digi-cow-logo.jpg') }}" class="rounded float-left" alt="digi-cow">
                                </p>
                            </div>
                                           
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
