@extends('layouts.admin.master')

@section('content')	
     <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">
                        	Root Folders
                        	<a class="btn btn-primary btn-round btn-create" href="/admin/root/create"><i class="fas fa-plus"></i>&nbsp&nbspAdd New Root Folder</a>
                        </h3>
                    </div>
                    
                    <div class="card-body">
						@if (count($rootFolders)>0)
							<table class="table table-striped text-center">
								<thead>
									<tr>
										<th></th>
										<th>Name</th>
										<th>Description</th>
										<th>Created By</th>
										<th>Created On</th>
										<th>Last Modified On</th>
										<th colspan="2">Actions</th>
									</tr>
								</thead>
							@foreach($rootFolders as $folder)
								<tr>
									<td>
										<img class="img-thumbnail" src="{{ Storage::url($folder->image_path) }}" alt="{{$folder->name}}" style="max-width:70px">
									</td>
									<th scope="row">
										<i class="fas fa-folder"></i>&nbsp&nbsp<a href="/admin/root/{{ $folder->id }}">{{ $folder->name }}</a>
									</th>
									<td class="description-col">{{ $folder->description }}</td>
									<td>{{ $folder->admin->name }}</td>
									<td>{{ $folder->created_at->toFormattedDateString() }}</td>
									<td>{{ $folder->updated_at->toFormattedDateString() }}</td>
									<td>						
										<a class="btn btn-info btn-round" href="/admin/root/{{ $folder->id }}/edit"><i class="fas fa-pencil-alt"></i>&nbsp&nbspEdit</a>
									</td>
									<td>
										<form method="POST" action="/admin/root/{{ $folder->id }}">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-danger btn-round"><i class="fas fa-trash-alt"></i>&nbsp&nbspDelete</button>
										</form>
									</td>
								</tr>
							@endforeach
							</table>
						@else
							<p class="h5">There are no root folders yet.</p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection