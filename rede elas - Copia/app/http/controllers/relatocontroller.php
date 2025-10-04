namespace App\Http\Controllers;

use App\Models\Relato;
use Illuminate\Http\Request;

class RelatoController extends Controller
{
    public function index()
    {
        $relatos = Relato::latest()->get();
        return view('relato', compact('relatos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        Relato::create([
            'titulo'    => $request->titulo,
            'descricao' => $request->descricao,
            'user_id'   => auth()->id(),
        ]);

        return redirect()->route('relatos.index')->with('success', 'Relato enviado com sucesso!');
    }
}