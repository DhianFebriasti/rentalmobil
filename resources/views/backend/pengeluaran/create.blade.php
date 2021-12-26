@include('backend.pengeluaran.form')

<script>
    $('#modal-pengeluaran-title').text('Tambah Pengeluaran')

    $('#modal-pengeluaran-footer').html(`
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-sm btn-danger" form="form-pengeluaran">Simpan</button>
    `)
</script>

<script>
    $('#form-pengeluaran').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "{{ route('pengeluaran.store') }}",
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,

            success: function(data){
                $('#modal-pengeluaran').modal('hide')
                getTablePengeluaran()
            },

            error: (req, status, error)=> {
                console.log('GAGAL pada sistem')
            },

        });
    })
</script>
