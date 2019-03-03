<!DOCTYPE html>
<html>
<head>
	<title>Cetak</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bst.css') }}">
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/bst.js') }}"></script>	
</head>
<body>
	<h4 class="text-center mb-3">Data Transaksi Peminjaman</h4>
	@if(isset($path))
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Nama Inventaris</th>
					<th>Status Peminjaman</th>
					<th>Jumlah</th>
					<th>Tanggal Dipinjam</th>
					<th>Nama Pegawai</th>
					<th colspan="3">Tanggal Transaksi Dibuat</th>
				</tr>
			</thead>
			<tbody>
				@foreach($search as $dt)
				@if(empty($dt->peminjaman_id))
				@foreach($dt as $data)	
				<tr>
					<td class="text-center">{{ $no++ }}</td>
					<td>{{ $data->inventaris_id }}</td>
					<td>{{ $data->peminjaman_id }}</td>
					<td>{{ $data->jumlah }}</td>
					<td>{{ date('d-m-Y',strtotime($data->tgl_pinjam)) }}</td>
					<td>{{ $data->pegawai_id }}</td>
					<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td class="text-center">{{ $no++ }}</td>
					<td>{{ $dt->inventaris_id }}</td>
					<td>{{ $dt->peminjaman_id }}</td>
					<td>{{ $dt->jumlah }}</td>
					<td>{{ date('d-m-Y',strtotime($dt->tgl_pinjam)) }}</td>
					<td>{{ $dt->pegawai_id }}</td>
					<td>{{ date('d-m-Y', strtotime($dt->created_at)) }}</td>
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>
	</div>
	@else
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Nama Inventaris</th>
					<th>Status Peminjaman</th>
					<th>Jumlah</th>
					<th>Tanggal Dipinjam</th>
					<th>Nama Pegawai</th>
					<th colspan="4">Tanggal Transaksi Dibuat</th>
				</tr>
			</thead>
			<tbody>
				@foreach($d as $data)
				@if ($data->peminjaman_id == "Pending" || $data->peminjaman_id == "pending")
				<tr class="table-info">
					@else
					<tr>
						@endif
						<td class="text-center">{{ $no++ }}</td>
						<td>{{ $data->inventaris_id }}</td>
						<td>{{ $data->peminjaman_id }}</td>
						<td>{{ $data->jumlah }}</td>
						<td>{{ date('d-m-Y',strtotime($data->tgl_pinjam)) }}</td>
						<td>{{ $data->pegawai_id }}</td>
						<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endif	

		<script>
			window.load = print_d();
			function print_d(){
				window.print();
			}
		</script>
	</body>
	</html>
