<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected  $table = 'vendas';
    protected $fillable = [ 'descricao', 'data_venda', 'valor_total', 'cliente_id'];

    public function items()
    {
        return $this->hasMany(VendaItem::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
