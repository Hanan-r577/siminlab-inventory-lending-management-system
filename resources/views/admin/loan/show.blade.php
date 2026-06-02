@extends('admin.layouts.app')
@section('css')
    {{-- CSS Tambahan --}}
@endsection

@section('content')
    <div class="row">
        {{-- KOLOM KIRI: DETAIL PEMINJAMAN --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Detail Peminjaman</h5>
                    <table class="table table-striped table-bordered-0">
                        <tbody>
                            <tr>
                                <th>Nama Peminjam</th>
                                <td>{{ $loan->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pinjam</th>
                                <td>
                                    {{ \Carbon\Carbon::parse($loan->loan_date)->format('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl Wajib Kembali</th>
                                <td>
                                    {{ \Carbon\Carbon::parse($loan->return_date)->format('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Aktual Kembali</th>
                                <td>
                                    @if ($loan->actual_return_date)
                                        {{ \Carbon\Carbon::parse($loan->actual_return_date)->format('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($loan->status == 'Dipinjam')
                                        <span class="badge bg-warning">{{ $loan->status }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $loan->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DETAIL BARANG --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Detail Barang</h5>
                    @if ($loan->item->photo)
                        <div class="mb-3 text-center">
                            <img src="{{ asset('photos/' . $loan->item->photo) }}" alt="Foto Barang"
                                class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    @endif
                    <table class="table table-striped table-bordered-0">
                        <tbody>
                            <tr>
                                <th>Nama Barang</th>
                                <td>{{ $loan->item->name }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $loan->item->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Kode Unik</th>
                                <td>{{ $loan->item->unique_code }}</td>
                            </tr>
                            <tr>
                                <th>Kondisi</th>
                                <td>{{ $loan->item->condition }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- TOMBOL AKSI --}}
    <div class="card">
        <div class="card-body">
            <div class="mt-3 d-flex justify-content-between">
                <a href="{{ route('loan.index') }}" class="btn btn-warning">Kembali</a>
                {{-- Tombol ini hanya muncul jika status masih 'Dipinjam' --}}
                @if ($loan->status == 'Dipinjam')
                    <form action="{{ route('loan.return', $loan->id) }}" method="POST">
                        @csrf
                        @method('PUT');
                        <button type="submit" class="btn btn-success">Kembalikan Barang</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- JS Tambahan --}}
@endsection
