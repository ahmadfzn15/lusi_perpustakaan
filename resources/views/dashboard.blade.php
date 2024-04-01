<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <div class="relative -top-48 grid grid-cols-4 gap-10 px-10">
        <div class="flex justify-between rounded-md bg-white p-5 shadow-lg shadow-slate-400">
            <div class="flex flex-col gap-2">
                <h1 class="text-sm font-bold text-slate-500">
                    Jumlah Buku
                </h1>
                <h1 class="font-bold">{{ $buku->count() }}</h1>
            </div>
            <div class="flex items-center justify-center rounded-full bg-red-600 p-5">
                <i class="fas fa-book text-white"></i>
            </div>
        </div>
        <div class="flex justify-between rounded-md bg-white p-5 shadow-lg shadow-slate-400">
            <div class="flex flex-col gap-2">
                <h1 class="text-sm font-bold text-slate-500">
                    Jumlah Peminjam
                </h1>
                <h1 class="font-bold"></h1>
            </div>
            <div class="flex items-center justify-center rounded-full bg-red-600 p-5">
                <i class="fas fa-book text-white"></i>
            </div>
        </div>
        <div class="flex justify-between rounded-md bg-white p-5 shadow-lg shadow-slate-400">
            <div class="flex flex-col gap-2">
                <h1 class="text-sm font-bold text-slate-500">
                    Jumlah Pengguna
                </h1>
                <h1 class="font-bold">{{ $user->count() }}</h1>
            </div>
            <div class="flex items-center justify-center rounded-full bg-red-600 p-5">
                <i class="fas fa-book text-white"></i>
            </div>
        </div>
        <div class="flex justify-between rounded-md bg-white p-5 shadow-lg shadow-slate-400">
            <div class="flex flex-col gap-2">
                <h1 class="text-sm font-bold text-slate-500">
                    Jumlah Buku
                </h1>
                <h1 class="font-bold"></h1>
            </div>
            <div class="flex items-center justify-center rounded-full bg-red-600 p-5">
                <i class="fas fa-book text-white"></i>
            </div>
        </div>
    </div>
</x-app-layout>