@extends('app.layout')
@section('content')
@php 
        $code = explode("/",Request::path())[0]
    @endphp
    <div class="p-4">
        <div class="item">
            <div class="container mx-auto bg-background rounded-md shadow-md p-8">
                <div class="relative w-full overflow-auto">
                    <div class="flex justify-between items-center">
                        <h1 class="font-semibold text-xl mb-5">Data User</h1>
                        <a href="/{{$code}}/dashboards/users/new">
                            <button class="bg-slate-400 rounded-lg text-white px-4 py-2 hover:bg-red-500">+ Tambah User</button>
                        </a>
                    </div>
                  <table class="w-full caption-bottom text-sm">
                    <thead class="[&amp;_tr]:border-b">
                      <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                          Username
                        </th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                          Jabatan
                        </th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody class="[&amp;_tr:last-child]:border-0">
                      @foreach($users as $user)
                      <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$user->username}}</td>
                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$user->jabatan}}</td>
                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                          <div class="flex flex-col gap-3">
                            <a href="/{{$code}}/dashboards/users/{{$user->id}}" class="w-full">
                              <button class="px-6 py-1 rounded bg-zinc-400 text-white"> edit</button>
                            </a>
                            <form action="/{{$code}}/dashboards/users/{{$user->id}}/delete" method="post">
                              @csrf
                              <button class="px-4 py-1 rounded bg-zinc-800 text-white"> delete</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>                
        </div>
    </div>
@endsection