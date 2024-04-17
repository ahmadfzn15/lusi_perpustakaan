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
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <h1>Ulasan Peminjam</h1>
                    @if ($ulasan->count())
                        @foreach ($ulasan as $item)
                            <div class="flex flex-col gap-2 rounded-md border border-slate-200 p-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-between overflow-hidden rounded-full">
                                        <img src="{{ asset('storage/img/' . ($item->user->foto ?? 'user.png')) }}"
                                            alt="">
                                    </div>
                                    <div class="flex flex-col justify-end">
                                        <h1>{{ $item->user->nama }}</h1>
                                        <h1 class="text-xs">{{ $item->created_at->diffForHumans() }}</h1>
                                    </div>
                                </div>
                                <h1>{{ $item->ulasan }}</h1>
                            </div>
                        @endforeach
                    @else
                    @endif
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
