@extends('app.layout')
@section('content')
@php
$code = explode("/",Request::path())[0]
@endphp
<div class="w-full flex flex-row justify-center items-center">
    <div class="w-full grid grid-cols-2 border-2">
        <div class="left-panel grid grid-cols-1 border">
            <div class="head flex flex-col justify-center items-center ">
                <h3 class="text-3xl font-bold text-center py-4">Kanban Customer</h3> {{-- title --}}
                <img id="info_part_img" src="{{ asset('images/image.png') }}" alt=""> {{-- thumbnail --}}
            </div>
            <div class="descriptions p-4 ">
                <form action="" class="flex flex-col mb-2">
                    <label for="">Part ID</latbel>
                        <input id="part_input" class="border-2 border-slate-300 w-full rounded px-4 py-2" name="part_id" type="text"> {{-- part id --}}
                </form>
                <div class=" mt-2">

                    <div class="row grid grid-cols-2 items-center">
                        <p class="font-semibold text-lg text-slate-700">Part Name</p>
                        <p id="info_part_name">(part name)</p>
                    </div>
                    @if($customer->id==1)
                    <div class="row grid grid-cols-2 items-center">
                        <p class="font-semibold text-lg text-slate-700">Job No</p>
                        <p id="info_part_name">(job no)</p>
                    </div>
                    @endif
                    <div class="row grid grid-cols-2 items-center">
                        <p class="font-semibold text-lg text-slate-700">QTY</p>
                        <p id="info_part_qty">(qty)</p>
                    </div>
                    <div class="row grid grid-cols-2 items-center">
                        <p class="font-semibold text-lg text-slate-700">Judgement</p>
                        <p id="info_part_judge">(OK/NG)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-panel grid grid-cols-1 border">
            <div class="head flex flex-col justify-center items-center ">
                <h3 class="text-3xl font-bold text-center py-4">Product Packaging</h3> {{-- title --}}
                <img id="info_item_img" src="{{ asset('images/image.png') }}" alt=""> {{-- thumbnail --}}
            </div>
            <div class="descriptions p-4">
                <form action="" class="flex flex-col mb-2">
                    <label for="">Part ID</label>
                    <input id="item_input" class="border-2 border-slate-300 rounded px-4 py-2" name="item_id" type="text"> {{-- part id --}}
                </form>
                <div class="">
                    <div class="row grid grid-cols-2 items-center">
                        <p class="font-semibold text-lg text-slate-700">Part Name</p>
                        <p id="info_item_name">(part name)</p>
                    </div>
                    @if($customer->id==1)
                    <div class="row grid grid-cols-2 items-center">
                        <p class="font-semibold text-lg text-slate-700">Job No.</p>
                        <p id="info_item_job">(Job no.)</p>
                    </div>
                    @endif
                    <div class="row grid grid-cols-2 items-center">
                        <p class="font-semibold text-lg text-slate-700">QTY</p>
                        <p id="info_item_qty">(qty)</p>
                    </div>
                    <div class="row grid grid-cols-2 items-center">
                        <p class="font-semibold text-lg text-slate-700">Judgement</p>
                        <p id="info_item_judge">(OK/NG)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection