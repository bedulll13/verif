@extends('app.layout')
@section('content')
    @php
        $code = explode('/', Request::path())[0];
    @endphp
    <div class="p-4">
        <div class="item">
            <div class="container mx-auto bg-background rounded-md shadow-md p-8">
                <div class="relative w-full overflow-auto">
                    <div class="flex justify-between items-center">
                        <!-- <h1 class="font-semibold text-xl mb-5">Data Item</h1> -->
                        <a href="/{{ $code }}/dashboards/item/new">
                            <button class="bg-slate-400 rounded-lg text-white px-4 py-2 hover:bg-red-500">+ Tambah
                                Data</button>
                        </a>
                    </div>
                    <table class="w-full caption-bottom text-sm">
                        <thead class="[&amp;_tr]:border-b">
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Gambar
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Part No
                                </th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Part Name
                                </th>
                                @if ($customer->id == 1)
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                        Job No
                                    </th>
                                @endif
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Qty
                                </th>
                                <th
                                    class="h-12 px-4 align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="[&amp;_tr:last-child]:border-0">
                            @foreach ($items as $item)
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">
                                        <img src="{{ asset($item->file_name) }}" class="h-[100px]" alt="">
                                    </td>
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{ $item->part_id }}</td>
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{ $item->part_name }}
                                    </td>
                                    @if ($customer->id == 1)
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{ $item->job_no }}
                                        </td>
                                    @endif
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{ $item->qty }}</td>
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                        <div class="flex flex-col gap-3">
                                            <a href="/{{ $code }}/dashboards/item/{{ $item->part_id }}"
                                                class="w-full">
                                                <button class="px-6 py-1 rounded bg-zinc-400 text-white">edit</button>
                                            </a>
                                            <form action="/{{ $code }}/dashboards/item/{{ $item->part_id }}/delete"
                                                method="post">
                                                @csrf
                                                <button class="px-4 py-1 rounded bg-zinc-800 text-white">delete</button>
                                            </form>
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
                @if ($items->hasPages())
                    <div class="mt-4 flex justify-center">
                        {{ $items->appends(['itemsPerPage' => request('itemsPerPage')])->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
