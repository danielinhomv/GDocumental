<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use App\Models\Casos\Caso;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

//audit 



class User extends Authenticatable 
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'nombre_completo',
        'direccion',
        'nota_adicional',
        'rol'
    ];
    static $rules=[
        // 'cliente_id'=>'required',
        'name' => 'required',
        'nombre_completo' => 'required',
        'email' => 'required',
        'password' => 'required|min:8',
        'direccion' => 'required',
        'telefono' => 'required',
        'nota_adicional' => 'nullable',
     ];
    public $timestamp=false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    /**
     * Obtener los casos asociados a este usuario. uno a mucho usuario tiene mucho
     */
    public function cliente_user()
    {
        return $this->hasMany(Caso::class, 'cliente_id');
    }

    public function abogado_user()
    {
        return $this->hasMany(Caso::class, 'abogado_id');
    }

    public function empresa():HasMany{
        return $this->HasMany(User::class, 'empresa_id');
    }

    public function children_empresa(): HasMany{
        return $this->hasMany(User::class,'empresa_id')->with('empresa');
    
    }
    public function estaEliminado()
    {
        if ($this->eliminado) {
            throw new Exception('El usuario está eliminado.');
        }
    }
    static function tieneRol($rol){
        try {            
            $user=self::findOrFail(Auth::id());
            if($user->rol !== $rol){
                abort(403, 'No estás autorizado para acceder a esta página.');
            }       
        } catch (\Throwable $th) {
            abort(403, 'No estás autorizado..');
        }
    }
    static function esClienteOrAbogado()
    {
        try {
            $user = self::findOrFail(Auth::id());
            if ($user->rol == null) {
                abort(403, 'No estás autorizado.');
            }
        } catch (\Throwable $th) {
            abort(403, 'No estás autorizado.');
        }
    }
    
    public function rol()
    {
        return $this->rol;
    }
    public static function existe($id)
    {
        try {
            $abogado = self::findOrFail($id);
            if ($abogado->eliminado) {
                throw new Exception('la abogado está eliminada.');
            }
        
        } catch (\Throwable $th) {
            throw new Exception('La abogado no existe.');
        }
    }
    
}
