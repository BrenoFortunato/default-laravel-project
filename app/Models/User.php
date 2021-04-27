<?php

namespace App\Models;

use App\Services\Functions;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Models
 * @version April 26, 2021, 12:28 pm -03
 */
class User extends Authenticatable implements HasMedia
{
    use HasRoles;
    use HasFactory;
    use Notifiable;
    use InteractsWithMedia;

    /**
     * The table associated with the model
     *
     * @var string
     */
    public $table = 'users';

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'photo',
        'email_verified_at',
    ];

    /**
     * The attributes that should be casted to native types
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'name'              => 'string',
        'email'             => 'string',
        'password'          => 'string',
        'is_active'         => 'boolean',
        'photo'             => 'string',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'      => 'required|string|max:255',
        'email'     => 'required|string|email|max:255|unique:users,email,id_to_ignore,id',
        'password'  => 'required|string|min:6|confirmed',
        'role_name' => 'required',
        'is_active' => 'required',
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
        'readable_created_at',
        'readable_updated_at',
        'readable_email_verified_at',
        'readable_is_active',
        'readable_role_name',
        'role_name',
    ];

    // =========================================================================
    // Relationships
    // =========================================================================
    
    // TODO: Add relationships

    // =========================================================================
    // Getters
    // =========================================================================

    /**
     * Get user photo or a default photo
     *
     * @return string
     */
    public function getPhotoAttribute()
    {
        return $this->attributes['photo']?: asset("images/no_user.png");
    }

    /**
     * Get readable_created_at
     *
     * @return string
     */
    public function getReadableCreatedAtAttribute()
    {
        return Functions::formatDatetime($this->created_at);
    }

    /**
     * Get readable_updated_at
     *
     * @return string
     */
    public function getReadableUpdatedAtAttribute()
    {
        return Functions::formatDatetime($this->updated_at);
    }

    /**
     * Get readable_email_verified_at
     *
     * @return string
     */
    public function getReadableEmailVerifiedAtAttribute()
    {
        return Functions::formatDatetime($this->email_verified_at);
    }

    /**
     * Get readable_is_active
     *
     * @return string
     */
    public function getReadableIsActiveAttribute()
    {
        return Functions::formatBoolean($this->is_active);
    }

    /**
     * Get role_name
     *
     * @return string
     */
    public function getRoleNameAttribute()
    {
        return $this->roles->first()->name;
    }

    /**
     * Get readable_role_name
     *
     * @return string
     */
    public function getReadableRoleNameAttribute()
    {
        return $this->roles->first()->display_name;
    }

    // =========================================================================
    // Setters
    // =========================================================================

    /**
     * Set password
     *
     * @param string $value
     *
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $value? $this->attributes['password'] = bcrypt($value) : null;
    }

    // =========================================================================
    // Methods
    // =========================================================================

    /**
     * Check whether user photo is default or not
     *
     * @return boolean
     */
    public function isPhotoDefault()
    {
        return $this->attributes['photo']? false : true;
    }

    /**
     * Send the password reset notification
     *
     * @param  string  $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    /**
     * File upload
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('users')->singleFile();
    }
}
