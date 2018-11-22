@extends('layouts.user.master')

@section('content')
	<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Start Exploring</h5>
                    </div>
                    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::guard('web')->check())
                            <p class="h5">Do you have an innovative idea to solve customer problems? Start an exploration sprint in Business Innovation framework with these tools and insights:</p>
                            @foreach($rootFolders->chunk(2) as $chunk)
                                <div class="row">
                    		        @foreach($chunk as $rootFolder)
                    			        <div class="col-md-6">
                    			        	<a href="/users/root/{{ $rootFolder->id }}">
                    			        		<div class="img-wrap">
                    			        			<img src="{{ Storage::url($rootFolder->image_path) }}" alt="{{ $rootFolder->name }}">
                    			        			<p class="img-description text-center">{{ $rootFolder->name }}</p>
                    			        		</div>
                    			        	</a>
                    			        </div>
                    			    @endforeach
                    			</div>
                        	@endforeach		
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection