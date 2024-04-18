<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <form action="/kategori" method="post">
        @csrf
        <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center pb-10">
            <div
                class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
                <div class="flex items-center justify-between">
                    <a href="/kategori">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <button type="submit"
                        class="flex w-min items-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-10 py-3 text-sm font-semibold text-white active:scale-95">
                        <h1>Simpan</h1>
                    </button>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="kategori">Nama Kategori</label>
                    <input type="text" id="kategori" name="kategori" autofocus required
                        class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring focus:ring-blue-500"
                        placeholder="Masukkan nama kategori">
                </div>
            </div>
        </div>
    </form>
</x-app-layout>