<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <form action="/peminjaman" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center pb-10">
            <div
                class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
                <a href="/buku">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="grid grid-cols-3 gap-5">
                    <div class="col-span-1 overflow-hidden">
                        <img src="{{ asset('storage/img/' . $data->cover) }}" alt="" class="h-full w-full">
                    </div>
                    <div class="col-span-2 flex flex-col justify-between">
                        <div class="">
                            <h1 class="text-2xl">{{ $data->judul_buku }}</h1>
                            <h1 class="text-sm">Karya {{ $data->penulis }}</h1>
                            <h1 class="text-xs">Diterbitkan oleh {{ $data->penerbit }}</h1>
                        </div>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="text-sm">Jumlah Buku</h1>
                                <input type="number" name="jumlah_buku" required autofocus
                                    class="h-min w-full rounded-md border border-slate-300 bg-white py-3 text-sm text-slate-700 outline-none">
                                <h1 class="self-end">Stok {{ $data->stok }}</h1>
                            </div>
                            <button type="submit" class="w-full rounded-md bg-green-600 py-2 text-white">Pinjam
                                Buku</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>