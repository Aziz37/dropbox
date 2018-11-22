@extends('layouts.admin.master')

@section('content')
	<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">
                        	<a href="/admin/root">
                        	<i class="fas fa-arrow-left"></i></a> Create a New Root Folder
                        </h3>
                    </div>
                    
                    <div class="card-body">
						<h5>
							<form method="POST" action="/admin/root" enctype="multipart/form-data"> 
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
									<input type="text" class="form-control" name="name" required>
								</div>
								<div class="form-group">
									<label for="description">Folder Description * : </label>
									<textarea class="form-control" name="description" required></textarea>
								</div>
								
								<button type="submit" class="btn btn-primary btn-round">Create</button>
							</form>
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection