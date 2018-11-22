@extends('layouts.admin.master')

@section('content')
	<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">
                        	@if ($folder->parent_id == 0)
                        		<a href="/admin/root/{{$folder->root_id}}">
                        	@else
                        		<a href="/admin/folders/{{$folder->parent_id}}">
                        	@endif
                        	<i class="fas fa-arrow-left"></i></a> {{ $folder->name }}
                        </h3>
                    </div>
                    
                    <div class="card-body">
						<h5>
							<form method="POST" action="/admin/folders/{{ $folder->id }}">
								@method('PATCH')
								@csrf
								<div class="form-group">
	    							<label for="name">Folder Name:</label>
	    							<input type="text" class="form-control" name="name" value="{{ $folder->name }}" required>
	    						</div>
								<button type="submit" class="btn btn-primary btn-round">Edit</button>
							</form>
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection