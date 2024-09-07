@extends('interface.app')
@section('title', 'Data Menu')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Silahkan Pesan</small></h1>
                </div>
            </div>
        </div>
    </div>
    @include('include.message')
    <div class="content">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 mb-3">
                    <div class="row gy-4">
                        @foreach ($menus as $item)
                            <!-- Menu Item -->
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="card">
                                    @if ($item->foto != null)
                                        <img src="{{ asset('asset/images/menu/' . $item->foto) }}" class="card-img-top"
                                            style="height: 80px; object-fit: cover;" alt="{{ $item->judul }}">
                                    @else
                                        <img src="https://via.placeholder.com/400x250" class="card-img-top"
                                            style="height: 80px; object-fit: cover;" alt="Placeholder">
                                    @endif
                                    <div class="m-1">
                                        <h5 class="card-title">{{ $item->nama_menu }}</h5>
                                        <p class="card-text">Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                            ({{ $item->jumlah }})
                                            tersedia
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pesan.tambah') }}" method="POST">
                                @csrf
                                <div id="pesan-container">
                                    <div class="pesan-item form-row mb-3 align-items-end">
                                        <div class="col-md-6">
                                            <label for="id_menu_0">Menu:</label>
                                            <select name="pesans[0][id_menu]" id="id_menu_0" class="form-control" required
                                                onchange="updatePrice(0)">
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}" data-price="{{ $menu->harga }}">
                                                        {{ $menu->nama_menu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="quantity_0">Quantity:</label>
                                            <div class="input-group">
                                                <input type="number" name="pesans[0][quantity]" id="quantity_0"
                                                    class="form-control" min="1" required oninput="updatePrice(0)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="total_price_0">Rp. 0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addPesan()"><i
                                        class="fas fa-cart-plus"></i></button>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button>
                                <button type="button" class="btn btn-danger" onclick="removePesan(0)"><i
                                        class="fas fa-window-close"></i></button>
                                <hr>
                                <div class="form-group">
                                    <label for="total_amount">Total Keseluruhan:</label>
                                    <span id="total_amount" class="form-control-plaintext">Rp. 0.00</span>
                                </div>
                            </form>
                            @include('include.custom')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Menu</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesans as $index => $pesan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pesan->menu->nama_menu }}</td>
                                            <td>
                                                @php
                                                    $totalHarga = $pesan->quantity * $pesan->menu->harga;
                                                @endphp
                                                Rp. {{ number_format($totalHarga) }}
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

@endsection
