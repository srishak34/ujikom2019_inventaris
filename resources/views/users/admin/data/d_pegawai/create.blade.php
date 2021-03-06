@section('title', 'Petugas Baru')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-2">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/admin/dataPegawai') }}">Kembali</a>				
		</div>
		<div class="col-sm-10">			
			<h4 class="float-left">Buat Data Pegawai Baru</h4>
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
				<label class="form-control-label">Nama Pegawai :</label>
				<input class="form-control" type="text" name="c_n_pegawai" placeholder="Masukkan Nama Pegawai" required>
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">NIP :</label>
				<input class="form-control" type="text" onkeypress="return isNumberKey(event)" minlength="18" maxlength="20" name="c_nip" placeholder="Masukkan NIP" required>
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Alamat :</label>
				<textarea class="form-control" name="c_alamat" rows="4" style="resize: none;" placeholder="Alamat Pegawai" required></textarea>
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