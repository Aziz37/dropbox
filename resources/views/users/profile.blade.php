@extends('layouts.user.master')

@section('content')
	<div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    
                    <div class="card-header">
                        <h3 class="title">
   							Edit User Details
   						</h3>
   					</div>
   					 <div class="card-body">
						<h6>
							<form method="POST" action="/users/profile/{{ $user->id }}">
								@method('PATCH')
								@csrf
								<div class="form-group">
									<label for="name">Name</label>
									<input class="form-control" type="text" name="name" value="{{ $user->name }}" disabled>
								</div>
								<div class="form-group">
									<label for="user_type">User Type</label>
									<input class="form-control" type="text" name="user_type" value=" {{ $user->user_type }}" disabled>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
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
							<form method="POST" action="/users/profile/{{ $user->id }}">
								@method('PATCH')
								@csrf
								
								<div class="form-group">
									<label for="current_password">Current Password </label>
									<input type="password" class="form-control" name="current_password" placeholder="enter current password">
								</div>
								<div class="form-group">
									<label for="password">Password </label>
									<input type="password" class="form-control" name="password" placeholder="enter new password" required>
								</div>
								<div class="form-group">
										<label for="password-confirm">Confirm Password</label>
										<input type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required>
								</div>
								<button type="submit" class="btn btn-primary btn-round" style="float:right">Change Password</button>
								<br/>
								<p><em>You will be logged out once password has been successfully changed.</p><p> Please log back in with new password</em></p>
							</form>
						</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection