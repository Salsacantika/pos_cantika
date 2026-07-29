@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<!-- CSS Khusus Cetak/Print Optimization -->
<style>
    @media print {
        body {
            background-color: #ffffff !important;
        }
        .no-print {
            display: none !important;
        }
        .print-card {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
    }
</style>

<div class="container mx-auto px-4 py-8 max-w-5xl">
    <!-- Header Page & Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4 no-print">
        <div class="flex items-center gap-3">
            <a href="{{ route('penjualan.index') }}" class="p-2.5 bg-white text-gray-600 rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-gray-900 transition shadow-sm" title="Kembali">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Detail Transaksi</h1>
                <p class="text-xs text-gray-500 mt-0.5">Faktur: <span class="font-semibold text-gray-700">#{{ $penjualan->nomor_faktur ?? $penjualan->kode_transaksi ?? $penjualan->id }}</span></p>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="px-4 py-2.5 bg-[#B47454] text-white rounded-xl hover:bg-[#9f6245] font-medium text-sm transition-all shadow-md hover:shadow-lg flex items-center gap-2 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Struk / Faktur
            </button>
        </div>
    </div>

    <!-- Main Invoice Card -->
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-100 border border-gray-200/80 overflow-hidden print-card">
        
        <!-- Header Faktur dengan Warna Senada Sidebar -->
        <div class="p-6 md:p-8 border-b border-gray-100 bg-[#B47454] text-white flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-medium text-white mb-3 border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                    {{ strtoupper($penjualan->status ?? 'COMPLETED') }}
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight">FAKTUR PENJUALAN</h2>
                <p class="text-orange-100 text-sm mt-1 font-mono">No: #{{ $penjualan->nomor_faktur ?? $penjualan->kode_transaksi ?? $penjualan->id }}</p>
            </div>
            <div class="text-left md:text-right border-t md:border-t-0 border-white/20 pt-4 md:pt-0">
                <span class="text-xs text-orange-100 uppercase font-semibold tracking-wider block mb-1">Total Transaksi</span>
                <span class="text-3xl font-bold text-white font-mono">
                    Rp {{ number_format($penjualan->total_pembayaran ?? $penjualan->total_harga ?? 0, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Meta Information Cards -->
        <div class="p-6 md:p-8 bg-amber-50/30 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 border-b border-gray-100">
            <!-- Tanggal & Waktu -->
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-start gap-3">
                <div class="p-2.5 bg-[#B47454]/10 text-[#B47454] rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-medium block">Tanggal & Waktu</span>
                    <span class="text-sm font-semibold text-gray-800">
                        {{ isset($penjualan->created_at) ? \Carbon\Carbon::parse($penjualan->created_at)->format('d M Y, H:i') : '-' }} WIB
                    </span>
                </div>
            </div>

            <!-- Kasir -->
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-start gap-3">
                <div class="p-2.5 bg-[#B47454]/10 text-[#B47454] rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-medium block">Kasir Bertugas</span>
                    <span class="text-sm font-semibold text-gray-800">
                        {{ $penjualan->user->name ?? $penjualan->kasir->name ?? 'Kasir System' }}
                    </span>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-start gap-3 sm:col-span-2 lg:col-span-1">
                <div class="p-2.5 bg-[#B47454]/10 text-[#B47454] rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-medium block">Pembayaran</span>
                    <span class="text-sm font-semibold text-gray-800 uppercase tracking-wider">
                        {{ $penjualan->metode_pembayaran ?? 'CASH' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Table Details -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        <th class="py-4 px-6 w-16 text-center">#</th>
                        <th class="py-4 px-6">Deskripsi Produk</th>
                        <th class="py-4 px-6 text-right">Harga Satuan</th>
                        <th class="py-4 px-6 text-center w-24">QTY</th>
                        <th class="py-4 px-6 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($penjualan->itemPenjualan ?? $penjualan->details ?? [] as $index => $item)
                        <tr class="hover:bg-amber-50/20 transition">
                            <td class="py-4 px-6 text-center text-gray-400 font-mono text-xs">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-gray-900 block">
                                    {{ $item->produk->nama ?? $item->produk->nama_produk ?? $item->produk->nama_barang ?? $item->nama_produk ?? 'Produk Dihapus' }}
                                </span>
                                @if(isset($item->produk->kode_produk) || isset($item->kode_produk))
                                    <span class="text-xs text-gray-400 font-mono">
                                        SKU: {{ $item->produk->kode_produk ?? $item->kode_produk }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right font-mono text-gray-600">
                                Rp {{ number_format($item->harga_satuan ?? $item->harga ?? $item->harga_jual ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-block px-2.5 py-1 bg-amber-50 rounded-md font-semibold text-xs text-[#B47454] font-mono border border-[#B47454]/20">
                                    {{ $item->kuantitas ?? $item->jumlah ?? $item->qty ?? 0 }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right font-semibold text-gray-900 font-mono">
                                Rp {{ number_format($item->subtotal ?? (($item->kuantitas ?? $item->jumlah ?? $item->qty ?? 0) * ($item->harga_satuan ?? $item->harga ?? 0)), 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-400">
                                Tidak ada detail item transaksi ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Summary / Footer Breakdown -->
        <div class="p-6 md:p-8 bg-gray-50/50 border-t border-gray-100 flex flex-col md:flex-row justify-between items-start gap-6">
            <div class="text-xs text-gray-400 max-w-xs space-y-1">
                <p class="font-semibold text-gray-600">Catatan:</p>
                <p>Terima kasih telah berbelanja. Faktur ini sah dan diproses secara komputerisasi oleh sistem.</p>
            </div>

            <div class="w-full md:w-80 space-y-3 bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Subtotal Produk</span>
                    <span class="font-mono font-medium text-gray-800">
                        Rp {{ number_format($penjualan->total_pembayaran ?? $penjualan->total_harga ?? 0, 0, ',', '.') }}
                    </span>
                </div>

                @if(isset($penjualan->bayar))
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Tunai / Bayar</span>
                    <span class="font-mono font-medium text-gray-800">
                        Rp {{ number_format($penjualan->bayar, 0, ',', '.') }}
                    </span>
                </div>
                @endif

                @if(isset($penjualan->kembali))
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Kembalian</span>
                    <span class="font-mono font-medium text-gray-800">
                        Rp {{ number_format($penjualan->kembali, 0, ',', '.') }}
                    </span>
                </div>
                @endif

                <div class="pt-3 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-base font-bold text-gray-900">Total Akhir</span>
                    <span class="text-xl font-extrabold text-[#B47454] font-mono">
                        Rp {{ number_format($penjualan->total_pembayaran ?? $penjualan->total_harga ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection