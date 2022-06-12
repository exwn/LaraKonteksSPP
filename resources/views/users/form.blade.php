@extends('layouts.app')

@section('site-name','Sistem Informasi SPP')
@section('page-name', (isset($user) ? 'Ubah Pengguna' : 'Pengguna Baru'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>


                <form class="row needs-validation g-3 p-3" novalidate
                    action="{{ (isset($user) ? route('user.update', $user->id) : route('user.create')) }}" method="POST"
                    class="card">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="validationCustom01" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Nama"
                            value="{{ isset($user) ? $user->name : old('name') }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom02" class="form-label">Email</label>
                        <input type="text" class="form-control" id="validationCustom02" name="email" placeholder="Email"
                            value="{{ isset($user) ? $user->email : old('email') }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom03" class="form-label">Password</label>
                        <input type="password" class="form-control" id="validationCustom03" name="password" value="" {{
                            isset($user) ? '' : 'required' }}>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom04" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="validationCustom04" name="password_confirmation"
                            value="" {{ isset($user) ? '' : 'required' }}>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="validationCustom01" class="form-label">Nama</label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                        {{ dd($roles) }}
                        <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Nama"
                            value="{{ isset($user) ? $user->roles[0]->name : old('name') }}">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="validationCustom05" class="form-label">Status</label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}

                        {{-- {{ dd($userRole) }} --}}

                        {{-- <select id="select-beast" class="form-control custom-select" name="role">
                            <option value="admin" {{ isset($user) ? ($user->roles == 'admin' ? 'selected' : '')
                                : '' }}>Admin</option>
                            <option value="user" {{ isset($user) ? ($user->roles == 'user' ? 'selected' : '') : ''
                                }}>User</option>
                        </select> --}}
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>


                    <div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
