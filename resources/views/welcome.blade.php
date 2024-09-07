@extends('interface.app')
@section('title', 'Data Menu')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Menu</small></h1>
                </div>
            </div>
        </div>
    </div>
    @include('include.message')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambah">
                                <i class="fas fa-plus"></i>
                            </button>
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Alat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $index => $item)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td style="width: 100px">
                                                @if ($item->foto != null)
                                                    <img src="{{ asset('asset/images/menu/' . $item->foto) }}"
                                                        class="img-fluid" style="max-width: 100%; height: auto;"
                                                        alt="{{ $item->judul }}">
                                                @else
                                                    <img src="https://via.placeholder.com/100" class="img-fluid"
                                                        alt="Placeholder">
                                                @endif
                                            </td>

                                            <td>{{ $item->nama_menu }}</td>
                                            <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>
                                                <a class="btn btn-primary mt-1" data-toggle="modal"
                                                    data-target="#ubah-{{ $item->id }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger mt-1" data-toggle="modal"
                                                    data-target="#hapus-{{ $item->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="btn btn-default" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('menu.tambah') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" required>
                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                </div>
                            </div>
                            <small>Unggah File JPG, JPEG, atau PNG Max 2MB.</small>
                        </div>
                        <div class="form-group">
                            <label for="nama_menu">Nama Menu</label>
                            <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                                placeholder="Nama Menu" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($menus as $item)
        <div class="modal fade" id="ubah-{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="btn btn-default" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('menu.ubah', $item->id) }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <center class="mb-2">
                                    @if ($item->foto != null)
                                        <img src="{{ asset('asset/images/menu/' . $item->foto) }}" width="40%"
                                            style="max-width: 100%; height: auto;" alt="{{ $item->judul }}">
                                    @else
                                        <img src="https://via.placeholder.com/100" width="40%" alt="Placeholder">
                                    @endif
                                </center>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                        <label class="custom-file-label" for="foto">Pilih file</label>
                                    </div>
                                </div>
                                <small>Unggah File JPG, JPEG, atau PNG Max 2MB.</small>
                            </div>
                            <div class="form-group">
                                <label for="nama_menu">Nama Menu</label>
                                <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                                    value="{{ $item->nama_menu }}" placeholder="Nama Menu" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    value="{{ $item->harga }}" placeholder="Harga" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                    value="{{ $item->jumlah }}" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($menus as $item)
        <div class="modal fade" id="hapus-{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="btn btn-default" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('menu.hapus', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Yakin untuk menghapus berita <span class="text-danger">{{ $item->nama_menu }}</span>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
