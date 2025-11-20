@extends('layouts.guest.app')

@section('title', 'Kategori Pengaduan - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Kategori Pengaduan</h1>
                        <p class="mb-0">
                            Kelola kategori pengaduan untuk memudahkan klasifikasi dan penanganan laporan warga.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Kategori Pengaduan</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Kategori Pengaduan Section -->
    <section id="kategori_pengaduan" class="kategori_pengaduan section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Daftar Kategori Pengaduan</h2>
                        <a href="{{ route('kategori_pengaduan.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Kategori Baru
                        </a>
                    </div>
                </div>
            </div>

            <div class="row gy-4">
                @foreach ($kategoris as $item)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="kategori-card">
                        <div class="kategori-header">
                            <!-- Icon kategori -->
                            <div class="kategori-icon">
                                <i class="bi bi-tags"></i>
                            </div>
                            <div class="kategori-overlay">
                                <div class="action-links">
                                    <a href="{{ route('kategori_pengaduan.show', $item->kategori_id) }}" class="btn-info" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('kategori_pengaduan.edit', $item->kategori_id) }}" class="btn-edit" title="Edit Kategori">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('kategori_pengaduan.destroy', $item->kategori_id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus Kategori" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="kategori-content">
                            <h4>{{ $item->nama }}</h4>
                            <span class="kategori-id">ID: {{ $item->kategori_id }}</span>

                            <div class="kategori-info">
                                <p><strong>SLA:</strong> {{ $item->sla_hari }} hari</p>
                                <p><strong>Prioritas:</strong>
                                    <span class="prioritas-badge prioritas-{{ strtolower($item->prioritas) }}">
                                        {{ $item->prioritas }}
                                    </span>
                                </p>
                                <p><strong>Dibuat:</strong> {{ $item->created_at->format('d/m/Y') }}</p>
                                <p><strong>Diupdate:</strong> {{ $item->updated_at->format('d/m/Y') }}</p>
                            </div>

                            <div class="kategori-meta">
                                <div class="sla-info">
                                    <i class="bi bi-clock"></i>
                                    <span>Target: {{ $item->sla_hari }} hari</span>
                                </div>
                                <div class="prioritas-info">
                                    <i class="bi bi-exclamation-circle"></i>
                                    <span>{{ $item->prioritas }}</span>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <a href="{{ route('kategori_pengaduan.show', $item->kategori_id) }}" class="btn-info-full">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="{{ route('kategori_pengaduan.edit', $item->kategori_id) }}" class="btn-edit-full">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('kategori_pengaduan.destroy', $item->kategori_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-full" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- End Kategori Card -->
                @endforeach
            </div>

            @if ($kategoris->isEmpty())
            <div class="row">
                <div class="col-12 text-center">
                    <div class="empty-state" data-aos="fade-up">
                        <i class="bi bi-tags display-1 text-muted"></i>
                        <h3 class="mt-3">Belum Ada Kategori</h3>
                        <p class="text-muted">Mulai dengan menambahkan kategori pertama.</p>
                        <a href="{{ route('kategori_pengaduan.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Tambah Kategori Pertama
                        </a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section><!-- /Kategori Pengaduan Section -->
</main>

<style>
.kategori-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.kategori-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
}

.kategori-header {
    position: relative;
    height: 120px;
    overflow: hidden;
    background: linear-gradient(135deg, #175cdd 0%, #1a4bb8 100%);
}

.kategori-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    position: absolute;
    top: 20px;
    left: 20px;
    background: rgba(255, 255, 255, 0.2);
    border: 3px solid white;
}

.kategori-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.kategori-card:hover .kategori-overlay {
    opacity: 1;
}

.action-links {
    display: flex;
    gap: 10px;
}

.btn-info,
.btn-edit,
.btn-delete {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.btn-info {
    background: #17a2b8;
}

.btn-edit {
    background: #ffc107;
}

.btn-delete {
    background: #dc3545;
    border: none;
}

.btn-info:hover,
.btn-edit:hover,
.btn-delete:hover {
    transform: scale(1.1);
    color: white;
}

.kategori-content {
    padding: 20px;
}

.kategori-content h4 {
    color: #2c3e50;
    margin-bottom: 5px;
    font-weight: 600;
    line-height: 1.3;
}

.kategori-id {
    color: #6c757d;
    font-size: 0.8em;
    font-weight: 500;
}

.kategori-info {
    margin: 15px 0;
}

.kategori-info p {
    margin-bottom: 5px;
    font-size: 0.85em;
    color: #495057;
    line-height: 1.4;
}

.prioritas-badge {
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75em;
    font-weight: 600;
    text-transform: uppercase;
}

.prioritas-rendah { background: #28a745; color: white; }
.prioritas-sedang { background: #ffc107; color: #212529; }
.prioritas-tinggi { background: #fd7e14; color: white; }
.prioritas-kritis { background: #dc3545; color: white; }

.kategori-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 15px 0;
    padding: 10px 0;
    border-top: 1px solid #e9ecef;
    border-bottom: 1px solid #e9ecef;
}

.sla-info,
.prioritas-info {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.8em;
    font-weight: 500;
}

.sla-info { color: #17a2b8; }
.prioritas-info { color: #6c757d; }

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-info-full,
.btn-edit-full,
.btn-delete-full {
    flex: 1;
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    font-size: 0.8em;
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn-info-full {
    background: #17a2b8;
    color: white;
}

.btn-edit-full {
    background: #ffc107;
    color: #212529;
}

.btn-delete-full {
    background: #dc3545;
    color: white;
}

.btn-info-full:hover,
.btn-edit-full:hover,
.btn-delete-full:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

.empty-state {
    padding: 60px 20px;
}

.empty-state i {
    font-size: 4rem;
}
</style>
@endsection
