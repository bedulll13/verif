@extends('app.layout')
@section('content')
    @php
        $code = explode('/', Request::path())[0];
    @endphp
    <div class="mt-4">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex-col space-y-1.5 pt-6 flex items-center justify-between">
                <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Data History Verifikasi</h3>
            </div>
            <div class="p-6">
                <div class="relative w-full overflow-auto">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="[&amp;_tr]:border-b">
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                {{-- <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Item No Costumer
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Item No Metindo
                                </th> --}}
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Part No Costumer
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Part No Metindo
                                </th>
                                {{-- <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Order No
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    User
                                </th> --}}
                                <!-- @if ($customer->id == 1)
    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                          Job No Costumer
                        </th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                          Job No Metindo
                        </th>
    @endif -->
                                {{-- <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    QTY Costumer
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    QTY Metindo
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Status Costumer
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Status Metindo
                                </th> --}}
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Date
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Hasil
                                </th>
                            </tr>
                        </thead>
                        <tbody class="[&amp;_tr:last-child]:border-0">
                            @foreach ($logs as $log)
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    {{-- <td>{{ $log->item_metindo }}</td>
                                    <td>{{ $log->item_customer }}</td> --}}
                                    <td>{{ $log->partid_customer }}</td>
                                    <td>{{ $log->partid_metindo }}</td>
                                    {{-- <td>{{ $log->order_no }}</td>
                                    <td>{{ $log->user }}</td>
                                    <td class='text-center'>{{ $log->qty_metindo }}</td>
                                    <td class='text-center'>{{ $log->qty_customer }}</td>
                                    <td>
                                        <div
                                            class="rounded-full p-1 @if ($log->hasil == 'OK') bg-green-500 @else bg-red-500 @endif text-center">
                                            {{ $log->status_metindo }}
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="rounded-full p-1 @if ($log->hasil == 'OK') bg-green-500 @else bg-red-500 @endif text-center">
                                            {{ $log->status_customer }}
                                        </div>
                                    </td> --}}
                                    <td>{{ $log->my_date }}</td>
                                    <td>
                                        <div
                                            class="rounded-full p-1 @if ($log->hasil == 'OK') bg-green-500 @else bg-red-500 @endif text-center">
                                            {{ $log->hasil }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-full flex justify-center items-center p-8">
                        <form method="GET" action="{{ url()->current() }}">
                            <label for="itemsPerPage">Items per page:</label>
                            <select name="itemsPerPage" id="itemsPerPage" onchange="this.form.submit()">
                                <option value="5" {{ request('itemsPerPage') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ request('itemsPerPage') == 15 ? 'selected' : '' }}>15</option>
                                <option value="20" {{ request('itemsPerPage') == 20 ? 'selected' : '' }}>20</option>
                            </select>
                        </form>
                    </div>
                </div>
                {{ $logs->appends(['itemsPerPage' => request('itemsPerPage')])->links() }}
            </div>
        </div>
    </div>
@endsection
