@section('title', 'Edit Jenis')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-1">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/admin/dataJenis') }}">Kembali</a>				
		</div>
		<div class="col-sm-11">			
			<h4 class="float-left">Edit Jenis : {{ $jenis->nama_jenis }}</h4>				
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
				<label class="form-control-label">Nama Jenis :</label>
				<input class="form-control" type="text" name="u_n_jenis" value="{{ $jenis->nama_jenis }}" placeholder="Masukkan Username">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Kode Jenis :</label>
				<input class="form-control" type="text" name="u_k_jenis" placeholder="Masukkan Kode Jenis" required onkeypress="return isNumberKey(event)" value="{{ $jenis->kode_jenis }}">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Keterangan :</label>
				<textarea class="form-control" name="u_keterangan" rows="4" style="resize: none;" placeholder="Keterangan" required>{{ $jenis->keterangan }}</textarea>
				<input class="btn btn-primary mt-2" type="submit" value="Submit">
			</div>	
		</div>

	</form>
</div>
<script type="text/javascript">
	function isNumberKey(evt) {
	   var charCode = (evt.which) ? evt.which : event.keyCode
	   if (charCode > 31 && (charCode < 48 || charCode > 57))
	    return false;

	return true;
}
</script>
@stop