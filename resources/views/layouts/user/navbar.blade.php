			<div class="main-panel">
				<!-- Navbar -->
				<nav class="navbar navbar-expand-lg fixed-top navbar-transparent  bg-primary  navbar-absolute" >
					<div class="container-fluid">
						<div class="navbar-wrapper">	
							<div class="navbar-toggle">
								<button type="button" class="navbar-toggler">
									<span class="navbar-toggler-bar bar1"></span>
									<span class="navbar-toggler-bar bar2"></span>
									<span class="navbar-toggler-bar bar3"></span>
								</button>
							</div>
							<h5>
								<i class="fas fa-user"></i>&nbsp&nbsp
									<a data-toggle="collapse" href="#userProfile">
					                    {{ Auth::user()->name }}&nbsp&nbsp<b class="caret"></b>
					                </a>
					                <div class="collapse" id="userProfile">
					                    <ul class="nav">
					                    	<li class="side">
					                    		<i class="fas fa-wrench"></i>&nbsp&nbsp<a href="/users/profile/{{Auth::user()->id}}/edit"><span class="sidebar-normal">Profile Settings</span></a>
					                    	</li>
					                    </ul>
					                </div>
					            </li>
					        </h5>
						</div>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-bar navbar-kebab"></span>
							<span class="navbar-toggler-bar navbar-kebab"></span>
							<span class="navbar-toggler-bar navbar-kebab"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-end" id="navigation">
							<div>
								<form method="POST" action="/users/search">
									@csrf
									<div class="form-group">
										<div class="input-group no-border">
											<input type="text" class="form-control" name="search">
										</div>
										<button type="submit" class="btn btn-info btn-round" style="float:right"><i class="fas fa-search"></i> Search</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</nav>
				<!-- End Navbar -->
				<div class="panel-header panel-header-sm d-flex justify-content-center">
					@if ($flash = session('message'))
						<div id="alert" class="alert alert-info fade show" role="alert">
							<strong>{{ $flash }}</strong>
						</div>
					@endif
			    </div>