<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Creativeorange\Gravatar\Facades\Gravatar;
use Guysolamour\Administrable\Traits\ModelTrait;
use Guysolamour\Administrable\Traits\CommenterTrait;
use Guysolamour\Administrable\Traits\MediaableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Guysolamour\Administrable\Notifications\Back\Auth\VerifyEmail;
use Guysolamour\Administrable\Notifications\Back\Auth\ResetPassword;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $pseudo
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $avatar
 * @property string $password
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $linkedin
 * @property string|null $phone_number
 * @property string|null $website
 * @property mixed|null $custom_fields
 * @property string|null $about
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Guysolamour\Administrable\Models\Comment[] $approvedComments
 * @property-read int|null $approved_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Guysolamour\Administrable\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $back_image
 * @property-read string $form_name
 * @property-read string $formated_date
 * @property-read mixed $front_image
 * @property-read string $full_name
 * @property-read mixed $image
 * @property-read mixed $images
 * @property-read string $name
 * @property-read string|null $role
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Guysolamour\Administrable\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\AdminFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCustomFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePseudo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereWebsite($value)
 * @mixin \Eloquent
 */
class Admin extends Authenticatable implements HasMedia
{
    use HasRoles;
    use HasFactory;
    use Notifiable;
    use ModelTrait;
    use MediaableTrait;
    use CommenterTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo', 'first_name', 'last_name', 'email', 'password','avatar',
        'facebook', 'twitter','linkedin','phone_number','website','about'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Get the admin's full name.
     *
     * @return string
     */
    public function getFullNameAttribute() :string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the admin's name.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return "{$this->first_name} " . strtoupper($this->last_name);
    }


    /**
     * Get the admin's role.
     *
     * @return string|null
     */
    public function getRoleAttribute() :?string
    {
        return $this->roles->first()?->name;
    }

    /**
     * Get the admin's avatar.
     *
     * @return string
     */
    public function getAvatarAttribute() :string
    {
        return $this->getFrontImageUrl();
    }



    /**
     * Set the avatar with gravatar service before saving and updating
     *
     * @param  mixed $value
     *
     * @return void
     */
    public function setAvatarAttribute($value)
    {
        $this->attributes['avatar'] = is_null($value) ? Gravatar::get($this->attributes['email']) : $value;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function getRouteKeyName()
    {
      return 'pseudo';
    }


    // add relation methods below

}
