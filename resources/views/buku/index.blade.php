<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="search">
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-4 text-slate-600"></i>
            <form action="/buku" method="get" id="searchForm">
                <input type="search" id="searchBook" value="{{ old('search') }}"
                    class="h-min rounded-md border border-slate-300 bg-white py-3 pl-10 text-sm text-slate-700 outline-none"
                    name="search" placeholder="Search here...">
            </form>
        </div>
    </x-slot>
    @can('admin', 'petugas')
        <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center">
            <div
                class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
                <a href="/buku/create"
                    class="flex w-min items-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-3 py-2 text-sm text-white active:scale-95"><i
                        class="fas fa-add"></i>
                    <h1>Tambah Buku</h1>
                </a>
                <table class="w-full overflow-hidden rounded-md ring-1 ring-slate-300">
                    <thead>
                        <tr class="text-slate-600">
                            <th class="whitespace-nowrap border border-slate-300 p-2 text-center">No</th>
                            <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Foto</th>
                            <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Judul Buku</th>
                            <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Pengarang</th>
                            <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Penerbit</th>
                            <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Jumlah Halaman</th>
                            <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Stok</th>
                            <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count())
                            @foreach ($data as $item)
                                <tr class="text-slate-600">
                                    <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                                        {{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                                        <div class="mx-auto flex w-12 items-center justify-center overflow-hidden">
                                            <img src="{{ asset('storage/img/' . $item->cover) }}" alt="">
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                                        {{ $item->judul_buku }}</td>
                                    <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                                        {{ $item->penulis }}
                                    </td>
                                    <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                                        {{ $item->penerbit }}
                                    </td>
                                    <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                                        {{ $item->jumlah_halaman }}</td>
                                    <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                                        {{ $item->stok }}</td>
                                    <td
                                        class="flex items-center justify-center gap-2 whitespace-nowrap border border-slate-300 p-2 text-center">
                                        <a href="/buku/{{ base64_encode($item->id) }}/edit"
                                            class="whitespace-nowrap rounded-md bg-green-600 px-3 py-2 text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="/buku/{{ base64_encode($item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('Apakah yakin anda ingin menghapus buku ini?');"
                                                type="submit" class="rounded-md bg-red-600 px-3 py-2 text-white">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-slate-600">
                                <td colspan="5" class="whitespace-nowrap border border-slate-300 p-2 text-center">
                                    Data
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
                @foreach ($data as $item)
                    <div
                        class="flex flex-col justify-between overflow-hidden rounded-md border border-slate-100 bg-white shadow-md shadow-slate-300 transition-all">
                        <a href="/buku/{{ base64_encode($item->id) }}"
                            class="flex h-[250px] w-full items-center justify-center">
                            <img src="{{ asset('storage/img/' . $item->cover) }}" class="h-full w-full object-cover"
                                alt="">
                        </a>
                        <div class="flex flex-col justify-between p-4">
                            <h1>{{ $item->judul_buku }}</h1>
                            <div class="flex w-full justify-between">
                                <p class="text-xs">{{ $item->penulis }}</p>
                                <p class="text-xs">Stok: {{ $item->stok }}</p>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-2">
                                <a href="/pinjam/{{ base64_encode($item->id) }}"
                                    class="w-full items-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-3 py-2 text-sm text-white hover:scale-95">
                                    Pinjam Buku</a>
                                <form action="/koleksi" method="post">
                                    @csrf
                                    <input type="hidden" name="id_buku" value="{{ $item->id }}">
                                    <button type="submit"
                                        class="flex w-min items-center justify-center gap-1 whitespace-nowrap rounded-md bg-red-500 px-3 py-3 text-xs font-semibold text-white hover:scale-95"><i
                                            class="fas fa-heart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endcan

    <script>
        document.getElementById('searchBook').addEventListener('keypress', function(e) {
            if (e.key == "Enter" && this.value != "") {
                e.preventDefault()
                document.getElementById('searchForm').submit()
            }
        })
    </script>
</x-app-layout>
