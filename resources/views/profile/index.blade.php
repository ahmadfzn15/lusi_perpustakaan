<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <form action="/profil" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center pb-10">
            <div
                class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
                <div class="flex items-center justify-between">
                    <a href="/">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <button type="submit"
                        class="flex w-min items-center gap-1 whitespace-nowrap rounded-md bg-green-500 px-10 py-3 text-sm font-semibold text-white active:scale-95">
                        <h1>Ubah</h1>
                    </button>
                </div>
                <div class="grid grid-cols-3 gap-5">
                    <div class="col-span-1 flex flex-col gap-4">
                        <div
                            class="min-h-[300px] flex w-[300px] items-center justify-center overflow-hidden rounded-md ring ring-slate-300">
                            <img src="{{ asset('storage/img/' . auth()->user()->foto) }}" alt="" class="h-full w-full"
                                id="previewImage">
                        </div>
                        <input type="file" name="foto" id="foto" onchange="previewImages()">
                    </div>
                    <div class="col-span-1 flex flex-col gap-2">
                        <div class="flex flex-col">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="{{ auth()->user()->nama }}" class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring
                            focus:ring-blue-500">
                        </div>
                        <div class="flex flex-col">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ auth()->user()->email }}" class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring
                            focus:ring-blue-500">
                        </div>
                        <div class="flex flex-col">
                            <label for="no_tlp">Nomor Telepon</label>
                            <input type="text" name="no_tlp" value="{{ auth()->user()->no_tlp }}" class="h-min rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:ring
                            focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const previewImages = (e) => {
                const input = document.getElementById('foto');
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