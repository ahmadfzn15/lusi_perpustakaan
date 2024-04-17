<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <form action="/profile" method="post">
        @method('put')
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="absolute left-0 top-0 mt-28 flex w-full flex-col items-center pb-10">
            <div
                class="w-11/12 space-y-5 overflow-auto rounded-md border border-slate-100 bg-white p-5 shadow-md shadow-slate-300">
                <a href="/">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="grid grid-cols-3 gap-5">
                    <div class="col-span-1 overflow-hidden">
                        <img src="{{ asset('storage/img/' . auth()->user()->foto) }}" alt=""
                            class="h-full w-full">
                    </div>
                    <div class="col-span-2 flex flex-col justify-between">
                        <div class="">
                            <h1 class="text-2xl">{{ auth()->user()->nama }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
