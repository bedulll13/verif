@extends('app.home')
@section('content')
<!--
// v0 by Vercel.
// https://v0.dev/t/hUe3WZf9WYr
-->

<div class="flex flex-col min-h-screen w-full bg-gray-100 dark:bg-gray-950">
    <div class="flex h-full w-full items-center justify-center px-4">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md" data-v0-t="card">
            <div class="flex flex-col p-6 space-y-1 text-center">
                <h3 class="whitespace-nowrap tracking-tight text-2xl font-bold">Metindo Inventory</h3>
                <p class="text-sm text-muted-foreground">Enter your username and password to access your account.</p>
            </div>
            <div class="p-6 space-y-4">
                <form method="POST">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                            Username
                        </label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" name="username" required="" type="text" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">
                            Password
                        </label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" name="password" required="" type="password" />
                    </div>
                    <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full" type="submit">
                        Sign in
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endsection