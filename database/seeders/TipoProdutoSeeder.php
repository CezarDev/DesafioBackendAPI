<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tipo_produto')->insert([
            'nome' => 'Produto Simples',
            'descricao' => 'Livros, flores, ferramentas e etc',
            'tipo' => 'simples',
        ]);

        DB::table('tipo_produto')->insert([
            'nome' => 'Produto Digital',
            'descricao' => 'Ebooks, videoaulas, audiobooks, PDFs e etc...',
            'tipo' => 'digital',
        ]);

        DB::table('tipo_produto')->insert([
            'nome' => 'Produto Configurável',
            'descricao' => 'Camisetas, canecas, tênis e etc',
            'tipo' => 'configuravel',
        ]);

        DB::table('tipo_produto')->insert([
            'nome' => 'Produto Agrupado',
            'descricao' => 'Produto caracterizado por ser a reunião de produtos simples.',
            'tipo' => 'agrupado',
        ]);
    }
}
