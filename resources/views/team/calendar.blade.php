@extends('layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <h1>Kalender Project</h1>
        <p>Fitur kalender akan tersedia nanti.</p>
    </div>
</div>
<style>.team-main { margin-left: 280px; } @media (max-width: 768px) { .team-main { margin-left: 0; } }</style>
@endsection