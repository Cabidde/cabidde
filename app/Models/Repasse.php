<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Pedido;

class Repasse extends Model
{
    
    protected $table = 'repasse';
    protected $fillable = ['descricao', 'valor', 'pedido_id'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
