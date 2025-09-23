<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['servicio_id','cliente','fecha'];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
