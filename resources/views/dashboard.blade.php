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
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">NIM</th>
                            <th scope="col" class="px-6 py-3">TimeStamp</th>
                            <th scope="col" class="px-6 py-3">Jenis Presensi</th>
                            <th scope="col" class="px-6 py-3">Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $presensi = \App\Models\Presensi::all();
                        @endphp
                        @foreach ($presensi as $p)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $p->name }}
                                </th>
                                <td class="px-6 py-4">{{ $p->nim }}</td>
                                <td class="px-6 py-4">{{ $p->timestamp }}</td>
                                <td class="px-6 py-4">{{ $p->jenis }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage/' . $p->kamera) }}" alt="Image"
                                        class="w-16 h-16 object-cover rounded cursor-pointer" onclick="showModal('{{ asset('storage/' . $p->kamera) }}')">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg">
            <span class="text-gray-600 dark:text-gray-200 cursor-pointer float-right" onclick="closeModal()">✖</span>
            <img id="modalImage" src="" alt="Expanded Image" class="w-full h-auto rounded">
        </div>
    </div>

    <script>
        function showModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('modalImage').src = "";
        }

        $(document).ready(function() {
            $('table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Presensi Data',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
        });
    </script>
</x-app-layout>
