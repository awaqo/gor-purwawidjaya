@extends('layout.app-admin')

@section('title', 'Maps GOR')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Google Maps GOR Purwawidjaya</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item active">Maps</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            @if ($maps->count() == 1)
                <div></div>
            @else
                <div class="mb-2">
                    <a id="tambah-lapangan" href="{{ route('admin.maps.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Source Peta GOR
                    </a>
                </div>
            @endif
            
            <div class="my-3">
                <strong>Cara menambahkan source google maps</strong>
                <ol>
                    <li>Buka <a href="https://www.google.com/maps" target="_blank">Google Maps</a> di browser Anda</li>
                    <li>Ketikkan alamat yang diinginkan</li>
                    <li>Tekan tombol "Bagikan" atau "Share"</li>
                    <li>Pilih "Sematkan peta" atau "Embed a map"</li>
                    <li>Copy yang berada di dalam src""</li>
                </ol>
            </div>
            <div class="mb-3 table-responsive">
                {{-- <div class="h2">Perlu Konfirmasi</div> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-primary-subtle text-center">Source Google Maps</th>
                            <th scope="col" class="bg-primary-subtle text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($maps as $data)
                            <tr>
                                <td style="max-width: 300px" class="text-truncate">{{ $data->source }}</td>
                                
                                <td style="width: 15%">
                                    <div class="d-flex justify-content-center gap-2">
                                        <div>
                                            <a id="edit-{{ $data->id }}" href="{{ route('admin.maps.edit', $data->id ) }}" class="btn btn-warning px-3 btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <button type="button" value="{{ $data->id }}" class="deleteBtn btn btn-danger px-3 btn-sm" id="del-modal-{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#delMaps">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="2">Tidak ada data source Google Maps GOR</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal -->

    {{-- Hapus Foto --}}
    <div class="modal fade" id="delMaps" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="delMapsLabel" aria-hidden="true">
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
                    <form action="{{ route('admin.maps.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source_id" id="delete_id">
                        <button type="submit" id="delete-btn" class="btn btn-danger px-5">
                            Yakin
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('successEditMaps'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Edit Berhasil',
                text: "{{ Session::get('successEditMaps') }}",
                showConfirmButton: false,
                toast: true,
                timer: 4000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('successAddMaps'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tambah Berhasil',
                text: "{{ Session::get('successAddMaps') }}",
                showConfirmButton: false,
                toast: true,
                timer: 4000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('successDeleteMaps'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Hapus Berhasil',
                text: "{{ Session::get('successDeleteMaps') }}",
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