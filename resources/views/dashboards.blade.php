@extends('app.layout')
@section('content')
    @php
        $cust = Request::segment(1);
    @endphp

    <div class="p-6 bg-gray-100 min-h-screen">

        <form action="/{{ $cust }}/dashboards/upload-file" method="POST" enctype="multipart/form-data"
            class="pb-8 flex flex-col gap-1">
            @csrf
            <h3 class="text-2xl font-bold text-gray-800">Upload file</h3>
            <input name="file" type="file">
            <div class="mt-2">
                <button class="bg-blue-700 text-sm text-white px-4 py-1 rounded" type="submit">Upload</button>
            </div>
        </form>


        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white shadow rounded-xl p-4">
                <p class="text-sm text-gray-500">Total Items</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalItem ?? 0 }}</h3>
            </div>
            <div class="bg-white shadow rounded-xl p-4">
                <p class="text-sm text-gray-500">Total PO</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalDN ?? 0 }}</h3>
            </div>
            <div class="bg-white shadow rounded-xl p-4">
                <p class="text-sm text-gray-500">Scan PO Close</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $scanPoClose ?? 0 }}</h3>
            </div>
            <div class="bg-white shadow rounded-xl p-4">
                <p class="text-sm text-gray-500">Scan PO Open</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $scanPoOpen ?? 0 }}</h3>
            </div>
        </div>
        <div class="bg-white shadow rounded-xl p-4">
            <h5 class="text-lg font-semibold mb-4 text-gray-700">Log PO Open</h5>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">No PO</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2 text-center">Total Item</th>
                            <th class="px-4 py-2 text-center">Total Item Belum Discan</th>
                            <th class="px-4 py-2 text-center">Cycle</th>
                            <th class="px-4 py-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logPoOpen as $index => $log)
                            <tr class="border-b">
                                <td class="px-4 py-2 cursor-pointer text-blue-600 hover:underline toggle-row"
                                    data-target="detail-{{ $index }}">
                                    {{ $log['dn'] }}
                                </td>
                                <td class="px-4 py-2">{{ $log['tanggal'] }}</td>
                                <td class="px-4 py-2 text-center">{{ $log['total_item'] }}</td>
                                <td class="px-4 py-2 text-center">{{ $log['item_belum_scan'] }}</td>
                                <td class="px-4 py-2 text-center">{{ $log['cycle'] }}</td>
                                <td class="px-4 py-2 text-center">{{ $log['status'] }}</td>
                            </tr>
                            <tr id="detail-{{ $index }}" class="hidden bg-gray-50 border-b text-sm text-gray-500">
                                <td colspan="5" class="px-6 py-4">
                                    <div class="mb-2 font-semibold text-gray-700">Detail PO: {{ $log['dn'] }}</div>
                                    <table class="w-full text-sm text-left border border-gray-300">
                                        <thead class="bg-gray-200 text-gray-800">
                                            <tr>
                                                <th class="px-3 py-1 border">Order No.</th>
                                                <th class="px-3 py-1 border">Quantity Kanban</th>
                                                <th class="px-3 py-1 border">Kanban Belum Discan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($log['details'] ?? [] as $detail)
                                                <tr>
                                                    <td class="px-3 py-1 border">{{ $detail['order_no'] }}</td>
                                                    <td class="px-3 py-1 border">{{ $detail['qty_kbn'] }}</td>
                                                    <td class="px-3 py-1 border">{{ $detail['qty_kbn'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-2">Semua PO sudah discan hari ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggles = document.querySelectorAll('.toggle-row');
                let openRow = null;

                toggles.forEach(toggle => {
                    toggle.addEventListener('click', function() {
                        const targetId = this.getAttribute('data-target');
                        const targetRow = document.getElementById(targetId);

                        // Close previously opened row
                        if (openRow && openRow !== targetRow) {
                            openRow.classList.add('hidden');
                        }

                        // Toggle current
                        const isHidden = targetRow.classList.contains('hidden');
                        targetRow.classList.toggle('hidden', !isHidden);

                        // Update openRow reference
                        openRow = isHidden ? targetRow : null;
                    });
                });
            });
        </script>
    @endpush

@endsection
