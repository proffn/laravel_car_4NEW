<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Показать все автомобили (главная страница)
    public function index()
    {
        $cars = Car::latest()->get();
        return view('cars.index', compact('cars'));
    }

    // Показать форму создания
    public function create()
    {
        return view('cars.create');
    }

    // Сохранить новый автомобиль (с валидацией)
    public function store(Request $request)
    {
        // ВАЛИДАЦИЯ С ИСПРАВЛЕНИЕМ ДЛЯ PNG
        $validated = $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'color' => 'required|string|max:30',
            'body_type' => 'required|string|in:Седан,Универсал,Хэтчбек,Внедорожник,Купе,Минивэн,Пикап',
            'detailed_description' => 'required|string|min:10',
            // ИСПРАВЛЕНИЕ: убрали 'image', оставили только проверку по расширению
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp,bmp|max:5120'
        ]);

        // Обработка изображения
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Безопасное имя файла (убираем русские буквы и пробелы)
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $safeName = str_replace([' ', '_'], '-', $originalName); // заменяем пробелы и подчеркивания
            $imageName = time() . '_' . $safeName . '.' . $extension;
            
            $path = $image->storeAs('cars', $imageName, 'public');
            $validated['image'] = $path;
        }

        // Создаем автомобиль
        Car::create($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Автомобиль успешно добавлен!');
    }

    // Показать детальную информацию об автомобиле
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // Показать форму редактирования
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Обновить автомобиль (с валидацией)
    public function update(Request $request, Car $car)
    {
        // ВАЛИДАЦИЯ С ИСПРАВЛЕНИЕМ ДЛЯ PNG
        $validated = $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'color' => 'required|string|max:30',
            'body_type' => 'required|string|in:Седан,Универсал,Хэтчбек,Внедорожник,Купе,Минивэн,Пикап',
            'detailed_description' => 'required|string|min:10',
            // ИСПРАВЛЕНИЕ: убрали 'image', оставили только проверку по расширению
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp,bmp|max:5120'
        ]);

        // Обработка нового изображения
        if ($request->hasFile('image')) {
            // Удаляем старое изображение если оно есть
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            
            $image = $request->file('image');
            
            // Безопасное имя файла
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $safeName = str_replace([' ', '_'], '-', $originalName);
            $imageName = time() . '_' . $safeName . '.' . $extension;
            
            $path = $image->storeAs('cars', $imageName, 'public');
            $validated['image'] = $path;
        } else {
            // Если новое изображение не загружено - сохраняем старое
            $validated['image'] = $car->image;
        }

        // Обновляем автомобиль
        $car->update($validated);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Автомобиль успешно обновлен!');
    }

    // Удалить автомобиль (мягкое удаление)
    public function destroy(Car $car)
    {
        // Удаляем изображение при удалении записи (опционально)
        if ($car->image && Storage::disk('public')->exists($car->image)) {
            Storage::disk('public')->delete($car->image);
        }
        
        $car->delete();
        
        return redirect()->route('cars.index')
            ->with('success', 'Автомобиль успешно удален!');
    }
}