<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil</title>
    <script>
        function calculateTotal() {
            const hargaSewa = parseFloat(document.getElementById('harga_sewa').value);
            const tanggalSewa = new Date(document.getElementById('tanggal_sewa').value);
            const tanggalKembali = new Date(document.getElementById('tanggal_kembali').value);

            if (tanggalSewa && tanggalKembali && hargaSewa) {
                const diffTime = Math.abs(tanggalKembali - tanggalSewa);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const totalBiaya = diffDays * hargaSewa;

                // Update hidden input field and display total cost
                document.getElementById('total_biaya').value = totalBiaya;
                document.getElementById('total_biaya_display').textContent = 'Total Biaya: Rp ' + totalBiaya.toLocaleString();
            } else {
                document.getElementById('total_biaya').value = '';
                document.getElementById('total_biaya_display').textContent = '';
            }
        }
    </script>
</head>

<body>
    @include('frontend.bandung.layouts.navbar')

    <div class="container mt-5">
        <h2>Form Sewa Mobil</h2>
        <form action="{{ route('sewa.store', $mobil->id_mobil) }}" method="POST">
            @csrf

            <!-- Hidden fields to store selected car and logged-in user details -->
            <input type="hidden" name="id_mobil" value="{{ $mobil->id_mobil }}">

            <!-- Car details (readonly) -->
            <div class="mb-3">
                <label for="merk" class="form-label">Merk Mobil</label>
                <input type="text" class="form-control" id="merk" value="{{ $mobil->merk }}" readonly>
            </div>

            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Mobil</label>
                <input type="text" class="form-control" id="jenis" value="{{ $mobil->jenis_mobil }}" readonly>
            </div>

            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa"
                    onchange="calculateTotal()">
            </div>

            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                    onchange="calculateTotal()">
            </div>

            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                    <option value="bayar ditempat">Bayar di Tempat</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="bukti_pembayaran" class="form-label">bukti_pembayaran Mobil</label>
                <input type="text" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" placeholder="INI HARUSNYA TIPE FILE CUMA BELUM URANG SETTING">
            </div>

            <input type="hidden" id="harga_sewa" value="{{ $mobil->harga_sewa }}">
            <input type="hidden" name="total_biaya" id="total_biaya">

            <!-- Display total cost -->
            <div class="mb-3">
                <span id="total_biaya_display"></span>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Kirim Sewa</button>
        </form>
    </div>
</body>

</html>