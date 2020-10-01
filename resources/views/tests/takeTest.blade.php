@extends('layouts.app')
@section('content')
<div class="container  bg-white">  
<h2 class="text-primary text-center">Thank you for making to the Trade Test</h2>
<hr>
<livewire:take-test :qp_number="$qp_number">
</div>
@endsection
