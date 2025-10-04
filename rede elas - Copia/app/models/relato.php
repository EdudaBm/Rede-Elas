namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relato extends Model
{
    protected $fillable = ['titulo', 'descricao', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}