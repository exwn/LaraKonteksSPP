@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                    <a href="{{ route('periode.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah
                        Periode</a>
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

                    <table class="table card-table table-hover table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Nama</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Aktif</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periode as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    {{ $item->tgl_mulai }}
                                </td>
                                <td>
                                    {{ $item->tgl_selesai }}
                                </td>
                                <td>
                                    @if($item->is_active)
                                    <span class="tag tag-green">Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="{{ route('periode.edit', $item->id) }}"
                                        title="edit item">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- <a class="btn btn-danger btn-sm"
                                        href="{{ route('periode.destroy', $item->id) }}" method="POST"
                                        data-id="{{ $item->id }}" title="delete item">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <form action="{{ route('periode.destroy', $item->id) }}" method="POST"
                                        id="form-{{ $item->id }}">
                                        @csrf
                                    </form> --}}
                                    {!! Form::open(['method' => 'POST','route' => ['periode.destroy',
                                    $item->id],'style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="bi bi-trash"></i>', ['class' => 'btn btn-danger
                                    btn-sm', 'type' => 'submit']) !!}@csrf
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $periode->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
