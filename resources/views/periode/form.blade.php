@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ (isset($periode) ? route('periode.update', $periode->id) : route('periode.create')) }}"
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
                                    value="{{ isset($periode) ? $periode->nama : old('nama') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal Mulai s/d Selesai</label>
                                <div class="row gutters-xs">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="tgl_mulai" id="datepicker"
                                            placeholder="Tanggal Mulai" required autocomplete="off"
                                            value="{{ isset($periode) ? $periode->tgl_mulai : old('tgl_mulai') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="tgl_selesai"
                                            data-toggle="datepicker" placeholder="Tanggal Selesai" required
                                            autocomplete="off"
                                            value="{{ isset($periode) ? $periode->tgl_selesai : old('tgl_selesai') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Status</div>
                                <label class="custom-switch">
                                    <input type="checkbox" name="is_active" value="1" class="custom-switch-input" {{
                                        isset($periode) ? ($periode->is_active ? 'checked' : '') : '' }}>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Aktif</span>
                                </label>
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
