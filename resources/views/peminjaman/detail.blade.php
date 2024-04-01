<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center">
        <div
            class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
            <a href="/peminjaman">
                Kembali
            </a>
            <div class="h-[200px] w-full overflow-hidden">
                <img src="{{ asset('storage/img/' . $data->cover) }}" alt="" class="h-[200px]">
            </div>
            <div class="">
                <h1>{{ $data->judul_buku }}</h1>
            </div>
        </div>
    </div>
</x-app-layout>
