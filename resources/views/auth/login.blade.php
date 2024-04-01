<x-auth-layout>
    <form action="/login" method="post">
        @csrf
        <div class="flex flex-col items-center gap-5 rounded-md bg-slate-200/40 p-10 backdrop-blur-xl">
            <div class="w-full space-y-1">
                <label for="email" class="text-xs font-bold uppercase text-slate-700">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full rounded-md border-slate-300 bg-white p-3 shadow-sm shadow-slate-400 outline-none focus:ring focus:ring-blue-600 focus:transition-all"
                    placeholder="Masukkan email anda">
            </div>
            <div class="w-full space-y-1">
                <label for="password" class="text-xs font-bold uppercase text-slate-700">Kata Sandi</label>
                <input type="password" id="password" name="password"
                    class="w-full rounded-md border-slate-300 bg-white p-3 shadow-sm shadow-slate-400 outline-none focus:ring focus:ring-blue-600 focus:transition-all"
                    placeholder="Masukkan password anda">
            </div>
            <button type="submit" class="w-full rounded-md bg-black p-4 font-semibold text-white">Masuk</button>
        </div>
    </form>
</x-auth-layout>
