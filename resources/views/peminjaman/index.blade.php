<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    @can('admin', 'petugas')
    <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center">
        <div
            class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
            <table class="w-full overflow-hidden rounded-md ring-1 ring-slate-300">
                <thead>
                    <tr class="text-slate-600">
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">No</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Nama Peminjam</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Judul Buku</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Jumlah Buku</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Tanggal Peminjaman</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Tanggal Pengembalian</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Durasi Peminjaman</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Batas Peminjaman</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Jatuh Tempo</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Status</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data_admin->count())
                    @foreach ($data_admin as $item)
                    <tr class="text-slate-600">
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->peminjaman->user->nama }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            <a href="/buku/{{ base64_encode($item->buku->id) }}" class="hover:underline">{{
                                $item->buku->judul_buku }}</a>
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->peminjaman->jumlah_buku }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->peminjaman->tanggal_peminjaman }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->peminjaman->tanggal_pengembalian ?? '-' }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->peminjaman->durasi_peminjaman ? $item->peminjaman->durasi_peminjaman . " Hari" :
                            "-" }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->peminjaman->batas_peminjaman ?? "-" }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->peminjaman->jatuh_tempo ? "Ya" : "Tidak"}}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            @if ($item->peminjaman->status_peminjaman && $item->peminjaman->status == 'Dipinjam')
                            <button
                                class="flex w-min cursor-default items-center justify-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-3 py-3 text-xs font-semibold text-white">
                                <h1>Peminjaman Dikonfirmasi</h1>
                            </button>
                            @elseif ($item->peminjaman->status_pengembalian && $item->peminjaman->status ==
                            'Dikembalikan')
                            <button
                                class="flex w-min cursor-default items-center justify-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-3 py-3 text-xs font-semibold text-white">
                                <h1>Pengembalian Dikonfirmasi</h1>
                            </button>
                            @elseif (!$item->peminjaman->status_peminjaman && !$item->peminjaman->status_pengembalian)
                            <button
                                class="flex w-min cursor-default items-center justify-center gap-1 whitespace-nowrap rounded-md bg-red-500 px-3 py-3 text-xs font-semibold text-white">
                                <h1>Peminjaman Belum Dikonfirmasi</h1>
                            </button>
                            @elseif ($item->peminjaman->status_peminjaman && !$item->peminjaman->status_pengembalian)
                            <button
                                class="flex w-min cursor-default items-center justify-center gap-1 whitespace-nowrap rounded-md bg-red-500 px-3 py-3 text-xs font-semibold text-white">
                                <h1>Pengembalian Belum Dikonfirmasi</h1>
                            </button>
                            @endif
                        </td>
                        <td class="flex justify-center gap-2 whitespace-nowrap border border-slate-300 p-2 text-center">
                            @if (
                            ($item->peminjaman->status_peminjaman && $item->peminjaman->status == 'Dipinjam') ||
                            ($item->peminjaman->status_pengembalian && $item->peminjaman->status == 'Dikembalikan'))
                            <form action="/peminjaman/{{ base64_encode($item->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button
                                    onclick="return confirm('Apakah yakin anda ingin menghapus data peminjaman ini?');"
                                    type="submit" class="rounded-md bg-red-600 px-3 py-2 text-white">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @elseif (!$item->peminjaman->status_peminjaman && $item->peminjaman->status == 'Dipinjam')
                            <form action="/pinjam/{{ base64_encode($item->id) }}/confirm" method="post">
                                @csrf
                                <button type="submit"
                                    class="flex w-min items-center justify-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-3 py-3 text-xs font-semibold text-white">Konfirmasi</button>
                            </form>
                            @elseif ($item->peminjaman->status_peminjaman && $item->peminjaman->status ==
                            'Dikembalikan')
                            <form action="/pinjam/{{ base64_encode($item->id) }}/return-confirm" method="post">
                                @csrf
                                <button type="submit"
                                    class="flex w-min items-center justify-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-3 py-3 text-xs font-semibold text-white">Konfirmasi</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-slate-600">
                        <td colspan="11" class="whitespace-nowrap border border-slate-300 p-2 text-center">Data
                            kosong
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @endcan
    @can('peminjam')
    <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center pb-10">
        <div class="grid w-11/12 grid-cols-4 gap-5">
            @foreach ($data_user as $item)
            <div
                class="flex flex-col justify-between overflow-hidden rounded-md border border-slate-100 bg-white shadow-md shadow-slate-300 transition-all hover:scale-95">
                <a href="/pinjam/{{ base64_encode($item->buku->id) }}"
                    class="flex h-[250px] w-full items-center justify-center">
                    <img src="{{ asset('storage/img/' . $item->buku->cover) }}" class="h-full w-full object-cover"
                        alt="">
                </a>
                <div class="flex flex-col gap-3 p-4">
                    <div class="flex justify-between">
                        <div class="flex flex-col justify-between">
                            <h1>{{ $item->buku->judul_buku }}</h1>
                            <p class="text-xs">{{ $item->buku->penulis }}</p>
                        </div>
                        <h1 class="text-xl">{{ $item->peminjaman->jumlah_buku }}</h1>
                    </div>
                    @if ($item->peminjaman->status_peminjaman && $item->peminjaman->status == 'Dipinjam')
                    <form action="/pinjam/{{ base64_encode($item->id) }}/return" method="post">
                        @csrf
                        <button type="submit"
                            onclick="return confirm('Apakah yakin anda ingin mengembalikan buku ini?');"
                            class="flex w-full items-center justify-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-3 py-3 text-xs font-semibold text-white">Kembalikan
                            buku</button>
                    </form>
                    @elseif ($item->peminjaman->status == 'Dikembalikan' && !$item->peminjaman->status_pengembalian)
                    <button
                        class="flex w-full cursor-default items-center justify-center gap-1 whitespace-nowrap rounded-md bg-red-500 py-3 text-xs font-semibold text-white">
                        <h1>Pengembalian Belum dikonfirmasi</h1>
                    </button>
                    @elseif (!$item->peminjaman->status_peminjaman && !$item->peminjaman->status_pengembalian)
                    <button
                        class="flex w-full cursor-default items-center justify-center gap-1 whitespace-nowrap rounded-md bg-red-500 py-3 text-xs font-semibold text-white">
                        <h1>Peminjaman Belum dikonfirmasi</h1>
                    </button>
                    @elseif ($item->peminjaman->status_pengembalian && $item->peminjaman->status == 'Dikembalikan')
                    <a href="/ulasan/{{ base64_encode($item->id) }}"
                        class="flex w-full items-center justify-center gap-1 whitespace-nowrap rounded-md bg-green-500 py-3 text-xs font-semibold text-white">
                        <h1>Berikan Ulasan</h1>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endcan
</x-app-layout>
