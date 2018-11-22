@extends('layouts.admin.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">ADMIN DASHBOARD</h5>
                    </div>
                    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::guard('admin')->check())
                        <p> Welcome <strong>{{ Auth::user()->name }}</strong> </p>

                        <p> You are now logged in!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
