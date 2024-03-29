<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['name','path', 'item', 'cod', 'base_id', 'und', 'description', 'qtd', 'trecho_id', 'lote_id', 'project_id', 'sector_id'];

    public function canteiroDono()
    {
        return $this->belongsTo(Courtyard::class,'base_id');
    }

    public function trechoDono()
    {
        return $this->belongsTo(Trecho::class,'trecho_id');
    }

    public function setorDono()
    {
        return $this->belongsTo(Sector::class,'sector_id');
    }
    public function projeto()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
