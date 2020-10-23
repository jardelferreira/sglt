<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'item', 'cod', 'courtyard_id', 'und', 'description', 'qtd', 'trecho_id', 'lote_id', 'project_id', 'sector_id'];

    public function canteiroDono()
    {
        return $this->belongsTo(Courtyard::class,'courtyard_id');
    }

    public function trechoDono()
    {
        return $this->belongsTo(Trecho::class,'trecho_id');
    }
}
