@extends('layouts.admin.master')

@section('content')
	<div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">
                        	<a href="/admin/root">
                        	<i class="fas fa-arrow-left"></i></a> {{$rootFolder->name}}
                        </h3>
                    </div>
                    
                    <div class="card-body">
						<h5>
							
							<form method="POST" action="/admin/root/{{$rootFolder->id}}" enctype="multipart/form-data"> 
								@method('PATCH')
								@csrf

								<div class="form-group">
									<label for="image">Folder Image :</label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="image">
										<label class="custom-file-label" for="customFile">choose an image</label>
									</div>
								</div>
								<div class="form-group">
									<label for="name">Folder Name * : </label>
									<input type="text" class="form-control" name="name" value="{{$rootFolder->name}}" required>
								</div>
								<div class="form-group">
									<label for="description">Folder Description * : </label>
									<textarea class="form-control" name="description" required>{{$rootFolder->description}}</textarea>
								</div>
								
								<button type="submit" class="btn btn-primary btn-round">Update</button>
							</form>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h5>Current Folder Image</h5>
					</div>
					<div class="card-body">
						<div class="text-center">
							<img src="{{ Storage::url($rootFolder->image_path) }}" class="img-fluid " alt="{{$rootFolder->name}}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection