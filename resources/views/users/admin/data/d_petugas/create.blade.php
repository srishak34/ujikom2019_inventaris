@section('title', 'Petugas Baru')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-2">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/admin/dataPetugas') }}">Kembali</a>				
		</div>
		<div class="col-sm-10">			
			<h4 class="float-left">Buat Data Petugas Baru</h4>			
		</div>
	</div>
	<div class="row justify-content-center">
		@if(Session::has('notif_danger'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			{!! session('notif_danger') !!}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
	</div>
	<hr>
	<form action="create" method="post">
		@csrf
		<div class="row justify-content-center">		
			<div class="col-sm-3">
				<label class="form-control-label">Username :</label>
				<input class="form-control" type="text" name="c_username" placeholder="Masukkan Username" required>
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Password :</label>
				<input class="form-control" type="password" name="c_pass" placeholder="Masukkan password" minlength="6" required>

				<label class="form-control-label mt-1">Konfirmasi Password :</label>
				<input class="form-control" type="password" name="c_k_pass" placeholder="Masukkan password" minlength="6" required>
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Nama Petugas :</label>
				<input class="form-control" type="text" name="c_n_petugas" placeholder="Masukkan Nama Petugas" required>
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Level :</label>
				<select name="c_level" class="custom-select" required>
					@foreach($level as $data)
					<option value="{{ $data->id }}" {{ $data->id == 1 ? 'selected=selected' : ''}}>{{ $data->level }}</option>
					@endforeach									
				</select>
				<input class="btn btn-primary mt-2" type="submit" value="Submit">
			</div>		
		</div>

	</form>
</div>
@stop