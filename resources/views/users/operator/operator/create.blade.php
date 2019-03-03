@section('title', 'Transaksi Baru')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-2">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/operator') }}">Kembali</a>				
		</div>
		<div class="col-sm-10">			
			<h4 class="float-left">Buat Transaksi Baru</h4>			
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
				<label class="form-control-label">Nama Inventaris :</label>
				@if(count($i) < 1)
				<select class="custom-select" disabled="disabled">
					<option>Disabled</option>
				</select>
				<small class="d-inline text-danger">Mohon Untuk Menghubungi Admin Untuk Menambahkan Data Inventarisir Terlebih Dahulu</small>
				@else					
				<select class="custom-select" name="c_n_inventaris" required>
					<option value="">~!~Inventaris~!~</option>
					@foreach($i as $data)
					<option value="{{ $data->id }}">{{ $data->nama }}</option>
					@endforeach
				</select>					
				@endif
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Status Peminjaman :</label>
				<input class="form-control" type="text" name="c_status" value="dipinjam" readonly>
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Jumlah :</label>
				<input class="form-control" type="text" maxlength="4" name="c_jumlah" placeholder="Masukkan Jumlah" required onkeypress="return isNumberKey(event)">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Nama Pegawai :</label>
				@if(count($p) < 1)
				<select class="custom-select" disabled="disabled">
					<option>Disabled</option>
				</select>
				<small class="d-inline text-danger">Mohon Untuk Menghubungi Admin Untuk Melengkapi Data Pegawai Terlebih Dahulu</small>
				@else					
				<select class="custom-select" name="c_pegawai" required>
					<option value="">~!~Pegawai~!~</option>
					@foreach($p as $data)
					<option value="{{ $data->id }}">{{ $data->nama_pegawai }}</option>
					@endforeach
				</select>					
				@endif

				@if(count($p) > 0)				
				<input class="btn btn-primary mt-2" type="submit" value="Submit">
				@else
				<input class="btn btn-primary mt-2 form-control disabled" type="submit" value="Disabled" disabled>
				<small class="d-inline text-danger">Mohon Untuk Melengkapi Data Terlebih Dahulu</small>

				@endif
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