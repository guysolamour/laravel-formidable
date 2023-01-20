<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Guysolamour\Administrable\Traits\ModelTrait;
use Guysolamour\Administrable\Traits\CommenterTrait;
use Guysolamour\Administrable\Traits\MediaableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Guysolamour\Administrable\Traits\CustomFieldsTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $pseudo
 * @property string|null $phone_number
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property array|null $custom_fields
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Guysolamour\Administrable\Models\Comment[] $approvedComments
 * @property-read int|null $approved_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Guysolamour\Administrable\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read string $avatar
 * @property-read mixed $back_image
 * @property-read string $form_name
 * @property-read string $formated_date
 * @property-read mixed $front_image
 * @property-read mixed $image
 * @property-read mixed $images
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Guysolamour\Administrable\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCustomFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePseudo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use ModelTrait;
    use HasFactory;
    use Notifiable;
    use CommenterTrait;
    use MediaableTrait;
    use CustomFieldsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo', 'name', 'email', 'password', 'phone_number', 'custom_fields'
    ];

    public $form = \Guysolamour\Administrable\Forms\Back\UserForm::class;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public $custom_form_fields = [
        ['name' => 'notify_via_whatsapp', 'type' => 'boolean',  'label' => 'Notification par whatsapp'],
        ['name' => 'cb_whatsapp_apikey',  'type' => 'text',     'label' => 'Clé API notification whatsapp'],
        ['name' => 'cb_whatsapp_number',  'type' => 'text',     'label' => 'Numéro whatsapp notification whatsapp'],
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
        'custom_fields'     => 'json',
    ];

    public function getAvatarAttribute() :string
    {
        if ($avatar = $this->getFrontImageUrl()){
            return $avatar;
        }

        return Gravatar::get($this->attributes['email']);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }



    // add relation methods below
}
