@extends('layouts.app')

@section('title', 'Список пользователей')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-users me-2"></i>Список пользователей
        </h1>
        <a href="{{ route('cars.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Все автомобили
        </a>
    </div>

    @if($users->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            В системе пока нет пользователей.
        </div>
    @else
        <div class="row">
            @foreach($users as $user)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-user fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="card-title mb-0">{{ $user->name }}</h5>
                                <p class="card-text text-muted mb-0">{{ $user->email }}</p>
                            </div>
                            @if($user->is_admin)
                                <span class="badge bg-danger">
                                    <i class="fas fa-crown me-1"></i>Админ
                                </span>
                            @endif
                        </div>
                        
                        <div class="card-text">
                            <p class="mb-2">
                                <i class="fas fa-car me-2 text-primary"></i>
                                <strong>Автомобилей:</strong> {{ $user->cars_count }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-calendar me-2 text-primary"></i>
                                <strong>Зарегистрирован:</strong> {{ $user->created_at->format('d.m.Y') }}
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-clock me-2 text-primary"></i>
                                <strong>В системе:</strong> {{ $user->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('users.cars', $user->name) }}" class="btn btn-primary w-100">
                            <i class="fas fa-car me-1"></i>Просмотреть автомобили
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection