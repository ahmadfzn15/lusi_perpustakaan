<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    @can('peminjam')
        <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center pb-10">
            <div class="grid w-11/12 grid-cols-4 gap-5">
                @foreach ($data as $item)
                    <div
                        class="flex flex-col justify-between overflow-hidden rounded-md border border-slate-100 bg-white shadow-md shadow-slate-300 transition-all">
                        <a href="/buku/{{ base64_encode($item->buku->id) }}"
                            class="flex h-[250px] w-full items-center justify-center">
                            <img src="{{ asset('storage/img/' . $item->buku->cover) }}" class="h-full w-full object-cover"
                                alt="">
                        </a>
                        <div class="flex flex-col justify-between p-4">
                            <h1>{{ $item->buku->judul_buku }}</h1>
                            <p class="text-xs">{{ $item->buku->penulis }}</p>
                            <div class="mt-2 flex items-center justify-between gap-2">
                                <a href="/pinjam/{{ base64_encode($item->buku->id) }}"
                                    class="w-full items-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-3 py-2 text-sm text-white hover:scale-95">
                                    Pinjam Buku</a>
                                <form action="/koleksi/{{ base64_encode($item->id) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"
                                        onclick="return confirm('Apakah yakin anda ingin menghapus buku ini dari koleksi anda?');"
                                        class="flex w-min items-center justify-center gap-1 whitespace-nowrap rounded-md bg-red-500 px-3 py-3 text-xs font-semibold text-white hover:scale-95"><i
                                            class="fas fa-x"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endcan
</x-app-layout>
