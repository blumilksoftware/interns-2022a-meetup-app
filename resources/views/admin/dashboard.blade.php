@extends('layouts.app')

@section('content')
<div>
  @include('partials.admin-navbar')
  <div class="md:pl-64 flex flex-col flex-1">
    <main>
      <div class="bg-white rounded-20 m-12 px-10 py-6">
        <h3 class="text-2xl font-semibold">Dashboard</h3>
      </div>
    </main>
  </div>
</div>
@endsection
