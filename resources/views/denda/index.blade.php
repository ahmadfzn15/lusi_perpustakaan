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
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Telat</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Total Denda</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Status</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Tanggal Bayar</th>
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
                            {{ $item->user->nama }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->buku->judul_buku }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->telat . " Hari" }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ "Rp." . $item->total_denda }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->status ? "Lunas" : "Belum Lunas" }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->tanggal_bayar ?? "-" }}</td>
                        <td
                            class="flex items-center justify-center gap-2 whitespace-nowrap border border-slate-300 p-2 text-center">
                            @if ($item->status)
                            <form action="/denda/{{ base64_encode($item->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button onclick="return confirm('Apakah yakin anda ingin menghapus denda ini?');"
                                    type="submit" class="rounded-md bg-red-600 px-3 py-2 text-white">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-slate-600">
                        <td colspan="8" class="whitespace-nowrap border border-slate-300 p-2 text-center">Data
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
    <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center">
        <div
            class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
            <table class="w-full overflow-hidden rounded-md ring-1 ring-slate-300">
                <thead>
                    <tr class="text-slate-600">
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">No</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Judul Buku</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Telat</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Total Denda</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Status</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Tanggal Bayar</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data_peminjam->count())
                    @foreach ($data_peminjam as $item)
                    <tr class="text-slate-600">
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->buku->judul_buku }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->telat . " Hari" }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ "Rp." . $item->total_denda }}
                        </td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->status ? "Lunas" : "Belum Lunas" }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item->tanggal_bayar }}</td>
                        <td
                            class="flex items-center justify-center gap-2 whitespace-nowrap border border-slate-300 p-2 text-center">
                            <form action="/denda/{{ base64_encode($item->id) }}/bayar" method="post">
                                @csrf
                                <button onclick="return confirm('Apakah yakin anda ingin membayar denda ini?');"
                                    type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-white">
                                    <h1>Bayar</h1>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-slate-600">
                        <td colspan="6" class="whitespace-nowrap border border-slate-300 p-2 text-center">Data
                            kosong
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @endcan
</x-app-layout>