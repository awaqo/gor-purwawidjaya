@extends('layout.app-admin')

@section('title', 'Kelola Lapangan')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Lapangan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item active">Lapangan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="mb-2">
                <a id="tambah-lapangan" href="{{ route('admin.court.add') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Lapangan
                </a>
            </div>
            <div class="my-3 fst-italic bg-info">
                <strong>**Note:</strong> Tambahkan foto agar lapangan yang baru ditambah dapat muncul pada menu booking
            </div>
            <div class="mb-3 table-responsive">
                {{-- <div class="h2">Perlu Konfirmasi</div> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-primary-subtle text-center">Nama</th>
                            <th scope="col" class="bg-primary-subtle text-center">Deskripsi</th>
                            <th scope="col" class="bg-primary-subtle text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($court as $data)
                            <tr>
                                <td class="text-center">{{ $data->court_name }}</td>
                                <td style="width: 60%;">
                                    <span style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {!! $data->description !!}
                                    </span>
                                </td>
                                <td style="width: 15%">
                                    <div class="d-flex justify-content-center gap-2">
                                        <div>
                                            <a id="detail-{{ $data->slug }}" href="{{ route('admin.court.detail', $data->id) }}" class="btn btn-primary px-3 btn-sm">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a id="edit-{{ $data->slug }}" href="{{ route('admin.court.edit', $data->id) }}" class="btn btn-warning px-3 btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <button type="button" value="{{ $data->id }}" class="deleteBtn btn btn-danger px-3 btn-sm" id="del-modal-{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#delFotoLap">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">Seluruh transaksi sudah dikonfirmasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal -->

    {{-- Hapus Foto --}}
    <div class="modal fade" id="delFotoLap" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="delFotoLapLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="fw-bold mb-2">Yakin ingin menghapus lapangan yang dipilih?</div>
                    <div class="text-secondary">Data yang dihapus tidak dapat dipulihkan kembali</div>
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.court.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="court_id" id="delete_id">
                        <button type="submit" id="delete-btn" class="btn btn-danger px-5">
                            Yakin
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('successEditCourt'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Edit Berhasil',
                text: "{{ Session::get('successEditCourt') }}",
                showConfirmButton: false,
                toast: true,
                timer: 4000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('successAddCourt'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tambah Berhasil',
                text: "{{ Session::get('successAddCourt') }}",
                showConfirmButton: false,
                toast: true,
                timer: 4000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('successDeleteCourt'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Hapus Berhasil',
                text: "{{ Session::get('successDeleteCourt') }}",
                showConfirmButton: false,
                toast: true,
                timer: 4000,
                timerProgressBar: true,
            })
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function(e) {
                e.preventDefault();

                var d_id = $(this).val();
                $('#delete_id').val(d_id);

                $('#deleteModal').modal('show');
            });
        })
    </script>
@endpush