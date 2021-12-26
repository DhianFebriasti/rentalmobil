<form method="POST" id="form-pengeluaran">
    @csrf

    @if ($tipe == 'tambah')
        @method('POST')
    @elseif ($tipe == 'edit')
        @method('PUT')
        <input type="hidden" name="id" value="{{ $pengeluaran->id }}" required readonly>
    @endif

    <div class="form-group">
        <label for="pengeluaran" class="form-label text-dark">
            Pengeluaran
            <i class="text-danger">*</i>
        </label>
        <input
            type="text" class="form-control" id="pengeluaran" name="pengeluaran"
            required
            placeholder="Ketik nama pengeluaran"
            minlength="2"
            autocomplete="off"
            @if ($tipe == 'edit')
                value="{{ $pengeluaran->pengeluaran }}"
            @endif
        >
    </div>

    <div class="form-group">
        <label for="jumlah" class="form-label text-dark">
            Jumlah Pengeluaran
            <i class="text-danger">*</i>
        </label>
        <input
            type="text" class="form-control" id="jumlah" name="jumlah"
            required
            placeholder="Ketik jumlah pengeluaran"
            autocomplete="off"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
            onkeyup="nominal()"
            @if ($tipe == 'edit')
                value="{{ $pengeluaran->jumlah }}"
            @endif
        >
    </div>

    <div class="form-group">
        <label for="tanggal" class="form-label text-dark">
            Tanggal Pengeluaran
            <i class="text-danger">*</i>
        </label>
        <input
            type="date" class="form-control" id="tanggal" name="tanggal"
            required
            minlength="2"
            autocomplete="off"
            @if ($tipe == 'tambah')
                value="{{ date('Y-m-d') }}"
            @elseif ($tipe == 'edit')
                value="{{ $pengeluaran->tanggal }}"
            @endif
        >
    </div>
</form>

<script>
    function nominal() {
        let value = $('#jumlah').val()
            valueFormat = value.replaceAll('.', '')

        return $('#jumlah').val(new Intl.NumberFormat('id-ID').format(valueFormat))
    }
</script>
