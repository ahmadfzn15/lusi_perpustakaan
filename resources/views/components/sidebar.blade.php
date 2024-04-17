<div class="fixed left-0 top-0 z-50 flex h-screen w-56 flex-col items-center bg-white px-5 py-7">
    <div class="w-full border-b border-slate-300 pb-5">
        <h1 class="text-center text-lg font-semibold text-slate-700">Lusi Gramedia</h1>
    </div>
    <div class="flex w-full flex-col items-start gap-1 py-5">
        @cannot('peminjam')
            <a href="/"
                class="{{ Request::is('/') ? 'bg-slate-200' : '' }} flex w-full items-center gap-2 rounded-md p-3 hover:bg-slate-200">
                <i class="fa-solid fa-house-user text-slate-700"></i>
                <h1>Beranda</h1>
            </a>
        @endcannot
        <a href="/buku"
            class="{{ Request::is('buku*') ? 'bg-slate-200' : '' }} flex w-full items-center gap-2 rounded-md p-3 hover:bg-slate-200">
            <i class="fa-solid fa-book"></i>
            <h1>Buku</h1>
        </a>
        @can('peminjam')
            <a href="/koleksi"
                class="{{ Request::is('koleksi*') ? 'bg-slate-200' : '' }} flex w-full items-center gap-2 rounded-md p-3 hover:bg-slate-200">
                <i class="fa-solid fa-heart"></i>
                <h1>Koleksi</h1>
            </a>
        @endcan
        @can('admin')
            <a href="/petugas"
                class="{{ Request::is('petugas*') ? 'bg-slate-200' : '' }} flex w-full items-center gap-2 rounded-md p-3 hover:bg-slate-200">
                <i class="fas fa-user"></i>
                <h1>Petugas</h1>
            </a>
            <a href="/ulasan"
                class="{{ Request::is('ulasan*') ? 'bg-slate-200' : '' }} flex w-full items-center gap-2 rounded-md p-3 hover:bg-slate-200">
                <i class="fas fa-user"></i>
                <h1>Ulasan</h1>
            </a>
        @endcan
        <a href="/peminjaman"
            class="{{ Request::is('peminjaman*') ? 'bg-slate-200' : '' }} flex w-full items-center gap-2 rounded-md p-3 hover:bg-slate-200">
            <i class="fas fa-book-open-reader"></i>
            <h1>Peminjaman</h1>
        </a>
        <a href="/denda"
            class="{{ Request::is('denda*') ? 'bg-slate-200' : '' }} flex w-full items-center gap-2 rounded-md p-3 hover:bg-slate-200">
            <i class="fas fa-dollar"></i>
            <h1>Denda</h1>
        </a>
        <form action="/logout" method="post" class="w-full">
            @csrf
            <button onclick="return confirm('Apakah yakin anda ingin logout?');" type="submit"
                class="flex w-full items-center gap-2 rounded-md p-3 hover:bg-slate-200">
                <i class="fa-solid fa-right-from-bracket"></i>
                <h1>Keluar</h1>
            </button>
        </form>
    </div>
</div>
