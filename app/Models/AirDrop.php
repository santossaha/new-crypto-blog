<?php

namespace App\Models;

use App\Helpers\ICOOptionHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirDrop extends Model
{
    use HasFactory;

    protected $table = "air_drops";

    const STATUS_UPCOMING = 'Upcoming';
    const STATUS_ONGOING = 'Ongoing';
    const STATUS_ENDED = 'Ended';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'platform',
        'participate_link',
        'total_supply',
        'total_airdrop_qty',
        'airdrop_value',
        'supply_percentage',
        'winner_count',
        'winner_announcement_date',
        'start_date',
        'end_date',
        'project_category',
        'blockchain_network',
        'description',
        'how_to_participate',
        'website_url',
        'twitter_url',
        'telegram_url',
        'discord_url',
        'whitepaper_url',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'canonical',
        'status',
        'airdrop_status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'winner_announcement_date' => 'date',
        'total_supply' => 'decimal:2',
        'total_airdrop_qty' => 'decimal:2',
        'airdrop_value' => 'decimal:2',
        'supply_percentage' => 'decimal:2',
    ];

    /**
     * Get the Airdrop status based on dates
     */
    public function getComputedStatusAttribute()
    {
        $now = now();

        if ($this->start_date && $this->end_date) {
            if ($now->lt($this->start_date)) {
                return self::STATUS_UPCOMING;
            } elseif ($now->gt($this->end_date)) {
                return self::STATUS_ENDED;
            } else {
                return self::STATUS_ONGOING;
            }
        }

        return $this->airdrop_status ?? self::STATUS_UPCOMING;
    }

    /**
     * Get available blockchain networks
     * Reusing ICO helpers as they share the same backend data
     */
    public static function getBlockchainNetworks()  
    {
        return ICOOptionHelper::getBlockchainNetworks();
    }

    /**
     * Get available project categories
     * Reusing ICO helpers as they share the same backend data
     */
    public static function getProjectCategories()
    {
        return ICOOptionHelper::getProjectCategories();
    }
}
