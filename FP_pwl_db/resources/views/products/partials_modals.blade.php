<div class="modal fade" id="modalCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Kelola Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <form action="{{ route('w.category.store', $warehouse->id) }}" method="POST" class="mb-4">
                    @csrf
                    <label class="small text-muted mb-1">Buat Kategori Baru</label>
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Elektronik" required>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>

                <hr>

                <label class="small text-muted mb-2">Daftar Kategori Saat Ini:</label>
                <div class="list-group">
                    @forelse($categories as $c)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $c->name }}</span>
                        
                        <form action="{{ route('w.category.delete', [$warehouse->id, $c->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Yakin hapus kategori ini? Barang di dalamnya TIDAK akan terhapus.')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="text-center text-muted py-2">Belum ada kategori.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAttribute">
    <div class="modal-dialog">
        <form action="{{ route('w.attribute.store', $warehouse->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5>Tambah Kolom Kustom</h5></div>
                <div class="modal-body">
                    <p class="text-muted small">Kolom ini akan muncul di form barang (misal: Warna, Ukuran).</p>
                    <input type="text" name="attribute_name" class="form-control" placeholder="Nama Atribut" required>
                </div>
                <div class="modal-footer"><button class="btn btn-primary">Simpan</button></div>
            </div>
        </form>
    </div>
</div>