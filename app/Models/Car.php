<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand',
        'model', 
        'year',
        'mileage',
        'color',
        'body_type',
        'image',
        'detailed_description',
        'user_id'
    ];

    // Мутаторы
    public function setDetailedDescriptionAttribute($value)
    {
        // Очищаем от HTML тегов
        $this->attributes['detailed_description'] = strip_tags($value);
    }

    public function getFormattedMileageAttribute()
    {
        return number_format($this->mileage, 0, '.', ' ') . ' км';
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        }
        return asset('images/no-image.jpg');
    }

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Проверка, является ли пользователь владельцем
    public function isOwnedBy(User $user)
    {
        return $this->user_id === $user->id;
    }

    // ✅ Events/Closures для проверки прав на уровне модели
    protected static function booted()
    {
        // Closure для проверки доступа при сохранении
        static::saving(function ($car) {
            // Если автомобиль уже существует (обновление)
            if ($car->exists) {
                $user = Auth::user();
                
                // Проверяем права через Gate
                if ($user && !$user->can('update', $car)) {
                    abort(403, 'У вас нет прав для изменения этого автомобиля');
                }
            }
        });

        // Closure для проверки доступа при удалении
        static::deleting(function ($car) {
            $user = Auth::user();
            
            // Если мягкое удаление и пользователь не админ
            if (!$car->isForceDeleting()) {
                if ($user && !$user->can('delete', $car)) {
                    abort(403, 'У вас нет прав для удаления этого автомобиля');
                }
            }
            // Если полное удаление
            else {
                if ($user && !$user->can('forceDelete', $car)) {
                    abort(403, 'У вас нет прав для полного удаления этого автомобиля');
                }
            }
        });
    }
}