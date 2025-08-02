@extends('app.layout')
@section('content')
    @php
        $code = explode('/', Request::path())[0];
    @endphp
    <style>
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-10px);
            }

            40%,
            80% {
                transform: translateX(10px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        .pulse {
            animation: pulse 0.5s ease-in-out;
        }
    </style>

    <div class="w-full flex flex-row justify-center items-center">
        <div class="w-full grid grid-cols-2 border-2">
            <div class="left-panel grid grid-cols-1 border min-h-[400px] transition-all duration-500">
                <div class="head flex flex-col justify-center items-center ">
                    <h3 class="text-3xl font-bold text-center py-4">Kanban Customer</h3>
                    <img id="info_part_img" src="{{ asset('images/image.png') }}" alt="">
                </div>
                <div class="descriptions p-4 ">
                    <form onsubmit="return false;" class="flex flex-col mb-2">
                        <label for="">Part ID</label>
                        <input id="part_input" class="border-2 border-slate-300 w-full rounded px-4 py-2" name="part_id"
                            type="text">
                    </form>
                    <div class=" mt-2">
                        <div class="row grid grid-cols-2 items-center">
                            <p class="font-semibold text-lg text-slate-700">Part Name</p>
                            <p id="info_part_name">(part name)</p>
                        </div>
                        @if ($customer->id == 1)
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
                            <p class="text-xl px-2 py-1 rounded" id="info_part_judge">(OK/NG)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-panel grid grid-cols-1 border min-h-[400px] transition-all duration-500">
                <div class="head flex flex-col justify-center items-center ">
                    <h3 class="text-3xl font-bold text-center py-4">Product Packaging</h3>
                    <img id="info_item_img" src="{{ asset('images/image.png') }}" alt="">
                </div>
                <div class="descriptions p-4">
                    <form onsubmit="return false;" class="flex flex-col mb-2">
                        <label for="">Part ID</label>
                        <input id="item_input" class="border-2 border-slate-300 rounded px-4 py-2" name="item_id"
                            type="text">
                    </form>
                    <div class="">
                        <div class="row grid grid-cols-2 items-center">
                            <p class="font-semibold text-lg text-slate-700">Part Name</p>
                            <p id="info_item_name">(part name)</p>
                        </div>
                        @if ($customer->id == 1)
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
                            <p class="text-xl px-2 py-1 rounded" id="info_item_judge">(OK/NG)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fail_modal" class="w-full h-screen flex justify-center items-center absolute top-0 left-0 bg-black/60 hidden">
        <div class="pass-modal p-8 rounded gap-4 bg-gray-800 flex flex-col items-center justify-center">
            <div class="w-full flex flex-col justify-center items-center gap-3">
                <span class="text-2xl text-gray-100 font-bold">Panggil LEADER</span>
                <span id="fail_notice" class="text-red-500 hidden">Invalid password!</span>
                <input type="password" id="fail_input" class="rounded px-3 py-2" placeholder="Password">
                <button id="fail_button" class="bg-red-500 p-2 font-semibold text-gray-100 rounded">ENTER</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function updateJudgementColor(el) {
            const value = el.textContent.trim().toUpperCase();
            const leftPanel = document.querySelector('.left-panel');
            const rightPanel = document.querySelector('.right-panel');

            el.classList.remove('shake', 'pulse');
            leftPanel.classList.remove('shake', 'pulse');
            rightPanel.classList.remove('shake', 'pulse');

            const soundOk = new Audio("/audio/ok.mp3")
            const soundTidakCocok = new Audio("/audio/tidakCocok.mp3")
            const soundTelahDiscan = new Audio("/audio/telahDiscan.mp3")

            if (value === 'OK') {
                el.style.backgroundColor = 'green';
                el.style.color = 'white';
                leftPanel.style.backgroundColor = '#bbf7d0';
                rightPanel.style.backgroundColor = '#bbf7d0';

                el.classList.add('pulse');
                leftPanel.classList.add('pulse');
                rightPanel.classList.add('pulse');

                setTimeout(() => {
                    el.classList.remove('pulse');
                    leftPanel.classList.remove('pulse');
                    rightPanel.classList.remove('pulse');
                    window.location.reload()
                }, 1000);
            } else if (value === 'NG') {
                el.style.backgroundColor = 'red';
                el.style.color = 'white';
                leftPanel.style.backgroundColor = '#fecaca';
                rightPanel.style.backgroundColor = '#fecaca';

                el.classList.add('shake');
                leftPanel.classList.add('shake');
                rightPanel.classList.add('shake');

                const modal = document.getElementById('fail_modal');
                const input = document.getElementById('fail_input');
                const notice = document.getElementById('fail_notice');
                modal.classList.remove('hidden');
                input.value = '';
                notice.classList.add('hidden');
                input.focus();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const partJudge = document.getElementById("info_part_judge");
            const itemJudge = document.getElementById("info_item_judge");
            const partInput = document.getElementById("part_input");
            const itemInput = document.getElementById("item_input");

            updateJudgementColor(partJudge);
            updateJudgementColor(itemJudge);

            [partJudge, itemJudge].forEach(el => {
                new MutationObserver(() => updateJudgementColor(el))
                    .observe(el, {
                        childList: true,
                        characterData: true,
                        subtree: true
                    });
            });

            partInput.focus();
            partInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    setTimeout(() => {
                        itemInput.focus();
                        itemInput.select();
                    }, 100);
                }
            });

            const button = document.getElementById('fail_button');
            button.addEventListener('click', function() {
                const input = document.getElementById('fail_input');
                const notice = document.getElementById('fail_notice');
                const modal = document.getElementById('fail_modal');

                if (input.value.trim() === 'leader123') {
                    notice.classList.add('hidden');
                    modal.classList.add('hidden');
                    setTimeout(() => {
                        window.location.reload()
                    }, 500);
                } else {
                    notice.classList.remove('hidden');
                    input.focus();
                }
            });

            document.getElementById('fail_input').addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    button.click();
                }
            });
        });
    </script>
@endpush
