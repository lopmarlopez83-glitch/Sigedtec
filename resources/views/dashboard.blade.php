@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-100 p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Equipos Disponibles</h2>
                <p class="text-3xl">{{ $disponibles }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded shadow">
                <h2 class="text-lg font-semibold">En Mantenimiento</h2>
                <p class="text-3xl">{{ $mantenimiento }}</p>
            </div>
            <div class="bg-red-100 p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Solicitudes Pendientes</h2>
                <p class="text-3xl">{{ $pendientes }}</p>
            </div>
        </div>
    </div>
@endsection