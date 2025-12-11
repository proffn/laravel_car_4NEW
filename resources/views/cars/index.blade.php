@extends('layouts.app')

@section('title', 'Автомобили от владельцев')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-muted fw-light" style="font-family: 'Play', sans-serif;">
            Автомобили от владельцев
        </h1>
    </div>

    <!-- Сообщения об успехе -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($cars->isEmpty())
        <!-- Если нет автомобилей -->
        <div class="text-center py-5">
            <div class="display-1 text-muted mb-3">
                <i class="fas fa-car"></i>
            </div>
            <h3 class="mb-3">Автомобилей пока нет</h3>
            <p class="text-muted mb-4">Добавьте первый автомобиль через кнопку "Добавить" в шапке сайта</p>
        </div>
    @else
        <!-- Автомобили из базы данных -->
        <div class="row g-4 justify-content-center">
            @foreach($cars as $car)
            <div class="col-xxxl-3 col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="card shadow-sm border-0 rounded-4 h-100 position-relative overflow-hidden car-card"
                     onclick="window.location='{{ route('cars.show', $car) }}'" 
                     style="cursor: pointer;">
                    <!-- Тип кузова -->
                    <div class="position-absolute top-0 start-0 m-2 px-2 py-1 bg-primary text-white rounded fw-semibold small shadow-sm">
                        {{ $car->body_type }}
                    </div>
                    
                    <!-- Изображение -->
                    <img src="{{ $car->image_url }}" 
                         class="card-img-top img-fluid" 
                         alt="{{ $car->brand }} {{ $car->model }}"
                         style="height: 250px; object-fit: cover;">
                    
                    <div class="card-body bg-light-subtle">
                        <!-- Название без года -->
                        <h5 class="card-title fw-bold mb-2">{{ $car->brand }} {{ $car->model }}</h5>
                        
                        <!-- Основная информация -->
                        <p class="card-text text-muted">
                            <strong>Год:</strong> {{ $car->year }}<br>
                            <strong>Пробег:</strong> {{ number_format($car->mileage, 0, ',', ' ') }} км<br>
                            <strong>Цвет:</strong> {{ $car->color }}
                        </p>
                        
                        <!-- Кнопка "Подробнее" -->
                        <div class="mt-3">
                            <a href="{{ route('cars.show', $car) }}" 
                               class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-eye me-1"></i>Подробнее
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection