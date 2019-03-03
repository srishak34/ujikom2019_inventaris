@section('title', 'Edit Inventaris')
@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-2">			
			<a class="btn btn-sm btn-secondary float-right" href="{{ url('/admin/dataInventaris') }}">Kembali</a>				
		</div>
		<div class="col-sm-10">			
			<h4 class="float-left">Edit Inventaris : {{ $i->nama }}</h4>			
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
				<label class="form-control-label">Nama Barang :</label>
				<input class="form-control" type="text" name="u_n_barang" placeholder="Masukkan Nama Barang" required value="{{ $i->nama }}">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Kondisi :</label>
				<input class="form-control" type="text" name="u_kondisi" placeholder="Masukkan Kondisi Barang" required value="{{ $i->kondisi }}">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Keterangan :</label>
				<textarea class="form-control" name="u_keterangan" rows="4" style="resize: none;" placeholder="Keterangan" required>{{ $i->keterangan }}</textarea>				
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Jumlah :</label>
				<input class="form-control" maxlength="4" type="text" name="u_jumlah" placeholder="Masukkan Jumlah" required onkeypress="return isNumberKey(event)" value="{{ $i->jumlah }}">
			</div>
		</div>
		<div class="row justify-content-center mt-2">		
			<div class="col-sm-3">
				<label class="form-control-label">Jenis :</label>
				@if(count($d_j) < 1)
				<select class="custom-select" disabled="disabled">
					<option>Disabled</option>
				</select>
				<small class="d-inline text-danger">Mohon Untuk Mengisi Data Jenis Terlebih Dahulu</small>
				@else					
					<select class="custom-select" name="u_jenis" required>						
						<option value="{{ $i->jenis_id }}" selected>{{ $j }}</option>
						@foreach($d_j as $data)
						@if($data->id == $i->jenis_id)
						@continue
						@endif
						<option value="{{ $data->id }}">{{ $data->nama_jenis }}</option>
						@endforeach
					</select>					
				@endif				
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Ruang :</label>
				@if(count($d_r) < 1)
				<select class="custom-select" disabled="disabled">
					<option>Disabled</option>
				</select>
				<small class="d-inline text-danger">Mohon Untuk Mengisi Data Ruang Terlebih Dahulu</small>
				@else					
					<select class="custom-select" name="u_ruang" required>
						<option value="{{ $i->ruang_id }}" selected>{{ $r }}</option>
						@foreach($d_r as $data)
						@if($data->id == $i->ruang_id)
						@continue
						@endif
						<option value="{{ $data->id }}">{{ $data->nama_ruang }}</option>
						@endforeach
					</select>					
				@endif
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Kode Inventaris :</label>
				<input class="form-control" type="text" name="u_k_inventaris" placeholder="Masukkan Kode Inventaris" required onkeypress="return isNumberKey(event)" value="{{ $i->kode_inventaris }}">
			</div>
			<div class="col-sm-3">
				<label class="form-control-label">Petugas :</label>
				@if(count($d_p) < 1)
				<select class="custom-select" disabled="disabled">
					<option>Disabled</option>
				</select>
				<small class="d-inline text-danger">Mohon Untuk Mengisi Data Petugas Terlebih Dahulu</small>
				@else					
					<select class="custom-select" name="u_petugas" required>
						@if($i->petugas_id == Auth::user()->id)
						<option value="{{ $i->petugas_id }}" selected>{{ $p }}</option>
						@else
						<option value="{{ Auth::user()->id }}" selected>Admin atau {{ Auth::user()->nama_petugas }}</option>
						@endif
						@foreach($d_p as $data)
						@if($loop->first)
						@continue
						@endif

						@if($data->id == $i->petugas_id)
						@continue
						@endif
						<option value="{{ $data->id }}">{{ $data->nama_petugas }}</option>
						@endforeach
					</select>					
				@endif		
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