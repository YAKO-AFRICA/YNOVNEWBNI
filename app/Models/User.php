<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Membre;
use App\Models\Profile;
use App\Models\NotifGroup;
use Illuminate\Support\Str;
use BaconQrCode\Encoder\QrCode;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection = 'mysql';
    protected $fillable = [
        'uuid',
        'idmembre',
        'email',
        'profile_uuid',
        'login',
        'etat',
        'id_role',
        'role',
        'password',
        'codepartenaire',
        'branche',
        'lastlogin',
        'group_uuid',
        'qr_code_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function groupNotif()
    {
        return $this->belongsTo(NotifGroup::class, 'group_uuid', 'code_group');
    }
    // public function membre()
    // {
    //     return $this->belongsTo(Membre::class, 'idmembre', 'idmembre');
    // }

    public function membre()
    {
        return $this->hasOne(Membre::class, 'idmembre', 'idmembre');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_uuid', 'uuid');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if ($user->hasRole('commercial')) {
                $user->update([
                    'qr_code_token' => Str::random(40)
                ]);
            }
        });
    }

    public function generateQrCode()
    {
        return QrCode::size(300)->generate(route('prospect.store', $this->qr_code_token));
    }
}
