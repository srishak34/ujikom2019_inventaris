@section('title', 'Inventaris Baru')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-2">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/admin/dataInventaris') }}">Kembali</a>				
		</div>
		<div class="col-sm-10">			
			<h4 class="float-left">Buat Data Inventaris Baru</h4>			
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
				<label class="form-control-label">Nama Barang :</label>
				<input class="form-control" type="text" name="c_n_barang" placeholder="Masukkan Nama Barang" required>
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Kondisi :</label>
				<input class="form-control" type="text" name="c_kondisi" placeholder="Masukkan Kondisi Barang" required>
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Keterangan :</label>
				<textarea class="form-control" name="c_keterangan" rows="4" style="resize: none;" placeholder="Keterangan" required></textarea>				
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Jumlah :</label>
				<input class="form-control" maxlength="4" type="text" name="c_jumlah" placeholder="Masukkan Jumlah" required onkeypress="return isNumberKey(event)">
			</div>
		</div>
		<div class="row justify-content-center mt-2">		
			<div class="col-sm-3">
				<label class="form-control-label">Jenis :</label>
				@if(count($j) < 1)
				<select class="custom-select" disabled="disabled">
					<option>Disabled</option>
				</select>
				<small class="d-inline text-danger">Mohon Untuk Mengisi Data Jenis Terlebih Dahulu</small>
				@else					
					<select class="custom-select" name="c_jenis" required>
						<option value="">Jenis</option>
						@foreach($j as $data)
						<option value="{{ $data->id }}">{{ $data->nama_jenis }}</option>
						@endforeach
					</select>					
				@endif				
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Ruang :</label>
				@if(count($r) < 1)
				<select class="custom-select" disabled="disabled">
					<option>Disabled</option>
				</select>
				<small class="d-inline text-danger">Mohon Untuk Mengisi Data Ruang Terlebih Dahulu</small>
				@else					
					<select class="custom-select" name="c_ruang" required>
						<option value="">Ruang</option>
						@foreach($r as $data)
						<option value="{{ $data->id }}">{{ $data->nama_ruang }}</option>
						@endforeach
					</select>					
				@endif
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Kode Inventaris :</label>
				<input class="form-control" type="text" name="c_k_inventaris" placeholder="Masukkan Kode Inventaris" required onkeypress="return isNumberKey(event)">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Petugas :</label>
				@if(count($p) < 1)
				<select class="custom-select" disabled="disabled">
					<option>Disabled</option>
				</select>
				<small class="d-inline text-danger">Mohon Untuk Mengisi Data Petugas Terlebih Dahulu</small>
				@else
				<input type="text" name="c_petugas" value="{{ Auth::user()->id }}" hidden>
					<select class="custom-select" disabled>						
						<option selected>Admin atau {{ Auth::user()->nama_petugas }}</option>
					</select>					
				@endif
				@if(count($j) > 0)
					@if(count($r) > 0)
						@if(count($p) > 0)
							<input class="btn btn-primary mt-2" type="submit" value="Submit">
						@else
							<input class="btn btn-primary mt-2 form-control disabled" type="submit" value="Disabled" disabled>
							<small class="d-inline text-danger">Mohon Untuk Melengkapi Data Terlebih Dahulu</small>
						@endif
					@else
						<input class="btn btn-primary mt-2 form-control disabled" type="submit" value="Disabled" disabled>
						<small class="d-inline text-danger">Mohon Untuk Melengkapi Data Terlebih Dahulu</small>
					@endif
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