@extends('layouts.admin.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Search Results for <em>"{{ $query }}"</em></h3>
                    </div>
                    <div class="card-body">
					@if(count($adminResults)>0 || count($userResults)>0 || count($folderResults)>0 || count($fileResults)>0)	
						@if(count($adminResults)>0)
						<div class="row">
							<div class="col-4">
								<div class="list-group" id="list-tab" role="tablist">
									<a class="list-group-item list-group-item-action active" id="list-root-list" data-toggle="list" href="#list-root" role="tab" aria-controls="root">Root Folders</a>
									<a class="list-group-item list-group-item-action" id="list-folders-list" data-toggle="list" href="#list-folders" role="tab" aria-controls="folders">Folders</a>
									<a class="list-group-item list-group-item-action" id="list-adminFiles-list" data-toggle="list" href="#list-adminFiles" role="tab" aria-controls="adminFiles">Admin Files</a>
								</div>
							</div>
							<div class="col-8">
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="list-root" role="tabpanel" aria-labelledby="list-root-list">
										@foreach($adminResults as $admin)
											@foreach($admin->roots->chunk(2) as $chunk)
												<div class="row">
													@foreach($chunk as $rootFolder)
														<div class="col-md-6">
															<h5>
																<div class="card content-card">
																	<div class="card-body">
																		<i class="fas fa-folder"></i>&nbsp&nbsp<a href="/admin/root/{{$rootFolder->id}}">{{$rootFolder->name}}</a>
																	</div>
																</div>
															</h5>
														</div>
													@endforeach
												</div>
											@endforeach
										@endforeach
									</div>
									<div class="tab-pane fade" id="list-folders" role="tabpanel" aria-labelledby="list-folders-list">
										@foreach($adminResults as $admin)    		
						            		@foreach($admin->folders->chunk(2) as $chunk)
						            			<div class="row">
						                    		@foreach($chunk as $folder)
						                    			<div class="col-md-6">
						                				    <h5>
						                                        <div class="card content-card">
						                                            <div class="card-body"> 
						                					           <i class="fas fa-folder"></i>&nbsp&nbsp<a href="/admin/folders/{{$folder->id}}">{{$folder->name}}</a>
						                					       </div>
						                					   </div>
						                					</h5>
						                				</div>
						                    		@endforeach
						                		</div>
						                	@endforeach
						                @endforeach
									</div>
									<div class="tab-pane fade" id="list-adminFiles" role="tabpanel" aria-labelledby="list-adminFiles-list">
										@foreach($adminResults as $admin)
											@if(count($admin->files)>0)
											@foreach($admin->files->chunk(2) as $chunks)
					                			<div class="row">
						                    		@foreach($chunks as $file)
						                    			<div class="col-md-6">
					                    				    <h5>
					                                            <div class="card content-card">
					                                                <div class="card-body"> 
					                    					           <i class="fas fa-download"></i>&nbsp&nbsp<a href="/admin/file/download/{{$file->id}}">{{$file->filename}}</a>
					                    					       </div>
					                    					   </div>
					                    					</h5>
					                    				</div>
						                    		@endforeach
					                    		</div>
					                    	@endforeach
					                    	@else
					                    		<p class="h5">No files found</p>
					                    	@endif
						                @endforeach
									</div>
								</div>
							</div>
						</div>
						@endif
						@if(count($userResults)>0)
							<div class="row">
								<div class="col-4">
									<div class="list-group" id="list-tab" role="tablist">
										<a class="list-group-item list-group-item-action active" id="list-userProfiles-list" data-toggle="list" href="#list-userProfiles" role="tab" aria-controls="userProfiles">User Profiles</a>
										<a class="list-group-item list-group-item-action" id="list-userFiles-list" data-toggle="list" href="#list-userFiles" role="tab" aria-controls="userFiles">User Files</a>
									</div>
								</div>
								<div class="col-8">
									<div class="tab-content" id="nav-tabContent">
										<div class="tab-pane fade show active" id="list-userProfiles" role="tabpanel" aria-labelledby="list-userProfiles-list">
										@foreach($userResults->chunk(2) as $chunks)
											<div class="row">
												@foreach($chunks as $user)
													<div class="col-md-6">
														<h5>
															<div class="card content-card">
																<div class="card-body">
																<i class="fas fa-user"></i>&nbsp&nbsp<a href="/admin/users/{{$user->id}}/edit">{{$user->name}}</a>
																</div>
															</div>
														</h5>
													</div>
												@endforeach
											</div>
										@endforeach
										<div class="tab-pane fade" id="list-userFiles" role="tabpanel" aria-labelledby="list-userFiles-list">
										@foreach($userResults as $user)
											@if(count($user->files)>0)
											@foreach($user->files->chunk(2) as $chunks)
					                			<div class="row">
						                    		@foreach($chunks as $file)
						                    			<div class="col-md-6">
					                    				    <h5>
					                                            <div class="card content-card">
					                                                <div class="card-body"> 
					                    					           <i class="fas fa-download"></i>&nbsp&nbsp<a href="/admin/file/download/{{$file->id}}">{{$file->filename}}</a>
					                    					       </div>
					                    					   </div>
					                    					</h5>
					                    				</div>
						                    		@endforeach
					                    		</div>
					                    	@endforeach
					                    	@else
					                    		<p class="h5">No files found</p>
					                    	@endif
						                @endforeach
									</div>
								</div>
							</div>
						</div>
						@endif
						@if(count($folderResults)>0)
							<div class="row">
								<div class="col-4">
									<div class="list-group" id="list-tab" role="tablist">
										<a class="list-group-item list-group-item-action active" id="list-folders-list" data-toggle="list" href="#list-folders" role="tab" aria-controls="folders">Folders</a>
										<a class="list-group-item list-group-item-action" id="list-files-list" data-toggle="list" href="#list-files" role="tab" aria-controls="files">Files</a>
									</div>
								</div>
								<div class="col-8">
									<div class="tab-content" id="nav-tabContent">
										<div class="tab-pane fade active show" id="list-folders" role="tabpanel" aria-labelledby="list-folders-list">
										@foreach($folderResults->chunk(2) as $chunk)
			                                <div class="row">
			                    		        @foreach($chunk as $folderResult)
			                    			        <div class="col-md-6">
			                        				    <h5>
			                                                <div class="card content-card">
			                                                    <div class="card-body"> 
			                        					           <i class="fas fa-folder"></i>&nbsp&nbsp<a href="/admin/folders/{{ $folderResult->id }}">{{ $folderResult->name }}</a>
			                                                    </div>
			                                                </div>
			                    					   </h5>
			                    			         </div>
			                    		        @endforeach
			                                </div>
			                            @endforeach
										</div>
										<div class="tab-pane fade" id="list-files" role="tabpanel" aria-labelledby="list-files-list">
											@if(count($fileResults)>0)
											@foreach($fileResults->chunk(2) as $chunks)
				                                <div class="row">
				                                    @foreach($chunks as $fileResult)
				                                        <div class="col-md-6">
				                                            <h5>
				                                                <div class="card content-card">
				                                                    <div class="card-body">
				                                                        <i class="fas fa-download"></i>&nbsp&nbsp<a href="/admin/file/download/{{ $fileResult->id }}">{{ $fileResult->filename }}</a>
				                                                    </div>
				                                                </div>
				                                            </h5>
				                                        </div>
				                                    @endforeach
				                                </div>
				                            @endforeach
				                            @else
				                            	<p class="h5">No files found</p>
				                            @endif
										</div>
									</div>
								</div>
							</div>
						@endif
					@else
						<p class="h5">No Results found</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection