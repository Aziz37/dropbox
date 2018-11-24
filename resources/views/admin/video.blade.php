@extends('layouts.admin.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">
                        	<a href="{{ URL::previous() }}"><i class="fas fa-arrow-left"></i></a> {{ $video->video_name }}
                        </h3>
                    </div>

                    <div class="card-body text-center">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$values}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection