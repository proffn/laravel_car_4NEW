{{-- resources/views/cars/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Редактировать ' . $car->brand . ' ' . $car->model)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning text-dark py-3 rounded-top-4">
                    <h2 class="h4 mb-0">
                        <i class="fas fa-edit me-2"></i>Редактировать: {{ $car->brand }} {{ $car->model }}
                    </h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Подключаем общую форму. Переменная $car уже передана сюда --}}
                        @include('cars._form')
                        
                        <!-- Кнопки -->
                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="{{ route('cars.show', $car) }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-2"></i>Отмена
                            </a>
                            <button type="submit" class="btn btn-warning px-5">
                                <i class="fas fa-save me-2"></i>Сохранить изменения
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection