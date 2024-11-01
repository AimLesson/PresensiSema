<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Button to open modal -->
            <button onclick="toggleModal()" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Add New Kegiatan
            </button>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Kegiatan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $kegiatan = \App\Models\AttendanceType::all();
                        @endphp
                        @foreach ($kegiatan as $p)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $p->name }}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for creating new Kegiatan -->
    <div id="createModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Create New Kegiatan</h2>
            <form action="{{ route('kegiatan.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300">Nama Kegiatan</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded p-2" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="toggleModal()" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            document.getElementById('createModal').classList.toggle('hidden');
        }
    </script>
</x-app-layout>
