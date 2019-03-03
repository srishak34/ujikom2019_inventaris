@section('title', 'Edit Ruang')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-1">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/admin/dataRuang') }}">Kembali</a>				
		</div>
		<div class="col-sm-11">			
			<h4 class="float-left">Edit Ruang : {{ $ruang->nama_ruang }}</h4>				
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
				<label class="form-control-label">Nama Ruangan :</label>
				<input class="form-control" type="text" name="u_n_ruang" value="{{ $ruang->nama_ruang }}" placeholder="Masukkan Username">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Kode Ruangan :</label>
				<input class="form-control" type="text" name="u_k_ruang" placeholder="Masukkan Kode Ruangan" required onkeypress="return isNumberKey(event)" value="{{ $ruang->kode_ruang }}">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Keterangan :</label>
				<textarea class="form-control" name="u_keterangan" rows="4" style="resize: none;" placeholder="Keterangan" required>{{ $ruang->keterangan }}</textarea>
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