@extends('app.layout')
@section('content')
@php 
        $code = explode("/",Request::path())[0]
    @endphp
<div class="p-4">
    <div class="item">
        <div class="container mx-auto bg-background rounded-md shadow-md p-8">
            <div class="relative w-full overflow-auto">
                <div class="flex flex-col">
                    <a href="/{{$code}}/dashboards/users" class="text-slate-400"><< Back</a>
                    <h1 class="font-semibold text-xl mb-5">Create new User</h1>
                </div>
                <form action="/{{$code}}/dashboards/users/{{$user->id}}" class="w-full space-y-3" method="POST">
                    @csrf
                    <div class="form-control w-full grid grid-cols-4">
                        <label class="" for="">Username</label>
                        <input value="{{$user->username}}" type="text" class="border-2 col-span-3 rounded border-slate-300 p-1" name="username">
                    </div>
                    <div class="form-control w-full grid grid-cols-4">
                        <label class="" for="">Password</label>
                        <input placeholder="Isi ketika Ingin Merubah Password" type="password" class="border-2 col-span-3 rounded border-slate-300 p-1" name="password">
                    </div>
                    <div class="form-control w-full grid grid-cols-4">
                        <label class="" for="">Jabatan</label>
                        <select name="jabatan" id="" class="border-2 col-span-3 rounded border-slate-300 p-1">
                            <option @if($user->jabatan=="admin") selected @endif value="admin">admin</option>
                            <option @if($user->jabatan=="manager") selected @endif value="manager">manager</option>
                            <option @if($user->jabatan=="staff") selected @endif value="staff">staff</option>
                            <option @if($user->jabatan=="operator") selected @endif value="operator">operator</option>
                        </select>
                    </div>
                    <div class="flex w-full justify-end">
                        <button class="bg-purple-600 text-white rounded px-6 py-3">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
          </div>                
    </div>
</div>
@endsection