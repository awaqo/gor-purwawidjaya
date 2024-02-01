@extends('layout.app-admin')

@section('title', 'Detail Lapangan')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.court.manage') }}"
                        class="btn btn-outline-primary px-3 border border-light-subtle">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item">Lapangan</li>
                        <li class="breadcrumb-item active">Detail Lapangan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="mb-3">
                <div class="fw-semibold fs-3">{{ $court->court_name }}</div>
                <div class="mt-2">
                    <a id="add-{{ $court->slug }}" href="{{ route('admin.court.add-photo', $court->id) }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Foto
                    </a>
                </div>
            </div>
            <div class="mb-3 table-responsive">
                {{-- <div class="h2">Perlu Konfirmasi</div> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-primary-subtle text-center">Foto Lapangan</th>
                            <th scope="col" class="bg-primary-subtle text-center">Tanggal Tambah</th>
                            <th scope="col" class="bg-primary-subtle text-center">Tanggal Ubah</th>
                            <th scope="col" class="bg-primary-subtle text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courtImage as $data)
                            <tr class="text-center">
                                <td class="align-middle">
                                    <img width="200" class="img-fluid" src="{{ asset(Storage::url($data->image)) }}" alt="Foto {{ $court->court_name }} - {{ $data->id }}">
                                </td>
                                <td class="align-middle">{{ $data->created_at->format('d/m/Y - H:i') }} WIB</td>                        
                                <td class="align-middle">{{ $data->updated_at->format('d/m/Y - H:i') }} WIB</td>                        
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a id="edit-{{ $data->id }}" href="{{ route('admin.court.edit-photo', $data->id) }}" class="btn btn-warning px-3 btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button" value="{{ $data->id }}" class="deleteBtn btn btn-danger px-3 btn-sm" id="del-modal-{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#delFotoLap">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada foto lapangan</td>
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
                    <div class="fw-bold mb-2">Yakin ingin menghapus foto lapangan yang dipilih?</div>
                    <div class="text-secondary">Data yang dihapus tidak dapat dipulihkan kembali</div>
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.court.delete-photo') }}" method="POST">
                        @csrf
                        <input type="hidden" name="court_image_id" id="delete_id">
                        <button type="submit" id="delete-btn" class="btn btn-danger px-5">
                            Yakin
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('successEditPhoto'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Edit Berhasil',
                text: "{{ Session::get('successEditPhoto') }}",
                showConfirmButton: false,
                toast: true,
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('successDeletePhoto'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Hapus Foto Berhasil',
                text: "{{ Session::get('successDeletePhoto') }}",
                showConfirmButton: false,
                toast: true,
                timer: 3000,
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

                $('#delFotoLap').modal('show');
            });
        })
    </script>
@endpush