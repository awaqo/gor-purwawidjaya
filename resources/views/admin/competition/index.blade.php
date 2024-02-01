@extends('layout.app-admin')

@section('title', 'Informasi Perlombaan')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Informasi Perlombaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item active">Perlombaan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="mb-3 table-responsive">
                {{-- <div class="h2">Perlu Konfirmasi</div> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-primary-subtle text-center">Judul</th>
                            <th scope="col" class="bg-primary-subtle text-center">Lokasi</th>
                            <th scope="col" class="bg-primary-subtle text-center">Pelaksanaan</th>
                            <th scope="col" class="bg-primary-subtle text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($competition as $data)
                            <tr>
                                <td class="align-middle text-center" style="width: 35%">{{ $data->title }}</td>
                                <td class="align-middle text-center" style="width: 25%">{{ $data->location }}</td>
                                <td class="align-middle" style="width: 25%">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <div class="bg-primary px-2 py-1 badge">{{ date('D, d-m-Y', strtotime($data->date_start)) }}</div>
                                        <div>-</div>
                                        <div class="bg-primary px-2 py-1 badge">{{ date('D, d-m-Y', strtotime($data->date_end)) }}</div>
                                    </div>
                                </td>
                                <td style="width: 15%">
                                    <div class="d-flex justify-content-center gap-2">
                                        <div>
                                            <a id="detail-{{ $data->slug }}" href="#" class="btn btn-primary px-3 btn-sm">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a id="edit-{{ $data->slug }}" href="#" class="btn btn-warning px-3 btn-sm">
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
                            <tr>
                                <td colspan="4">Belum ada data perlombaan</td>
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
                    <div class="fw-bold mb-2">Yakin ingin menghapus data yang dipilih?</div>
                    <div class="text-secondary">Data yang dihapus tidak dapat dipulihkan kembali</div>
                </div>
                <div class="modal-footer border-0">
                    <form action="#" method="POST">
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