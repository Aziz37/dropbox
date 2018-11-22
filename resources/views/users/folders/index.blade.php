@extends('layouts.user.master')

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    	<h3 class="title">
                        	<a href="/users/explore">
                        	<i class="fas fa-arrow-left"></i></a> {{ $rootFolder->name }}
                        	@if(Auth::user()->user_type == 'contributor')
	                        	<button type="button" class="btn btn-primary btn-round btn-create" data-toggle="modal" data-target=".bd-example-modal-lg">
	                        		<i class="fas fa-plus"></i>&nbsp&nbspUpload Files
	                        	</button>
	                        	</h3>
			                    <div class="modal fade bd-example-modal-lg" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="uploadFile" aria-hidden="true">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="uploadFile">Upload files to {{ $rootFolder->name }}:</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form method="POST" action="/users/files/upload" id="file" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="root_id" value="{{ $rootFolder->id }}">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="customFile" name="file[]" multiple required>
												<label class="custom-file-label" for="customFile">Choose file</label>
											</div>
											<button type="submit" class="btn btn-info">Upload</button>
										</form>
								      </div>
								    </div>
								  </div>
								</div>
							@endif
						</h3>
                    </div>

                    <div class="card-body">
                    	@if($rootFolder->name == 'Insight Vault')
							<h3>Industries:</h3>
						@elseif($rootFolder->name == 'Innovation Toolkit')
							<div class="text-center">
                                <h3>Journey</h3>
                                <img src="{{ asset('img/innovation-toolkit-journey.png') }}">
                            </div>
                        @endif

						@foreach($rootFolder->folders->chunk(2) as $chunk)
							<div class="row">
								@foreach($chunk as $folder)
									<div class="col-md-6">
										<h5>
		                					<div class="card content-card">
		            							<div class="card-body">	
		                							<i class="fas fa-folder"></i><a href="/users/folders/{{ $folder->id }}">&nbsp&nbsp{{ $folder->name }}</a>
		                						</div>
		                					</div>
		            					</h5>
	                				</div>
	                			@endforeach
							</div>
						@endforeach
						
						@foreach($rootFolder->files->chunk(2) as $chunky)
							<div class="row">
								@foreach($chunky as $fileContents)
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection