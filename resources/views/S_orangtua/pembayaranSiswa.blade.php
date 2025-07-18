<x-orangtua-layout :orangtua="$orangtua">


<div class="container">
    <h2>Pembayaran Siswa</h2>

    <h4 class="mt-4">Riwayat Pembayaran</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $data)
                <tr>
                    <td>Rp {{ number_format($data->jumlah_tagihan, 0, ',', '.') }}</td>
                    <td>{{ $data->tanggal_tagihan }}</td>
                    <td>{{ strtoupper($data->status_pembayaran) }}</td>
                    <td>
                        @if($data->bukti_pembayaran)
                            <img src="{{ asset('storage/' . $data->bukti_pembayaran) }}" width="100">
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada pembayaran</td></tr>
            @endforelse
        </tbody>
    </table>

    <h4 class="mt-4">Status Pembayaran</h4>
    @if($statusAktif)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Rp {{ number_format($statusAktif->jumlah_tagihan, 0, ',', '.') }}</td>
                <td>{{ $statusAktif->tanggal_tagihan }}</td>
                <td>{{ strtoupper($statusAktif->status_pembayaran) }}</td>
            </tr>
        </tbody>
    </table>
    @else
        <p>Tidak ada tagihan aktif.</p>
    @endif

    <h4 class="mt-4">Upload Bukti Pembayaran</h4>
    <form action="{{ route('pembayaran.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Jumlah Tagihan:</label>
            <input type="number" name="jumlah_tagihan" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label>Upload Bukti (JPG/PNG):</label>
            <input type="file" name="bukti_pembayaran" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Upload</button>
    </form>
</div>
</x-orangtua-layout>
