<?php

use App\Http\Livewire\Bases\BaseLivewire;
use App\Http\Livewire\Courtyards\StockLivewire as CourtyardsStockLivewire;
use App\Http\Livewire\CourtyardLivewire;
use App\Http\Livewire\LoteLivewire;
use App\Http\Livewire\MastLivewire;
use App\Http\Livewire\ProjectLivewire;
use App\Http\Livewire\SectorLivewire;
use App\Http\Livewire\NfLivewire;
use App\Http\Livewire\PdfViewer;
use App\Http\Livewire\TypeLivewire;
use App\Http\Livewire\TrechoLivewire;
use App\Http\Livewire\Sectors\StockLivewire;
use App\Http\Livewire\Lotes\StockLivewire as LoteStock;
use App\Http\Livewire\Permissions\PermissionsLivewire;
use App\Http\Livewire\Trechos\StockLivewire as TrechoStock;
use App\Http\Livewire\Project\StockLivewire as ProjetoStock;
use App\Http\Livewire\Roles\RolePermissionsLivewire;
use App\Http\Livewire\Roles\RolesLivewire;
use App\Http\Livewire\Tower\TowerLivewire;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', function () {
    return view('welcome');
});
Route::prefix('dashboard')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('config')->group(function () {
        Route::get('types', TypeLivewire::class)->name('dashboard.config.types');
        Route::get('mastros', MastLivewire::class)->name('dashboard.config.mastros');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/page',RolesLivewire::class)->name('dashboard.roles.page');
        Route::get('/{role}/permissions',RolePermissionsLivewire::class)->name('dashboard.roles.permissions');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/page',PermissionsLivewire::class)->name('dashboard.permissions.page');
    });

    Route::prefix('preview')->group(function (){
        Route::get('nota/{nf}/preview',PdfViewer::class)->name('dashboard.preview.nota');
    });

    Route::prefix('financeiro')->group(function (){
        Route::get('/nfs',NfLivewire::class)->name('dashboard.financeiro.nfs');
    });

    Route::prefix('projetos')->group(function () {
        Route::get('/', ProjectLivewire::class)->name('dashboard.projects');
        Route::get('/{projeto}/lotes', LoteLivewire::class)->name('dashboard.projects.lotes');
        Route::get('/{projeto}/estoque', ProjetoStock::class)->name('dashboard.projects.estoque');
        Route::get('/{projeto}/torres', TowerLivewire::class)->name('dashboard.projects.torres');
        Route::get('/{projeto}/bases', BaseLivewire::class)->name('dashboard.projects.bases');

        Route::prefix('/bases')->group(function(){
            Route::get('/{base}/setores',SectorLivewire::class)->name('dashboard.bases.setores');
        });

        Route::prefix('/lotes')->group(function () {
            Route::get('/{lote}/trechos', TrechoLivewire::class)->name('dashboard.lotes.trechos');
            Route::get('/{lote}/estoque', LoteStock::class)->name('dashboard.lotes.estoque');

            Route::prefix('/trechos')->group(function () {
                Route::get('/{trecho}/canteiros', CourtyardLivewire::class)->name('dashboard.trechos.canteiros');
                Route::get('{trecho}/estoque',TrechoStock::class)->name('dashboard.sector.estoque');

                Route::prefix('/canteiros')->group(function () {
                    Route::get('/{canteiro}/setores', SectorLivewire::class)->name('dashboard.canteiros.setores');
                    Route::get('/{canteiro}/estoque', CourtyardsStockLivewire::class)->name('dashboard.canteiros.estoque');

                    Route::prefix('/setor')->group(function () {
                        Route::get('/{setor}/painel', [SectorLivewire::class, 'painel'])->name('dashboard.sector.painel');
                        Route::get('{setor}/estoque',StockLivewire::class)->name('dashboard.sector.estoque');
                    });
                });
            });
        });
    });
});
