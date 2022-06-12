@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form
                action="{{ (isset($transaksi) ? route('transaksi.update', $transaksi->id) : route('transaksi.create')) }}"
                method="post" class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                </div>
                <div class="card-body">
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
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama"
                                    value="{{ isset($transaksi) ? $transaksi->nama : old('nama') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah"
                                    value="{{ isset($transaksi) ? $transaksi->jumlah : old('jumlah') }}" required>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Peserta</div>
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="radio" name="peserta" value="1" class="custom-switch-input" {{
                                            isset($transaksi) ? ($transaksi->wajib_semua == 1 ? 'checked' : '') :
                                        'checked'
                                        }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Wajib Semua Siswa</span>
                                    </label>
                                    {{-- <label class="custom-switch">
                                        <input type="radio" name="peserta" value="2" class="custom-switch-input" {{
                                            isset($transaksi) ? (($transaksi->kelas_id != null) ? 'checked' : '') : ''
                                        }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Hanya Kelas</span>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="radio" name="peserta" value="3" class="custom-switch-input" {{
                                            isset($transaksi) ? (($transaksi->kelas_id == null &&
                                        $transaksi->wajib_semua ==
                                        null) ? 'checked' : '') : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Hanya Siswa</span>
                                    </label> --}}
                                </div>
                            </div>
                            <div class="form-group"
                                style="display: {{ isset($transaksi) ? (($transaksi->kelas_id != null) ? 'block' : 'none') : 'none' }}"
                                id="form-kelas">
                                <label class="form-label">Kelas</label>

                                <select class="form-control" name="kelas_id" id="hanya-kelas">
                                    @foreach($kelas as $item)
                                    <option value="{{ $item->id }}" {{ isset($transaksi) ? (($transaksi->kelas_id ==
                                        $item->id) ? 'selected' : '') : '' }}>
                                        {{ $item->nama }} - {{ isset($item->periode) ? $item->periode->nama : '' }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"
                                style="display: {{ isset($transaksi) ? (($transaksi->kelas_id == null && $transaksi->wajib_semua == null) ? 'block' : 'none') : 'none' }}"
                                id="form-siswa">
                                <label class="form-label">Siswa</label>
                                <span class="custom-switch-description">Hanya Siswa</span>
                                {{-- <select class="form-control" name="siswa_id[]" id="hanya-siswa" multiple>
                                    @foreach($user as $item)
                                    <option value="{{ $item->id }}" {{ isset($transaksi) ? (($transaksi->wajib_semua ==
                                        null
                                        && $transaksi->kelas_id == null) ? (in_array($item->id,
                                        $transaksi->user->pluck('id')->toArray()) ? 'selected' : '') : '') : '' }}>
                                        {{ $item->name }} - {{ $item->kelas->nama }} {{ isset($item->kelas->periode) ?
                                        "(". $item->kelas->periode->nama .")" : ''}}
                                    </option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-link">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-MM-dd'
    });
</script>
@endsection
