use App\Http\Controllers\AuthController;
use App\Http\Controllers\RelatoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\EmergenciaController;

// Página inicial
Route::get('/', fn() => view('inicio'))->name('inicio');

// Autenticação
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cadastro
Route::get('/cadastro', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register');

// Relatos
Route::get('/relatos', [RelatoController::class, 'index'])->name('relatos.index');
Route::post('/relatos', [RelatoController::class, 'store'])->name('relatos.store');

// Contatos
Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos.index');

// Perfil
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');

// Configurações
Route::get('/configuracao', [ConfigController::class, 'index'])->name('config.index');

// Botão de Emergência
Route::get('/emergencia', [EmergenciaController::class, 'index'])->name('emergencia.index');