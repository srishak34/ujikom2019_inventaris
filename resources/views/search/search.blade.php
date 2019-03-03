@section('title', 'Search '.$title)
@extends('layouts.master')
@section('content')
<div class="container-fluid">	
	<div class="row justify-content-center">
		<div class="col-sm-10">			
			<h4>{{ $title }}</h4>
			<div class="row">
				<div class="col-sm-1">			
					<a class="btn btn-sm btn-secondary float-left" href="{{ url($path) }}">Kembali</a>				
				</div>
				<div class="col-sm-7">			
					<p style="font-size: 1.15rem;">Hasil Search: <strong>{{ $s }}</strong></p>
				</div>
				@if($path == 'admin/laporan_peminjaman' || $path == 'admin/laporan_pengembalian')
				<div class="col-sm-1 p-0">
					<form class="float-right" action="{{ $path == 'admin/laporan_peminjaman' ? 'admin/export_to_pdf_tpeminjaman' : 'admin/export_to_pdf_tpengembalian' }}" method="POST" target="_BLANK">
						@csrf
						<div class="input-group">
							<input name="path" value="{{ $path }}" hidden>
							<input name="search" value="{{ $s }}" hidden="">
							<span class="input-group-btn">
								<input class="btn btn-sm btn-dark" type="submit" name="" value="Print Laporan {{ $title }}">
							</span>
						</div>
					</form>
				</div>
				@endif
				<div class="col-sm-3">
					<form action="/search" method="POST">
						@csrf
						<div class="input-group">
							<input name="path" value="{{ $path }}" hidden>
							<input type="text" name="search" class="form-control form-control-sm" placeholder="Pencarian">&nbsp;
							<span class="input-group-btn">
								<input class="btn btn-sm btn-info" type="submit" name="" value="Cari">
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row justify-content-center">
		<div class="col-sm-12">
			@if(count($search) < 1)
			<div class="text-center">
				<h4 class="text">Apa yang anda cari tidak ditemukan. Mohon untuk mencoba lagi.</h4>
			</div>
			@elseif($path == 'admin/dataInventaris')
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Kondisi</th>
							<th>Keterangan</th>
							<th>Jumlah</th>
							<th>Jenis</th>
							<th>Ruang</th>
							<th>Kode</th>
							<th>Petugas</th>
							<th colspan="3">Tanggal Dibuat</th>
						</tr>
					</thead>
					<tbody>
						@foreach($search as $data)
						<tr>
							<td class="text-center">{{ $no++ }}</td>
							<td>{{ $data->nama }}</td>
							<td>{{ $data->kondisi }}</td>
							<td>{{ $data->keterangan }}</td>
							<td>{{ $data->jumlah }}</td>
							<td>{{ $data->jenis_id }}</td>
							<td>{{ $data->ruang_id }}</td>
							<td>{{ $data->kode_inventaris }}</td>
							<td>{{ $data->petugas_id }}</td>
							<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
							<td class="text-center"><a class="btn btn-sm btn-primary" href="admin/dataInventaris/{{ $data->id }}/update">Edit</a></td>
							<td class="text-center">
								<form action="admin/dataInventaris/{{ $data->id}}/delete" method="post">
									@csrf
									<input type="hidden" name="_method" value="DELETE">
									<input type="submit" name="" class="btn btn-sm btn-danger" value="Hapus">
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@elseif($path == 'admin/dataPetugas')
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Nama Petugas</th>
							<th>Level</th>
							<th colspan="3">Tanggal Dibuat</th>
						</tr>
					</thead>
					<tbody>
						@foreach($search as $data)
						<tr>
							<td class="text-center">{{ $no++ }}</td>
							<td>{{ $data->username }}</td>
							<td>{{ $data->nama_petugas }}</td>
							<td>{{ $data->level_id }}</td>
							<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
							<td class="text-center"><a class="btn btn-sm btn-primary" href="admin/dataPetugas/{{ $data->id }}/update">Edit</a></td>
							<td class="text-center">
								<form action="admin/dataPetugas/{{ $data->id}}/delete" method="post">
									@csrf
									<input type="hidden" name="_method" value="DELETE">
									<input type="submit" name="" class="btn btn-sm btn-danger" value="Hapus">
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@elseif($path == 'admin/dataPegawai')
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Nama Pegawai</th>
							<th>NIP</th>
							<th>Alamat</th>
							<th colspan="3">Tanggal Dibuat</th>
						</tr>
					</thead>
					<tbody>
						@foreach($search as $data)
						@if($data->nip == null || $data->alamat == null)
						<tr class="table-danger">
							@else
							<tr>
								@endif
								<td class="text-center">{{ $no++ }}</td>
								<td>{{ $data->nama_pegawai }}</td>
								<td>{{ $data->nip == null ? 'DATA TIDAK LENGKAP!!!' : $data->nip }}</td>
								<td>{{ $data->alamat == null ? 'DATA TIDAK LENGKAP!!!' : $data->alamat }}</td>
								<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
								<td class="text-center"><a class="btn btn-sm btn-primary" href="admin/dataPegawai/{{ $data->id }}/update">Edit</a></td>
								<td class="text-center">
									<form action="admin/dataPegawai/{{ $data->id}}/delete" method="post">
										@csrf
										<input type="hidden" name="_method" value="DELETE">
										<input type="submit" name="" class="btn btn-sm btn-danger" value="Hapus">
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@elseif($path == 'admin/dataRuang')
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thead-dark">
							<tr>
								<th>#</th>
								<th>Nama Ruang</th>
								<th>Kode Ruang</th>
								<th>Keterangan</th>
								<th colspan="3">Tanggal Dibuat</th>
							</tr>
						</thead>
						<tbody>
							@foreach($search as $data)
							<tr>
								<td class="text-center">{{ $no++ }}</td>
								<td>{{ $data->nama_ruang }}</td>
								<td>{{ $data->kode_ruang }}</td>
								<td>{{ $data->keterangan }}</td>
								<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
								<td class="text-center"><a class="btn btn-sm btn-primary" href="admin/dataRuang/{{ $data->id }}/update">Edit</a></td>
								<td class="text-center">
									<form action="admin/dataRuang/{{ $data->id}}/delete" method="post">
										@csrf
										<input type="hidden" name="_method" value="DELETE">
										<input type="submit" name="" class="btn btn-sm btn-danger" value="Hapus">
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@elseif($path == 'admin/dataJenis')
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thead-dark">
							<tr>
								<th>#</th>
								<th>Nama Jenis</th>
								<th>Kode Jenis</th>
								<th>Keterangan</th>
								<th colspan="3">Tanggal Dibuat</th>
							</tr>
						</thead>
						<tbody>
							@foreach($search as $data)
							<tr>
								<td class="text-center">{{ $no++ }}</td>
								<td>{{ $data->nama_jenis }}</td>
								<td>{{ $data->kode_jenis }}</td>
								<td>{{ $data->keterangan }}</td>
								<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
								<td class="text-center"><a class="btn btn-sm btn-primary" href="admin/dataJenis/{{ $data->id }}/update">Edit</a></td>
								<td class="text-center">
									<form action="admin/dataJenis/{{ $data->id}}/delete" method="post">
										@csrf
										<input type="hidden" name="_method" value="DELETE">
										<input type="submit" name="" class="btn btn-sm btn-danger" value="Hapus">
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table> 
				</div>
				@elseif($path == 'admin/trans_peminjaman' || $path == 'admin/laporan_peminjaman' || $path == 'operator')
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
									@if($data->peminjaman_id == "Pending" || $data->peminjaman_id == "pending")
									@if($path == 'admin/trans_peminjaman' || $path == 'operator')
									<td class="text-center"><form action="{{ $path == 'admin/trans_peminjaman' ? 'trans_peminjaman' : 'operator' }}/{{ $data->id }}/izinkan" method="POST">
										@csrf
										@method('patch')
										<input class="btn btn-sm btn-success" type="submit" name="" value="Izinkan">
									</form></td>
									@endif								
									@else
									@if($path == 'admin/trans_peminjaman' || $path == 'operator')
									<td class="text-center"><a class="btn btn-sm btn-warning" href="{{ $path == 'admin/trans_peminjaman' ? 'trans_peminjaman' : 'operator' }}/{{ $data->id }}/kembalikan">Kembalikan</a></td>
									@endif
									@endif

									@if($path == 'admin/trans_peminjaman' || $path == 'operator')
									<td class="text-center"><a class="btn btn-sm btn-info" href="{{ $path == 'admin/trans_peminjaman' ? 'trans_peminjaman' : 'operator' }}/{{ $data->id }}/detail">Detail</a></td>
									@endif
								</tr>
								@endforeach

								@else

								@if ($dt->peminjaman_id == "Pending" || $dt->peminjaman_id == "pending")
								<tr class="table-info">
									@else
									<tr>
										@endif
										<td class="text-center">{{ $no++ }}</td>
										<td>{{ $dt->inventaris_id }}</td>
										<td>{{ $dt->peminjaman_id }}</td>
										<td>{{ $dt->jumlah }}</td>
										<td>{{ date('d-m-Y',strtotime($dt->tgl_pinjam)) }}</td>
										<td>{{ $dt->pegawai_id }}</td>
										<td>{{ date('d-m-Y', strtotime($dt->created_at)) }}</td>
										@if($dt->peminjaman_id == "Pending" || $dt->peminjaman_id == "pending")
										@if($path == 'admin/trans_peminjaman' || $path == 'operator')
										<td class="text-center"><form action="{{ $path == 'admin/trans_peminjaman' ? 'admin/trans_peminjaman' : 'operator' }}/{{ $dt->id }}/izinkan" method="POST">
											@csrf
											@method('patch')
											<input class="btn btn-sm btn-success" type="submit" name="" value="Izinkan">
										</form></td>								
										@endif
										@else
										@if($path == 'admin/trans_peminjaman' || $path == 'operator')
										<td class="text-center"><a class="btn btn-sm btn-warning" href="{{ $path == 'admin/trans_peminjaman' ? 'admin/trans_peminjaman' : 'operator' }}/{{ $dt->id }}/kembalikan">Kembalikan</a></td>
										@endif
										@endif

										@if($path == 'admin/trans_peminjaman' || $path == 'operator')
										<td class="text-center"><a class="btn btn-sm btn-info" href="{{ $path == 'admin/trans_peminjaman' ? 'admin/trans_peminjaman' : 'operator' }}/{{ $dt->id }}/detail">Detail</a></td>
										@endif
									</tr>

									@endif
									@endforeach

								</tbody>
							</table>
						</div>

						@elseif($path == 'admin/trans_pengembalian' || $path == 'admin/laporan_pengembalian' || $path == 'operator/trans_pengembalian')
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead class="thead-dark">
									<tr>
										<th>#</th>
										<th>Nama Inventaris</th>
										<th>Status Peminjaman</th>
										<th>Jumlah</th>
										<th>Tanggal Dipinjam</th>
										<th>Tanggal Dikembalikan</th>
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
										<td>{{ date('d-m-Y',strtotime($data->tgl_kembali))}}</td>
										<td>{{ $data->pegawai_id }}</td>
										<td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
										@if($path == 'admin/trans_pengembalian' || $path == 'operator/trans_pengembalian')
										<td class="text-center"><a class="btn btn-sm btn-info" href="{{ $path == 'admin/trans_pengembalian' ? 'admin/trans_pengembalian' : 'operator/trans_pengembalian' }}/{{ $data->id }}/detail">Detail</a></td>
										@endif
									</tr>
									@endforeach
									@else
									<tr>
										<td class="text-center">{{ $no++ }}</td>
										<td>{{ $dt->inventaris_id }}</td>
										<td>{{ $dt->peminjaman_id }}</td>
										<td>{{ $dt->jumlah }}</td>
										<td>{{ date('d-m-Y',strtotime($dt->tgl_pinjam)) }}</td>
										<td>{{ date('d-m-Y',strtotime($dt->tgl_kembali))}}</td>
										<td>{{ $dt->pegawai_id }}</td>
										<td>{{ date('d-m-Y', strtotime($dt->created_at)) }}</td>
										@if($path == 'admin/trans_pengembalian' || $path == 'operator/trans_pengembalian')
										<td class="text-center"><a class="btn btn-sm btn-info" href="{{ $path == 'admin/trans_pengembalian' ? 'admin/trans_pengembalian' : 'operator/trans_pengembalian' }}/{{ $dt->id }}/detail">Detail</a></td>
										@endif
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
						@elseif($path == 'peminjam')
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
									@foreach($search as $data)
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
											<td class="text-center"><a class="btn btn-sm btn-info" href="peminjam/{{ $data->id }}/detail">Detail</a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@endif
						</div>
					</div>
				</div>
				@stop