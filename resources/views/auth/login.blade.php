@section('title', 'Login')
@extends('layouts.master')
@section('content')
<div style="min-height: 100%;" class="container-fluid mt-5">
	<div style="width: 100%" class="row justify-content-center">
		<div class="col-sm-6">
			<form action="/loginPage" method="post">
				@csrf
				<div class="card">
					<div class="card-header ">
						<span style="font-size: 20px;" class="">Login</span> 
						{{-- <a class="btn btn-sm btn-info float-right" href="/registerPage">Register</a> --}}
					</div>
					<div class="card-body">
						@if(Session::has('notif_danger'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							{!! session('notif_danger') !!}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						@endif
						@if(Session::has('notif_success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{!! session('notif_success') !!}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						@endif
						<div class="form-group row">
							<label class="col-sm-4 col-form-label text-sm-right">Username :</label>
							<div class="col-sm-6">
								<input class="form-control" type="text" name="l_username" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label text-sm-right">Password :</label>
							<div class="col-sm-6">
								<input class="form-control" type="password" name="l_pass" >
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									Login
								</button>
							</div>
						</div>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>
@endsection
