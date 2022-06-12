@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                    {{-- <a href="{{ route('user.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah
                        Pengguna</a> --}}
                    <a href="{{ route('user.create') }}" type="button" class="btn btn-outline-primary btn-sm"
                        data-mdb-ripple-color="dark">Tambah
                        Pengguna</a>
                </div>


                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="w-1">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @foreach ($users as $index => $item ) --}}
                            @foreach ($data as $index => $item)

                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>{{ $item->roles[0]->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('user.edit', $item->id) }}" title="edit item"
                                        class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    @if(Auth::user()->id != $item->id)
                                    {{-- {!! Form::submit('', ['class' => 'btn btn-secondary btn-sm']) !!} --}}
                                    {!! Form::open(['method' => 'POST','route' => ['user.destroy',
                                    $item->id],'style'=>'display:inline']) !!}
                                    {{-- <span class="btn btn-danger
                                    btn-sm"><i class="bi bi-trash"></i></span> --}}
                                    {!! Form::button('<i class="bi bi-trash"></i>', ['class' => 'btn btn-danger
                                    btn-sm', 'type' => 'submit']) !!}
                                    {{-- {{ Form::button('<i class="bi bi-trash"></i>', ['class' => 'btn btn-danger
                                    btn-sm',
                                    'type' => 'submit']) }} --}}

                                    {{-- <a href="#!" data-id="{{ $item->id }}" title="delete item"
                                        class="btn btn-secondary btn-sm"><i class="bi bi-trash"></i></a> --}}
                                    {!! Form::close() !!}
                                    @endif
                                    {{-- {!! Form::open(['method' => 'POST','route' =>
                                    ['user.destroy',$item->id],'style'=>'display:inline']) !!}
                                    @csrf --}}
                                    {{-- <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                        id="form-{{ $item->id }}">
                                        @csrf
                                    </form> --}}

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- {!! $data->render() !!} --}}
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
