@extends('layouts.admin.master')

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-header">
                        <h3 class="title">
                        	<a href="/admin/users"><i class="fas fa-arrow-left"></i></a>
                        	Create a New User
                        </h3>
                    </div>
                    
                    <div class="card-body">
						<h6>
							<form method="post" action="/admin/users">
								@csrf
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" name="name" required>
								</div>
								<div class="form-group">
									<label for="user_type">User Type</label>
									<select class="form-control" name="user_type">
										<option value="" selected="selected">Choose User Type</option>
										<option value="contributor">Contributor</option>
										<option value="explorer">Explorer</option>
									</select>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" name="email" required>
								</div>
								<div class="form-group">
									<label for="email">Department</label>
									<input type="text" class="form-control" name="department" required>
								</div>
								<div class="form-row">
									<div class="col">
										<label for="password">Password</label>
										<input type="password" class="form-control" name="password" required>
									</div>
									<div class="col">
										<label for="password-confirm">Confirm Password</label>
										<input type="password" class="form-control" name="password_confirmation" required>
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-round">Create user</button>
							</form>
						</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection