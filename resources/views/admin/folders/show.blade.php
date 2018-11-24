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
                    	<blockquote class="blockquote">
                    		<h5 class="title">Create new</h5>
							<h6>
								<div class="form-group">
									<select class="form-control" id="selection">
										<option value="" selected="selected">choose option</option>
										<option value="subfolder">folder</option>
										<option value="file">file</option>
										<option value="video">video</option>
									</select>
								</div>

								<form method="POST" action="/admin/folders" id="subfolder" style="display:none"> 
									@csrf
									<div class="form-group">
										<label for="name">Folder Name: </label>
										<input type="text" class="form-control" name="name" required>
									</div>
									
									<input type="hidden" name="parent_id" value="{{ $folder->id }}">

									<button type="submit" class="btn btn-primary btn-round">Create</button>
								</form>

								<form method="POST" action="/admin/files/upload" id="file" enctype="multipart/form-data" style="display:none">
									@csrf
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="file[]" multiple>
										<label class="custom-file-label" for="customFile">Choose file(s) to upload</label>

										<input type="hidden" name="folder_id" value="{{ $folder->id }}">
									</div>
									<button type="submit" class="btn btn-primary btn-round">Upload</button>
								</form>

								<form method="POST" action="/admin/videos/upload" id="video" style="display:none">
									@csrf
									<div class="form-group">
										<label for="name">Video Name: </label>
										<input type="text" class="form-control" name="video_name" required>
									</div>
									<div class="form-group">
										<label for="name">Video Link: </label>
										<input type="text" class="form-control" name="url" required>
									</div>
									<input type="hidden" name="folder_id" value="{{$folder->id}}">
									<button type="submit" class="btn btn-primary btn-round">Save Video</button>
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
							@foreach($subfolders as $subfolder)
								<tr>
									<th scope="row">
										<i class="fas fa-folder"></i>&nbsp&nbsp
										<a href="/admin/folders/{{ $subfolder->id }}">
											{{ $subfolder->name }}
										</a>	
									</th>
									<td>{{$subfolder->admin->name}}</td>
									<td>{{ $subfolder->created_at->toFormattedDateString() }}</td>
									<td>{{ $subfolder->updated_at->toFormattedDateString() }}</td>
									<!-- <td>
										<a class="btn btn-warning btn-round" href="/admin/folders/{{ $subfolder->id }}"><i class="fas fa-eye"></i>&nbsp&nbspView</a>
									</td> -->
									<td>
										<a class="btn btn-info btn-round" href="/admin/folders/{{ $subfolder->id }}/edit"><i class="fas fa-pencil-alt"></i>&nbsp&nbspEdit</a>
									</td>
									<td>
										<form method="POST" action="/admin/folders/{{ $subfolder->id }}">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-danger btn-round"><i class="fas fa-trash-alt"></i>&nbsp&nbspDelete</button>
										</form>
									</td>
								</tr>	
							@endforeach
							@foreach($folder->files as $fileContents)
								<tr>
									<th scope="row">
										<i class="fas fa-file"></i>	
										{{ $fileContents->filename }}
									</th>
									@if(isset($fileContents->user->name))
										<td>{{ $fileContents->user->name }}</td>
									@elseif(isset($fileContents->admin->name))
										<td>{{ $fileContents->admin->name }}</td>
									@endif
									<td>{{$fileContents->created_at->toFormattedDateString() }}</td>
									<td>{{ $fileContents->updated_at->toFormattedDateString() }}</td>
									<!-- <td>
										<a class="btn btn-warning btn-round" href="#" target="_blank"><i class="fas fa-eye"></i>&nbsp&nbspView</a> 
									</td> -->
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
							@foreach($folder->videos as $video)
								<tr>
									<th scope="row">
										<i class="fas fa-file-video"></i>&nbsp&nbsp{{$video->video_name}}
									</th>
									@if(isset($video->user->name))
										<td>{{ $video->user->name }}</td>
									@elseif(isset($video->admin->name))
										<td>{{ $video->admin->name }}</td>
									@endif
									<td>{{ $video->created_at->toFormattedDateString() }}</td>
									<td>{{ $video->updated_at->toFormattedDateString() }}</td>
									<td>
										<a class="btn btn-info btn-round" href="/admin/videos/view/{{ $video->id }}"><i class="fas fa-eye"></i>&nbsp&nbspView Video</a>
									</td>
									<td>
										<form method="POST" action="/admin/videos/{{ $video->id }}">
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