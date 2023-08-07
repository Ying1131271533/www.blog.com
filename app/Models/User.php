<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

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
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
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
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

     /**
     * 获取与用户相关的电话记录
     */
    public function session()
    {
        return $this->hasOne(Session::class);
    }

    /**
     * 获取用户的所有博客
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }




    /********************* ElasticSearch *********************/

    use Searchable;

    /**
     * 指定索引
     * @return string
     */
    // public function searchableAs()
    // {
    //     return 'users';
    // }

    /**
     * 获取模型的可索引数据。
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        // $array = $this->toArray();

        $array = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        return $array;
    }

    /**
     * 指定 搜索索引中存储的唯一ID
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->id;
    }

    /**
     * 指定 搜索索引中存储的唯一ID的键名
     * @return string
     */
    public function getScoutKeyName()
    {
        return 'id';
    }
}
