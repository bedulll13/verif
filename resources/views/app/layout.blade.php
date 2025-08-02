<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Metindo Inventory</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @stack('scripts')

</head>

<body>
    @php
        $code = explode('/', Request::path())[0];
    @endphp
    <div class="flex h-screen w-full">
        <div id="sidebar"
            class="small bg-slate-300 fixed min-w-[200px] h-screen border-r flex flex-col items-start justify-between py-6 px-4 md:px-6">
            <div class="flex flex-col items-center gap-4">
                <a class="flex items-center gap-2 font-bold" href="/{{ $code }}#">
                    <img src="{{ asset('images/Logo Metindo.png') }}" class="w-[60px]" alt="">
                </a>
                <nav class="flex flex-col items-start gap-2">
                    @if (auth()->user()->jabatan == 'operator')
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/scan/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M2 7V2h5v2H4v3zm0 15v-5h2v3h3v2zm15 0v-2h3v-3h2v5zm3-15V4h-3V2h5v5zm-2.5 10.5H19V19h-1.5zm0-3H19V16h-1.5zM16 16h1.5v1.5H16zm-1.5 1.5H16V19h-1.5zM13 16h1.5v1.5H13zm3-3h1.5v1.5H16zm-1.5 1.5H16V16h-1.5zM13 13h1.5v1.5H13zm6-8v6h-6V5zm-8 8v6H5v-6zm0-8v6H5V5zM9.5 17.5v-3h-3v3zm0-8v-3h-3v3zm8 0v-3h-3v3z" />
                            </svg>
                            <span class="navbar-label">
                                Scan
                            </span>
                        </a>
                    @elseif(auth()->user()->jabatan == 'admin')
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from Material Symbols by Google - https://github.com/google/material-design-icons/blob/master/LICENSE --><path fill="currentColor" d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75"/></svg>
                            <span class="navbar-label">
                                Dashboard
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/scan/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M2 7V2h5v2H4v3zm0 15v-5h2v3h3v2zm15 0v-2h3v-3h2v5zm3-15V4h-3V2h5v5zm-2.5 10.5H19V19h-1.5zm0-3H19V16h-1.5zM16 16h1.5v1.5H16zm-1.5 1.5H16V19h-1.5zM13 16h1.5v1.5H13zm3-3h1.5v1.5H16zm-1.5 1.5H16V16h-1.5zM13 13h1.5v1.5H13zm6-8v6h-6V5zm-8 8v6H5v-6zm0-8v6H5V5zM9.5 17.5v-3h-3v3zm0-8v-3h-3v3zm8 0v-3h-3v3z" />
                            </svg>
                            <span class="navbar-label">
                                Scan
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="1.5"
                                    d="M6 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0m16 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0m0 16a2 2 0 1 1-4 0a2 2 0 0 1 4 0M6 20a2 2 0 1 1-4 0a2 2 0 0 1 4 0M20 6v12m-2 2H6M18 4H6M4 6v12m12.5-9c0-.466 0-.699-.076-.883a1 1 0 0 0-.541-.54C15.699 7.5 15.466 7.5 15 7.5H9c-.466 0-.699 0-.883.076a1 1 0 0 0-.54.541C7.5 8.301 7.5 8.534 7.5 9s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077h6c.466 0 .699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883m0 6c0-.466 0-.699-.076-.883a1 1 0 0 0-.541-.54c-.184-.077-.417-.077-.883-.077H9c-.466 0-.699 0-.883.076a1 1 0 0 0-.54.541c-.077.184-.077.417-.077.883s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077h6c.466 0 .699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883"
                                    color="currentColor" />
                            </svg>
                            <span class="navbar-label">
                                Items
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/log">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                                    <rect width="30" height="36" x="9" y="8" rx="2" />
                                    <path stroke-linecap="round" d="M18 4v6m12-6v6m-14 9h16m-16 8h12m-12 8h8" />
                                </g>
                            </svg>
                            <span class="navbar-label">
                                Log
                            </span>
                        </a>
                        {{-- <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/report">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-width="1.5"
                                    d="M9 21h6m-6 0v-5m0 5H3.6a.6.6 0 0 1-.6-.6v-3.8a.6.6 0 0 1 .6-.6H9m6 5V9m0 12h5.4a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6h-4.8a.6.6 0 0 0-.6.6V9m0 0H9.6a.6.6 0 0 0-.6.6V16" />
                            </svg>
                            <span class="navbar-label">
                                Reports
                            </span>
                        </a> --}}
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/users">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M5 17.85q1.35-1.325 3.138-2.087T12 15t3.863.763T19 17.85V5H5zM12 13q1.45 0 2.475-1.025T15.5 9.5t-1.025-2.475T12 6T9.525 7.025T8.5 9.5t1.025 2.475T12 13m-9 8V3h18v18zm4-2h10v-.25q-1.05-.875-2.325-1.312T12 17t-2.675.438T7 18.75zm5-8q-.625 0-1.062-.437T10.5 9.5t.438-1.062T12 8t1.063.438T13.5 9.5t-.437 1.063T12 11m0 .425" />
                            </svg>
                            <span class="navbar-label">
                                Users
                            </span>
                        </a>
                    @elseif(auth()->user()->jabatan == 'manager')
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from Material Symbols by Google - https://github.com/google/material-design-icons/blob/master/LICENSE --><path fill="currentColor" d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75"/></svg>
                            <span class="navbar-label">
                                Dashboard
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/scan/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M2 7V2h5v2H4v3zm0 15v-5h2v3h3v2zm15 0v-2h3v-3h2v5zm3-15V4h-3V2h5v5zm-2.5 10.5H19V19h-1.5zm0-3H19V16h-1.5zM16 16h1.5v1.5H16zm-1.5 1.5H16V19h-1.5zM13 16h1.5v1.5H13zm3-3h1.5v1.5H16zm-1.5 1.5H16V16h-1.5zM13 13h1.5v1.5H13zm6-8v6h-6V5zm-8 8v6H5v-6zm0-8v6H5V5zM9.5 17.5v-3h-3v3zm0-8v-3h-3v3zm8 0v-3h-3v3z" />
                            </svg>
                            <span class="navbar-label">
                                Scan
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="1.5"
                                    d="M6 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0m16 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0m0 16a2 2 0 1 1-4 0a2 2 0 0 1 4 0M6 20a2 2 0 1 1-4 0a2 2 0 0 1 4 0M20 6v12m-2 2H6M18 4H6M4 6v12m12.5-9c0-.466 0-.699-.076-.883a1 1 0 0 0-.541-.54C15.699 7.5 15.466 7.5 15 7.5H9c-.466 0-.699 0-.883.076a1 1 0 0 0-.54.541C7.5 8.301 7.5 8.534 7.5 9s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077h6c.466 0 .699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883m0 6c0-.466 0-.699-.076-.883a1 1 0 0 0-.541-.54c-.184-.077-.417-.077-.883-.077H9c-.466 0-.699 0-.883.076a1 1 0 0 0-.54.541c-.077.184-.077.417-.077.883s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077h6c.466 0 .699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883"
                                    color="currentColor" />
                            </svg>
                            <span class="navbar-label">
                                Items
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/log">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                                    <rect width="30" height="36" x="9" y="8" rx="2" />
                                    <path stroke-linecap="round" d="M18 4v6m12-6v6m-14 9h16m-16 8h12m-12 8h8" />
                                </g>
                            </svg>
                            <span class="navbar-label">
                                Log
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/report">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-width="1.5"
                                    d="M9 21h6m-6 0v-5m0 5H3.6a.6.6 0 0 1-.6-.6v-3.8a.6.6 0 0 1 .6-.6H9m6 5V9m0 12h5.4a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6h-4.8a.6.6 0 0 0-.6.6V9m0 0H9.6a.6.6 0 0 0-.6.6V16" />
                            </svg>
                            <span class="navbar-label">
                                Reports
                            </span>
                        </a>
                    @elseif(auth()->user()->jabatan == 'staff')
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from Material Symbols by Google - https://github.com/google/material-design-icons/blob/master/LICENSE --><path fill="currentColor" d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75"/></svg>
                            <span class="navbar-label">
                                Dashboard
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="1.5"
                                    d="M6 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0m16 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0m0 16a2 2 0 1 1-4 0a2 2 0 0 1 4 0M6 20a2 2 0 1 1-4 0a2 2 0 0 1 4 0M20 6v12m-2 2H6M18 4H6M4 6v12m12.5-9c0-.466 0-.699-.076-.883a1 1 0 0 0-.541-.54C15.699 7.5 15.466 7.5 15 7.5H9c-.466 0-.699 0-.883.076a1 1 0 0 0-.54.541C7.5 8.301 7.5 8.534 7.5 9s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077h6c.466 0 .699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883m0 6c0-.466 0-.699-.076-.883a1 1 0 0 0-.541-.54c-.184-.077-.417-.077-.883-.077H9c-.466 0-.699 0-.883.076a1 1 0 0 0-.54.541c-.077.184-.077.417-.077.883s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077h6c.466 0 .699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883"
                                    color="currentColor" />
                            </svg>
                            <span class="navbar-label">
                                Items
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/log">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                                    <rect width="30" height="36" x="9" y="8" rx="2" />
                                    <path stroke-linecap="round" d="M18 4v6m12-6v6m-14 9h16m-16 8h12m-12 8h8" />
                                </g>
                            </svg>
                            <span class="navbar-label">
                                Log
                            </span>
                        </a>
                        <a class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-foreground"
                            href="/{{ $code }}/dashboards/report">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-width="1.5"
                                    d="M9 21h6m-6 0v-5m0 5H3.6a.6.6 0 0 1-.6-.6v-3.8a.6.6 0 0 1 .6-.6H9m6 5V9m0 12h5.4a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6h-4.8a.6.6 0 0 0-.6.6V9m0 0H9.6a.6.6 0 0 0-.6.6V16" />
                            </svg>
                            <span class="navbar-label">
                                Reports
                            </span>
                        </a>
                    @endif
                </nav>
            </div>
        </div>
        <div id="content" class="flex flex-1 flex-col ml-[200px]">
            <header class="w-full p-4 flex justify-between items-center bg-slate-200">
                <span class="text-3xl select-none cursor-pointer" id="nav-toggle">&equiv;</span>
                <form method="post" action="/{{ $code }}/logout">
                    @csrf
                    <button>Log Out</button>
                </form>
            </header>
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        const navToggle = document.getElementById('nav-toggle')
        const sidebar = document.getElementById('sidebar')
        const content = document.getElementById('content')
        const navlabels = document.querySelectorAll('.navbar-label')

        navToggle.addEventListener('click', () => {
            sidebar.classList.toggle('min-w-[200px]')
            content.classList.toggle('ml-[200px]')
            content.classList.toggle('ml-[100px]')

            navlabels.forEach((label) => {
                label.classList.toggle('hidden')
            })
        })
    </script>
</body>

</html>
