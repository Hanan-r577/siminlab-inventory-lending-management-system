@extends('admin.layouts.app')
@section('css')
@endsection



@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data {{ $title }}</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('loan.update', $loan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Nama Peminjam --}}     
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama Peminjam</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id"
                                id="user_id">
                                <option value="" disabled selected>Pilih Peminjam</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $loan->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Nama Barang --}}
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Nama Barang</label>
                            <select class="form-select @error('item_id') is-invalid @enderror" name="item_id"
                                id="item_id">
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" {{ old('item_id', $loan->item_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} - ({{ $item->unique_code }})</option>
                                @endforeach
                            </select>
                            @error('item_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Tanggal Pinjam --}}
                        <div class="mb-3">
                            <label for="loan_date" class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control @error('loan_date') is-invalid @enderror" name="loan_date"
                                id="loan_date" value="{{ old('loan_date', \Carbon\Carbon::parse($loan->loan_date)->format('Y-m-d')) }}">
                            @error('loan_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Tanggal Pengembalian --}}
                        <div class="mb-3">
                            <label for="return_date" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control @error('return_date') is-invalid @enderror" name="return_date"
                                id="return_date" value="{{ old('return_date', \Carbon\Carbon::parse($loan->return_date)->format('Y-m-d')) }}">
                            @error('return_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('loan.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>  
@endsection



@section('js')
    {{-- JS Tambahan --}}
@endsection
