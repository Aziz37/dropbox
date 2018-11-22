@extends('layouts.admin.master')

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	<h3 class="title">
                        	<a href="/admin/root">
                        	<i class="fas fa-arrow-left"></i></a> {{ $rootFolder->name }}
                        </h3>
                    </div>

                    <div class="card-body">
                    	<blockquote class="blockquote">
							<h5 class="title">Create new</h5>
							<h6>
								<div class="form-group">
									<select class="form-control" id="selection">
										<option value="" selected="selected">choose option</option>
										<option value="subfolder">folder</option>
										<option value="file">file</option>
									</select>
								</div>
	
								<form method="POST" action="/admin/folders" id="subfolder" style="display:none"> 
									@csrf
									<div class="form-group">
										<label for="name">Folder Name: </label>
										<input type="text" class="form-control" name="name" required>
									</div>
									<input type="hidden" name="root_id" value="{{$rootFolder->id}}">
									<button type="submit" class="btn btn-primary btn-round">Create</button>
								</form>

								<form method="POST" action="/admin/files/upload" id="file" enctype="multipart/form-data" style="display:none">
									@csrf
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="file[]" multiple>
										<label class="custom-file-label" for="customFile">Choose file(s) to upload</label>

										<input type="hidden" name="root_id" value="{{ $rootFolder->id }}">
									</div>
									<button type="submit" class="btn btn-primary btn-round">Upload</button>
								</form>
							</h6>
						</blockquote>

						<table class="table table-striped text-center">
							<thead>
								<tr>
									<th>Name</th>
									<th>Created By</th>
									<th>Created On</th>
									<th>Last Modified On</th>
									<th colspan=2>Actions</th>
								</tr>
							</thead>
							@foreach($rootFolder->folders as $folder)
								<tr>
									<th scope="row">
										<i class="fas fa-folder"></i>&nbsp&nbsp
										<a href="/admin/folders/{{ $folder->id }}">
											{{ $folder->name }}
										</a>	
									</th>
									<td>{{$folder->admin->name}}</td>
									<td>{{$folder->created_at->toFormattedDateString()}}</td>
									<td>{{$folder->updated_at->toFormattedDateString()}}</td>
									<td>						
										<a class="btn btn-info btn-round" href="/admin/folders/{{ $folder->id }}/edit"><i class="fas fa-pencil-alt"></i>&nbsp&nbspEdit</a>
									</td>
									<td>
										<form method="POST" action="/admin/folders/{{ $folder->id }}">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-danger btn-round"><i class="fas fa-trash-alt"></i>&nbsp&nbspDelete</button>
										</form>
									</td>
								</tr>
							@endforeach
							@foreach($rootFolder->files as $fileContents)
								<tr>
									<th scope="row">
										<i class="fas fa-file"></i>	
										{{ $fileContents->filename }}</th>
									@if(isset($fileContents->user->name))
										<td>{{ $fileContents->user->name }}</td>
									@elseif(isset($fileContents->admin->name))
										<td>{{ $fileContents->admin->name }}</td>
									@endif

									<td>{{ $fileContents->created_at->toFormattedDateString() }}</td>
									<td>{{ $fileContents->updated_at->toFormattedDateString() }}</td>
									<td>
										<a class="btn btn-info btn-round" href="/admin/file/download/{{ $fileContents->id }}"><i class="fas fa-download"></i>&nbsp&nbspDownload</a>
									</td>
									<td>
										<form method="POST" action="/admin/file/{{ $fileContents->id }}">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-danger btn-round"><i class="fas fa-trash-alt"></i>&nbsp&nbspDelete</button>
										</form>
									</td>

								</tr>
							@endforeach
						</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection