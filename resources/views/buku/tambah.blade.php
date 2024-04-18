<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <form action="/buku" method="post" enctype="multipart/form-data">
        @csrf
        <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center pb-10">
            <div
                class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
                <div class="flex items-center justify-between">
                    <a href="/buku">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <button type="submit"
                        class="flex w-min items-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-10 py-3 text-sm font-semibold text-white active:scale-95">
                        <h1>Simpan</h1>
                    </button>
                </div>
                <div class="flex flex-col gap-4">
                    <label for="judul_buku">Foto Sampul</label>
                    <div class="min-h-60 flex w-60 items-center justify-center overflow-hidden rounded-md ring ring-slate-300"
                        id="imgCover">
                        <img id="previewImage" src="" alt="">
                    </div>
                    <input id="cover" type="file" name="cover" class="" onchange="previewImages()">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="judul_buku">Judul Buku</label>
                    <input type="text" id="judul_buku" value="{{ old('judul_buku') }}" name="judul_buku" autofocus
                        required
                        class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring focus:ring-blue-500"
                        placeholder="Masukkan judul buku">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="penulis">Penulis</label>
                    <input type="text" id="penulis" value="{{ old('penulis') }}" name="penulis" required
                        class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring focus:ring-blue-500"
                        placeholder="Masukkan penulis buku">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" id="penerbit" value="{{ old('penerbit') }}" name="penerbit" required
                        class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring focus:ring-blue-500"
                        placeholder="Masukkan penerbit buku">
                </div>
                <div class="flex gap-4">
                    <div class="flex w-full flex-col gap-1">
                        <label for="jumlah_halaman">Jumlah halaman</label>
                        <input type="number" id="jumlah_halaman" value="{{ old('jumlah_halaman') }}"
                            name="jumlah_halaman"
                            class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring focus:ring-blue-500"
                            placeholder="Masukkan jumlah halaman buku">
                    </div>
                    <div class="flex w-full flex-col gap-1">
                        <label for="stok">Stok</label>
                        <input type="number" id="stok" value="{{ old('stok') }}" name="stok"
                            class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring focus:ring-blue-500"
                            placeholder="Masukkan stok buku">
                    </div>
                    <div class="flex w-full flex-col gap-1">
                        <label for="kategori">Kategori Buku</label>
                        <select name="id_kategori" id="kategori"
                            class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring focus:ring-blue-500">
                            @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->kategori_buku }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const previewImages = (e) => {
            const input = document.getElementById('cover');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('previewImage');
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>