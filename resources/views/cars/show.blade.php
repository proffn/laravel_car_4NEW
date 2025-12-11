@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model)

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Левая колонка: Изображение и основная информация -->
        <div class="col-lg-8">
            <!-- Карточка с основной информацией -->
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <!-- Заголовок -->
                <div class="card-header bg-primary text-white py-3 rounded-top-4">
                    <h1 class="h3 mb-0">
                        <i class="fas fa-car me-2"></i>{{ $car->brand }} {{ $car->model }}
                    </h1>
                </div>

                <!-- Тело карточки -->
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Изображение -->
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="position-relative">
                                <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}" 
                                     class="img-fluid rounded-3 shadow-sm" style="max-height: 400px; width: 100%; object-fit: cover;">
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-primary fs-6 py-2 px-3">
                                        {{ $car->body_type }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Основная информация -->
                        <div class="col-md-6">
                            <div class="d-flex flex-column h-100">
                                <!-- Характеристики -->
                                <div class="mb-4">
                                    <h4 class="h5 fw-bold mb-3">
                                        <i class="fas fa-list-alt me-2 text-primary"></i>Характеристики
                                    </h4>
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small">Марка</div>
                                            <div class="fw-semibold">{{ $car->brand }}</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small">Модель</div>
                                            <div class="fw-semibold">{{ $car->model }}</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small">Год выпуска</div>
                                            <div class="fw-semibold">{{ $car->year }}</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small">Пробег</div>
                                            <div class="fw-semibold">{{ $car->formatted_mileage }}</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small">Цвет</div>
                                            <div class="fw-semibold">{{ $car->color }}</div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small">Тип кузова</div>
                                            <div class="fw-semibold">{{ $car->body_type }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Подробное описание объявления -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-light py-3">
                    <h3 class="h5 mb-0">
                        <i class="fas fa-align-left me-2 text-primary"></i>Подробное описание объявления
                    </h3>
                </div>
                <div class="card-body p-4">
                    @if($car->detailed_description)
                        <div class="fs-5 lh-base">
                            {{ $car->detailed_description }}
                        </div>
                    @else
                        <div class="text-muted text-center py-3">
                            <i class="fas fa-info-circle me-2"></i>Подробное описание отсутствует
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Правая колонка: Действия -->
        <div class="col-lg-4">
            <!-- Карточка действий -->
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-header bg-dark text-white py-3 rounded-top-4">
                    <h3 class="h5 mb-0">
                        <i class="fas fa-cogs me-2"></i>Действия
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <!-- Кнопка "Редактировать" -->
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning btn-lg py-3">
                            <i class="fas fa-edit me-2"></i>Редактировать
                        </a>

                        <!-- Кнопка "Назад к списку" -->
                        <a href="{{ route('cars.index') }}" class="btn btn-outline-primary btn-lg py-3">
                            <i class="fas fa-arrow-left me-2"></i>Назад к списку
                        </a>

                        <!-- Кнопка "Удалить" -->
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-grid">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg py-3" 
                                    onclick="return confirm('Вы уверены что хотите удалить этот автомобиль?')">
                                <i class="fas fa-trash-alt me-2"></i>Удалить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection