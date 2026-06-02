@extends('admin.layouts.app')


@section('css')
    {{-- CSS Tambahan --}}
@endsection



@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data {{ $title }}</h5>
            <a href="{{ route('item.create') }}" class="btn btn-primary mb-4">Tambah Data {{ $title }}</a>
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Kategori</th>
                            <th>Kode Unik</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ asset('photos/' . $item->photo) }}" target="_blank">Lihat Foto</a>
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->unique_code }}</td>
                                <td>{{ $item->condition }}</td>
                                <td>
                                    <a href="{{ route('item.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    <form id="deleteForm{{ $item->id }}"
                                        action="{{ route('item.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">Hapus</button>
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
