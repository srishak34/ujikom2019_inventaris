@section('title', 'Register Peminjam')
@extends('layouts.master')
@section('content')
	<div style="min-height: 100%;" class="container-fluid mt-5">
	<div style="width: 100%" class="row justify-content-center">
		<div class="col-sm-6">
			@if (Session::has('notif'))
			<p>{!! session('notif') !!}</p>
			@endif
			<form action="/registerPage" method="post">
				@csrf
				<div class="card">
					<div class="card-header ">
						<span style="font-size: 20px;" class="">Register</span> <a class="btn btn-sm btn-info float-right" href="/loginPage">Login</a>
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 col-form-label text-sm-right">Nama :</label>
							<div class="col-sm-6">
								<input class="form-control" type="text" name="r_nama" placeholder="Nama Anda">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label text-sm-right">Username :</label>
							<div class="col-sm-6">
								<input class="form-control" type="text" name="r_username" placeholder="Username Anda">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label text-sm-right">Password :</label>
							<div class="col-sm-6">
								<input class="form-control" minlength="6" type="password" name="r_pass" placeholder="Password Anda">
								<small class="d-inline text-info">Minimal 6 Karakter</small>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label text-sm-right">Konfirmasi Password :</label>
							<div class="col-sm-6">
								<input class="form-control" minlength="6" type="password" name="r_confirm_pass" placeholder="Konfirmasi Password Anda">
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									Register
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