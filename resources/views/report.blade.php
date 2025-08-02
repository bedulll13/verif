@extends('app.layout')
@section('content')
<!--
// v0 by Vercel.
// https://v0.dev/t/Hixs0AlhHTt
-->

<div class="container mx-auto px-4 py-12 md:py-16 lg:py-20">
  <div class="max-w-3xl mx-auto space-y-6">
    <div class="text-center">
      <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Generate Report Transaction</h1>
      <p class="mt-3 text-lg text-muted-foreground">Select a date range to generate a report.</p>
    </div>
    <form class="bg-card p-6 rounded-lg shadow-sm space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
            for="start-date"
          >
            Start Date
          </label>
          <input
            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mt-1"
            id="start-date"
            placeholder="Select start date"
            type="date"
          />
        </div>
        <div>
          <label
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
            for="end-date"
          >
            End Date
          </label>
          <input
            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            id="end-date"
            type="date"
          />
        </div>
      </div>
      <button
        type="submit"
        class="w-full mt-4 rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        Generate Transaction
      </button>
    </form>
  </div>
</div>
@endsection
