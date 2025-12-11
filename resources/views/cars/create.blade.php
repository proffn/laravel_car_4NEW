{{-- resources/views/cars/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Добавить автомобиль')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white py-3 rounded-top-4">
                    <h2 class="h4 mb-0">
                        <i class="fas fa-car me-2"></i>Добавить новый автомобиль
                    </h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Подключаем общую форму --}}
                        @include('cars._form')
                        
                        <!-- Кнопки -->
                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i>Назад
                            </a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Добавить автомобиль
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection