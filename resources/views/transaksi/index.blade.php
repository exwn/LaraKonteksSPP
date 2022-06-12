@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                    {{-- <a href="{{ route('transaksi.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah
                        Transaksi</a> --}}
                    <a href="{{ route('transaksi.create') }}" type="button" class="btn btn-outline-primary btn-sm"
                        data-mdb-ripple-color="dark">Tambah
                        Transaksi</a>
                </div>
                @if(session()->has('msg'))
                <div class="card-alert alert alert-{{ session()->get('type') }}" id="message"
                    style="border-radius: 0px !important">
                    @if(session()->get('type') == 'success')
                    <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    @else
                    <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                    @endif
                    {{ session()->get('msg') }}
                </div>
                @endif
                <div class="table-responsive">

                    <table class="table card-table table-hover table-vcenter text-wrap">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Peserta</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    {{ $item->jumlah }}
                                </td>
                                <td style="max-width: 150px">
                                    @if($item->wajib_semua != null)
                                    <p>Wajib Semua</p>
                                    @elseif($item->kelas_id != null)
                                    <p>{{ $item->kelas->nama }} {{ isset($item->kelas->periode) ? ' -
                                        '.$item->kelas->periode->nama : '' }}</p>
                                    @elseif($item->wajib_semua == null && $item->kelas_id == null)
                                    @foreach ($item->role as $role)
                                    {{ $role->siswa->nama }}{{ " (".$role->siswa->kelas->nama.")" }},
                                    @endforeach
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="{{ route('transaksi.edit', $item->id) }}"
                                        title="edit item">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {!! Form::open(['method' => 'POST','route' => ['transaksi.destroy',
                                    $item->id],'style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="bi bi-trash"></i>', ['class' => 'btn btn-danger
                                    btn-sm', 'type' => 'submit']) !!}@csrf
                                    {!! Form::close() !!}
                                    {{-- <a class="icon btn-delete" href="#!" data-id="{{ $item->id }}"
                                        title="delete item">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                    <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST"
                                        id="form-{{ $item->id }}">
                                        @csrf
                                    </form> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $transaksi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
