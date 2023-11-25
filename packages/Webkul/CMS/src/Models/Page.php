<?php

namespace Webkul\CMS\Models;

use Webkul\CMS\Contracts\Page as PageContract;
use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\Core\Models\ChannelProxy;

class Page extends TranslatableModel implements PageContract
{
    /**
     * Table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_pages';

    /**
     * Translation model foreign key column
     *
     * @var string
     */
    protected $translationForeignKey = 'cms_page_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['layout'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'content',
        'meta_description',
        'meta_title',
        'page_title',
        'meta_keywords',
        'html_content',
        'url_key',
    ];

    /**
     * With the translations given attributes
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * Get the channels.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany;
     */
    public function channels()
    {
        return $this->belongsToMany(ChannelProxy::modelClass(), 'cms_page_channels', 'cms_page_id');
    }
}
