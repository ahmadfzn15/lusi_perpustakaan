<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <div class="absolute left-0 top-0 flex w-full flex-col items-center pt-40">
        <div
            class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
            <a href="/kategori/create"
                class="flex w-min whitespace-nowrap items-center gap-1 rounded-md bg-green-500 px-3 py-2 text-sm text-white active:scale-95"><i
                    class="fas fa-add"></i>
                <h1>Tambah Kategori</h1>
            </a>
            <table class="w-full overflow-hidden rounded-md ring-1 ring-slate-300">
                <thead>
                    <tr class="text-slate-600">
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">No</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Nama Kategori</th>
                        <th class="whitespace-nowrap border border-slate-300 p-2 text-center">Jumlah Buku</th>
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
                            {{ $item['kategori_buku'] }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center">
                            {{ $item['total'] }}</td>
                        <td class="whitespace-nowrap border border-slate-300 p-2 text-center flex gap-2 justify-center">
                            <a href="/kategori/{{ base64_encode($item['id']) }}/edit"
                                class="whitespace-nowrap px-3 py-2 rounded-md bg-green-600 text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/kategori/{{ base64_encode($item['id']) }}" method="post">
                                @method('delete')
                                @csrf
                                <button onclick="return confirm('Apakah yakin anda ingin menghapus kategori ini?');"
                                    type="submit" class="px-3 py-2 rounded-md bg-red-600 text-white">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="text-slate-600">
                        <td colspan="4" class="whitespace-nowrap border border-slate-300 p-2 text-center">Data kosong
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>