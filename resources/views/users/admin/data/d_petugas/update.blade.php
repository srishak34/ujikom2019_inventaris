@section('title', 'Edit Petugas')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-1">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/admin/dataPetugas') }}">Kembali</a>				
		</div>
		<div class="col-sm-11">			
			<h4 class="float-left">Edit Petugas : {{ $petugas->nama_petugas }}</h4>				
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
	<form action="update" method="post">
		@csrf
		@method('PATCH')
	<div class="row justify-content-center">		
		<div class="col-sm-3">
			<label class="form-control-label">Username :</label>
			<input class="form-control" type="text" name="u_username" value="{{ $petugas->username }}" placeholder="Masukkan Username">
		</div>
		<div class="col-sm-3">
			<label class="form-control-label">Password :</label>
			<input class="form-control" type="password" name="u_pass" placeholder="Masukkan password" minlength="6">
		</div>
		<div class="col-sm-3">
			<label class="form-control-label">Nama Petugas :</label>
			<input class="form-control" type="text" name="u_n_petugas" value="{{ $petugas->nama_petugas }}" placeholder="Masukkan Nama Petugas">
		</div>
		<div class="col-sm-3">
			<label class="form-control-label">Level :</label>
			<select name="u_level" class="custom-select">
				<option value="{{ $petugas->level_id }}" selected>{{ $n_p }}</option>
				@foreach($level as $data)
				@if($data->id == $petugas->level_id)
				@continue
				@endif
				<option value="{{ $data->id }}">{{ $data->level }}</option>
				@endforeach
			</select>
			<input class="btn btn-primary mt-2" type="submit" value="Submit">
		</div>		
	</div>

	</form>
</div>
@stop