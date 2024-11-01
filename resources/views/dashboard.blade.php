<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                TimeStamp
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jenis Presensi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Gambar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $presensi = \App\Models\Presensi::all();
                        @endphp
                        @foreach ($presensi as $p)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $p->nama }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $p->nim }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $p->timestamp }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $p->jenis }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $p->kamera }}
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
