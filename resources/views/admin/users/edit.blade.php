@extends('layouts.admin.master')

@section('content')
	<div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    
                    <div class="card-header">
                        <h3 class="title">
   							<a href="/admin/users"><i class="fas fa-arrow-left"></i></a>
                        	Edit User Details
   						</h3>
   					</div>
   					 <div class="card-body">
						<h6>
							<form method="POST" action="/admin/users/{{ $user->id }}">
								@method('PATCH')
								@csrf
								<div class="form-group">
									<label for="name">Name</label>
									<input class="form-control" type="text" name="name" value="{{ $user->name }}" disabled>
								</div>
								<div class="form-group">
									<label for="user_type">User Type</label>
									<select class="form-control" name="user_type">
										<option value="contributor">Contributor</option>
										<option value="explorer">Explorer</option>
									</select>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
								</div>
								<div class="form-group">
									<label for="department">Department</label>
									<input class="form-control" type="text" name="department" value="{{ $user->department }}" required>
								</div>
								<button type="submit" class="btn btn-primary btn-round">Change</button>
							</form>
						</h6>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h3 class="title">
							Change Password
						</h3>
					</div>
					<div class="card-body">
						<h6>
							<form method="POST" action="/admin/users/{{ $user->id }}">
								@method('PATCH')
								@csrf
								<div class="form-group">
									<label for="password">New Password </label>
									<input type="password" class="form-control" name="password" placeholder="enter new password">
								</div>
								<div class="form-group">
										<label for="password-confirm">Confirm Password</label>
										<input type="password" class="form-control" name="password_confirmation" placeholder="confirm password">
								</div>
								<button type="submit" class="btn btn-primary btn-round" style="float:right">Change Password</button>
							</form>
						</h6>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="title">
							Folder Access List
						</h3>
					</div>
					<div class="card-body">
						<table class="table table-striped text-center">
							<thead>
								<tr>
									<th></th>
									<th>Name</th>
									<th>Created By</th>
									<th>Department</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($folders as $folder)
									<tr>
										<td><i class="fas fa-folder"></i></td>
										<td>{{$folder->name}}</td>
										<td>{{$folder->admin->name}}</td>
										<td>{{$folder->admin->department}}</td>
										<td>
											@if($user->folders()->where('user_id', '=', $user->id)->exists() && $user->folders()->where('folder_id', '=', $folder->id)->exists())
												<form method="post" action="/admin/folders/access/{{$user->id}}">
													@method('DELETE')
													@csrf
													<input type="hidden" name="user_id" value="{{$user->id}}">
													<input type="hidden" name="folder_id" value="{{$folder->id}}">
													<button type="submit" class="btn btn-danger btn-round"><i class="fas fa-lock"></i>&nbsp&nbspRevoke Access</button>
												</form>
											@else
												<form method="post" action="/admin/folders/access">
													@csrf
													<input type="hidden" name="user_id" value="{{$user->id}}">
													<input type="hidden" name="folder_id" value="{{$folder->id}}">
													<button type="submit" class="btn btn-success btn-round"><i class="fas fa-lock-open"></i>&nbsp&nbspGrant Access</button>
												</form>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection