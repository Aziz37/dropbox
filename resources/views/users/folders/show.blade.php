@extends('layouts.user.master')

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	<h3 class="title">
                        	@if ($folder->parent_id == 0)
                        		<a href="/users/root/{{$folder->root_id}}">
                        	@else
                        		<a href="/users/folders/{{$folder->parent_id}}">
                        	@endif
                        	<i class="fas fa-arrow-left"></i></a> {{ $folder->name }}
                        @if(Auth::user()->user_type == 'contributor')
	                        	<button type="button" class="btn btn-primary btn-round btn-create" data-toggle="modal" data-target=".bd-example-modal-lg">
	                        		<i class="fas fa-plus"></i>&nbsp&nbspUpload
	                        	</button>
	                        	</h3>
			                    <div class="modal fade bd-example-modal-lg" id="upload" tabindex="-1" role="dialog" aria-labelledby="upload" aria-hidden="true">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="upload">Upload new&nbsp&nbsp</h5>
								        <div class="form-group">
												<select class="form-control" id="selection">
													<option value="" selected="selected">choose option</option>
													<option value="file">file</option>
													<option value="video">video</option>
												</select>
											</div>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form method="POST" action="/users/files/upload" id="file" enctype="multipart/form-data" style="display:none">
											@csrf
											<input type="hidden" name="folder_id" value="{{ $folder->id }}">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="customFile" name="file[]" multiple required>
												<label class="custom-file-label" for="customFile">Choose file</label>
											</div>
											<button type="submit" class="btn btn-info">Upload</button>
										</form>

										<form method="POST" action="/users/videos/upload" id="video" style="display:none">
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
								      </div>
								    </div>
								  </div>
								</div>
							@endif
						</h3>
                    </div>

                    <div class="card-body">
                    	<h3>Contents:</h3>
						@foreach($subfolders->chunk(2) as $chunk)
							<div class="row">
								@foreach($chunk as $subfolder)
									<div class="col-md-6">
		                				<h5>
		                					<div class="card content-card">
		            							<div class="card-body">	
		                							<i class="fas fa-folder"></i><a href="/users/folders/{{ $subfolder->id }}">&nbsp&nbsp{{ $subfolder->name }}</a>
		                						</div>
		                					</div>
		            					</h5>
	                				</div>
	                			@endforeach
	            			</div>
	            		@endforeach

	            		@foreach($folder->files->chunk(2) as $chunks)
	            			<div class="row">
	            				@foreach($chunks as $fileContents)
	            					<div class="col-md-6">
		            					<h5>
		            						<div class="card content-card">
		            							<div class="card-body">	
			            							<i class="fas fa-file"></i>&nbsp&nbsp{{ $fileContents->filename }} 
												@if(Auth::user()->user_type == 'contributor')
												<span class="fa-stack pull-right">
												<a href="/users/file/{{$fileContents->id}}" onclick="event.preventDefault(); document.getElementById('delete-file_{{$fileContents->id}}').submit();">
													<i class="fa fa-circle fa-stack-2x icon-background-delete"></i>
													<i class="far fa-circle fa-stack-2x icon-background-outer-delete"></i>
													<i class="fas fa-trash fa-stack-1x"></i>
												</a>
												<form id="delete-file_{{$fileContents->id}}" action="/users/file/{{$fileContents->id}}" method="POST" style="display: none;">
													@method('DELETE')
                    								@csrf
                								</form>
											</span>
											@endif
											<span class="fa-stack pull-right">
												<a href="/users/file/download/{{ $fileContents->id }}">
													<i class="fa fa-circle fa-stack-2x icon-background-download"></i>
													<i class="far fa-circle fa-stack-2x icon-background-outer-download"></i>
													<i class="fas fa-download fa-stack-1x"></i>
												</a>
											</span>
			            						</div>
			            					</div>
		            					</h5>
	            					</div>
	            				@endforeach
	            			</div>
	            		@endforeach

	            		@foreach($folder->videos->chunk(2) as $chunk)
							<div class="row">
								@foreach($chunk as $video)
									<div class="col-md-6">
										<h5>
										<div class="card content-card">
										<div class="card-body">
											<i class="fas fa-file-video"></i>&nbsp&nbsp{{$video->video_name}}
											@if(Auth::user()->user_type == 'contributor')
											<span class="fa-stack pull-right">
												<a href="/users/videos/{{$video->id}}" onclick="event.preventDefault(); document.getElementById('delete-file_{{$video->id}}').submit();">
													<i class="fa fa-circle fa-stack-2x icon-background-delete"></i>
													<i class="far fa-circle fa-stack-2x icon-background-outer-delete"></i>
													<i class="fas fa-trash fa-stack-1x"></i>
												</a>
												<form id="delete-file_{{$video->id}}" action="/users/videos/{{$video->id}}" method="POST" style="display: none;">
													@method('DELETE')
                    								@csrf
                								</form>
											</span>
											@endif
											<span class="fa-stack pull-right">
												<a href="/users/videos/view/{{ $video->id }}">
													<i class="fa fa-circle fa-stack-2x icon-background-download"></i>
													<i class="far fa-circle fa-stack-2x icon-background-outer-download"></i>
													<i class="fas fa-eye fa-stack-1x"></i>
												</a>
											</span>
										</div>
									</div>
									</h5>
									</div>
								@endforeach
							</div>
						@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection