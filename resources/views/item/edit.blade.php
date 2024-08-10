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
                    <a href="/{{$code}}/dashboards/item" class="text-slate-400"><< Back</a>
                    <h1 class="font-semibold text-xl mb-5">Create new Item</h1>
                </div>
                <form action="" enctype="multipart/form-data" class="w-full space-y-3" method="POST">
                    @csrf
                    <div class="form-control w-full grid grid-cols-4">
                        <label class="" for="">Part no</label>
                        <input value="{{$item->part_id}}" type="text" class="border-2 col-span-3 rounded border-slate-300 p-1" name="part_id">
                    </div>
                    <div class="form-control w-full grid grid-cols-4">
                        <label class="" for="">Part name</label>
                        <input value="{{$item->part_name}}" type="text" class="border-2 col-span-3 rounded border-slate-300 p-1" name="part_name">
                    </div>
                    @if($customer->id==1)
                    <div class="form-control w-full grid grid-cols-4">
                        <label class="" for="">Job No</label>
                        <input value="{{$item->job_no}}" type="text" class="border-2 col-span-3 rounded border-slate-300 p-1" name="job_no">
                    </div>
                    @endif
                    <div class="form-control w-full grid grid-cols-4">
                        <label class="" for="">QTY</label>
                        <input value="{{$item->qty}}" type="text" class="border-2 col-span-3 rounded border-slate-300 p-1" name="part_qty">
                    </div>
                    <div class="form-control w-full grid grid-cols-4">
                        <label class="" for="" class="">Pilih Gambar</label>
                        <input type="file" class="border-2 col-span-3 rounded border-slate-300 p-1" name="file_name">
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