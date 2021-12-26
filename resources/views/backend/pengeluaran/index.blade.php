@extends('backend.layouts')

@section('title','Pengeluaran')

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h5>Data Pengeluaran</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12 mb-3">
                    <button type="button" class="btn btn-sm btn-danger" id="button-tambah-pengeluaran" onclick="tambahPengeluaran()">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Pengeluaran
                    </button>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered" id="table-pengeluaran" style="color: black !important;">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-right">No</th>
                                    <th>Pengeluaran</th>
                                    <th class="text-right">Jumlah</th>
                                    <th class="text-center">Tanggal Pengeluaran</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer"></div>
    </div>
</div>

<div class="modal" id="modal-pengeluaran" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-pengeluaran-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-pengeluaran-body"></div>
            </div>
            <div class="modal-footer">
                <div id="modal-pengeluaran-footer"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        function getTablePengeluaran() {
            let tablePengeluaran = $('#table-pengeluaran').DataTable({
                destroy: true,
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
                order: [],
                ajax: {
                    url: "{{ route('pengeluaran.datatable') }}",
                    method: "get",
                    data: {}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'pengeluaran', name: 'pengeluaran'},
                    {data: 'jumlah', name: 'jumlah'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'menu', name: 'menu'},
                ],
                language: {
                    processing: '<i class="fas fa-spinner fa-spin fa-lg"></i> Sedang diproses',
                    searchPlaceholder: 'Cari Sesuatu...'
                },
            })
        }getTablePengeluaran()
    </script>

    <script>
        function tambahPengeluaran() {
            $.ajax({
                url: `{{ route('pengeluaran.tambah') }}`,
                method: 'get',

                beforeSend: ()=> {
                    $('#button-tambah-pengeluaran').html(`
                        <i class="fas fa-spinner fa-spin"></i> Sedang diproses
                    `)
                    .attr('disabled')
                },

                success: (data)=> {
                    $('#modal-pengeluaran').modal('show')
                    $('#modal-pengeluaran-body').html(data)

                    $('#button-tambah-pengeluaran').html(`
                        <i class='fas fa-plus-circle'></i>
                        Tambah Pengeluaran
                    `)
                    .attr('disabled', false)
                },

                error: ()=> {
                    $('#button-tambah-pengeluaran').html(`
                        <i class='fas fa-plus-circle'></i>
                        Tambah Pengeluaran
                    `)
                    .attr('disabled', false)

                    console.log(`Gagal Memuat, Kesalahan pada sistem`)
                }

            })
        }
    </script>
@endpush
