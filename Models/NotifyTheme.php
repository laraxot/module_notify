<?php

declare(strict_types=1);

namespace Modules\Notify\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Modules\Notify\Models\NotifyTheme.
 *
 * @property int                             $id
 * @property string|null                     $lang
 * @property string|null                     $type
 * @property string|null                     $subject
 * @property string|null                     $body
 * @property string|null                     $from
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $post_type
 * @property int|null                        $post_id
 * @property string|null                     $body_html
 * @property string|null                     $theme
 * @property string|null                     $from_email
 * @property string|null                     $logo_src
 * @property int|null                        $logo_width
 * @property int|null                        $logo_height
 * @property array                           $logo
 * @method static \Modules\Notify\Database\Factories\NotifyThemeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereBodyHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereFromEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereLogoHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereLogoSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereLogoWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotifyTheme     whereUpdatedBy($value)
 * @mixin IdeHelperNotifyTheme
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $linkable
 * @mixin \Eloquent
 */
class NotifyTheme extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'lang',
        'type',
        'subject',
        'body',
        'body_html',
        'from',
        'from_email',
        'post_type',
        'post_id',
        'theme',
        'logo_src',
        'logo_width',
        'logo_height',
        'view_params',
    ];

    protected $appends = [
        'logo',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        // 'published_at' => 'datetime:Y-m-d', // da verificare
        'view_params' => 'array',
    ];

    public function getLogoAttribute(?array $value): array
    {
        return [
            // 'path' => asset(strval($this->logo_src)),
            'path' => url($this->getFirstMediaUrl()),
            'width' => $this->logo_width ?? 50,
            'height' => $this->logo_height ?? 50,
        ];
    }

    /**
     * Get the parent linkable model (user or post).
     */
    public function linkable(): MorphTo
    {
        return $this->morphTo('post');
    }
}
