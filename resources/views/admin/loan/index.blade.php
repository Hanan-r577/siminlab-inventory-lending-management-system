@extends('admin.layouts.app')


@section('css')
    {{-- CSS Tambahan --}}
@endsection



@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data {{ $title }}</h5>
            <a href="{{ route('loan.create') }}" class="btn btn-primary mb-4">Tambah Data {{ $title }}</a>
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Barang</th>
                            <th>Tanggal pinjam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->user->name }}</td>
                                <td>
                                    <small>{{ $loan->item->unique_code }}</small>
                                    <span class="fw-bold">{{ $loan->item->name }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') }}</td>
                                <td>
                                    @if ($loan->status == 'Dipinjam')
                                        <span class="badge bg-warning">{{ $loan->status }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $loan->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('loan.show', $loan->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('loan.edit', $loan->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    <form id="deleteForm{{ $loan->id }}"
                                        action="{{ route('loan.destroy', $loan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $loan->id }})">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script>
        // Script untuk DataTables
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        // Script untuk SweetAlert
        function confirmDelete(id) {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Jika pengguna menekan "OK", submit form
                        $('#deleteForm' + id).submit();
                    } else {
                        // Jika pengguna menekan "Cancel"
                        swal("Data tidak jadi dihapus!", {
                            icon: "error",
                        });
                    }
                });
        }
    </script>
@endsection
