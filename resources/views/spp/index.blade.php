@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SPP</h3>
                </div>
                {{-- @if(session()->has('msg'))
                <div class="card-alert alert alert-{{ session()->get('type') }}" id="message"
                    style="border-radius: 0px !important">
                    @if(session()->get('type') == 'success')
                    <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    @else
                    <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                    @endif
                    {{ session()->get('msg') }}
                </div>
                @endif --}}
                <div class="card-body">
                    {{-- <form action="{{ route('keuangan.store') }}" method="post"> --}}
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">User</label>
                                    <select id="siswa" class="form-control" name="siswa_id">
                                        <option value="#">User</option>
                                        @foreach($user as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                        @endforeach
                                    </select><br>
                                    Saldo: IDR. <span id="saldo">0</span>
                                </div>
                                <div class="form-group" style="display: none" id="form-tagihan">
                                    <label class="form-label">Tagihan</label>
                                    <select id="tagihan" class="form-control" name="tagihan_id">

                                    </select>
                                </div>
                                <div class="form-group" style="display: none" id="form-tagihan-2">
                                    <label class="form-label">Total Tagihan</label>
                                    IDR. <span id="harga">0</span>
                                    <label class="custom-switch">
                                        <input type="checkbox" class="custom-switch-input" id="ada-diskon">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Ada diskon? </span>
                                    </label>
                                </div>
                                <div class="form-group" style="display: none" id="form-diskon">
                                    <label class="form-label">Diskon (IDR)</label>
                                    <input type="text" name="diskon" id="diskon" class="form-control"
                                        placeholder="masukan angka dalam satuan mata uang, tanpa titik atau koma">
                                </div>
                                <div class="form-group" style="display: none" id="form-total">
                                    <label class="form-label">Total Pembayaran</label>
                                    <input type="text" name="pembayaran" class="form-control" id="total" readonly>
                                </div>
                                <div class="form-group" style="display: none" id="form-pembayaran">
                                    <label class="form-label">Pembayaran</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="via" value="tunai" class="selectgroup-input"
                                                checked="">
                                            <span class="selectgroup-button">Tunai</span>
                                        </label>
                                        <label class="selectgroup-item" style="display: none" id="opsi-tabungan">
                                            <input type="radio" name="via" value="tabungan" class="selectgroup-input">
                                            <span class="selectgroup-button">Potong Tabungan</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none" id="form-keterangan">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="3"
                                        class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-primary ml-auto" style="display: none"
                                id="btn-simpan">Simpan</button>
                        </div>
                        {{--
                    </form> --}}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Histori Transaksi</h3>
                        {{-- <div class="card-options">
                            <a href="{{ route('transaksi.export') }}" class="btn btn-primary btn-sm ml-2"
                                download="true">Export</a>
                            <a href="#!cetak" class="btn btn-outline-primary btn-sm ml-2" id="mass-cetak">Cetak</a>
                        </div> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-hover table-vcenter text-wrap">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Tanggal</th>
                                    <th>User</th>
                                    <th>Transaksi</th>
                                    <th>Dibayarkan</th>
                                    <th>Keterangan</th>
                                    <th>Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spp as $index => $item)
                                <tr>
                                    <td><span class="text-muted">{{ $index+1 }}</span></td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('user.show', $item->user->id) }}" target="_blank">
                                            {{ $item->user->name.'('.$item->user->kelas->nama.')' }}
                                        </a>
                                    </td>
                                    <td>{{ $item->transaksi->nama }}</td>
                                    {{-- <td>IDR. {{ format_idr($item->diskon) }}</td> --}}
                                    {{-- <td>IDR. {{ format_idr($item->keuangan->jumlah) }}</td> --}}
                                    <td style="max-width:150px;">{{ $item->keterangan }}</td>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input tandai"
                                                name="example-checkbox2" value="{{ $item->id }}">
                                            <span class="custom-control-label">Tandai</span>
                                        </label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="ml-auto mb-0">
                                {{ $spp->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
