<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <form action="/ulasan" method="post">
        @csrf
        <input type="hidden" name="id_buku" value="{{ $id_buku }}">
        <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center pb-10">
            <div
                class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
                <div class="flex items-center justify-between">
                    <a href="/peminjaman">
                        Kembali
                    </a>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="ulasan">Ulasan</label>
                    <textarea name="ulasan" id="ulasan" cols="30" rows="5"
                        class="rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring focus:ring-blue-500">
                </textarea>
                </div>
                <button type="submit"
                    class="flex w-min items-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-10 py-3 text-sm font-semibold text-white active:scale-95">
                    <h1>Kirim Ulasan</h1>
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
