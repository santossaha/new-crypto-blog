<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ICO extends Model
{
    use HasFactory;

    protected $table = "icos";

    public $timestamps = true;

    const STATUS_UPCOMING = 'Upcoming';
    const STATUS_ONGOING = 'Ongoing';
    const STATUS_ENDED = 'Ended';
    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    protected $fillable = [
        'name',
        'slug',
        'launchpad',
        'stage',
        'total_supply_qty',
        'tokens_for_sale',
        'supply_percentage',
        'ico_price',
        'ico_price_currency',
        'one_usdt_value',
        'fundraising_goal',
        'project_category',
        'contract_address',
        'blockchain_network',
        'buy_link',
        'soft_cap',
        'hard_cap',
        'personal_cap',
        'start_date',
        'end_date',
        'image',
        'description',
        'short_description',
        'website_url',
        'whitepaper_url',
        'twitter_url',
        'telegram_url',
        'discord_url',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'canonical',
        'ico_status',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_supply_qty' => 'decimal:2',
        'tokens_for_sale' => 'decimal:2',
        'supply_percentage' => 'decimal:2',
        'ico_price' => 'decimal:6',
        'fundraising_goal' => 'decimal:2',
    ];

    /**
     * Get the ICO status based on dates
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

        return $this->ico_status ?? self::STATUS_UPCOMING;
    }

    /**
     * Get available ICO statuses
     */
    public static function getIcoStatuses()
    {
        return [
            self::STATUS_UPCOMING => 'Upcoming',
            self::STATUS_ONGOING => 'Ongoing',
            self::STATUS_ENDED => 'Ended',
        ];
    }

    /**
     * Get available blockchain networks
     */
    public static function getBlockchainNetworks()
    {
        return [
            'Binance-Smart-Chain' => 'Binance Smart Chain',
            'Ethereum' => 'Ethereum',
            'Polygon' => 'Polygon',
            'Solana' => 'Solana',
            'Avalanche' => 'Avalanche',
            'Arbitrum' => 'Arbitrum',
            'Base' => 'Base',
            'TON' => 'TON Network',
            'Cardano' => 'Cardano',
            'Other' => 'Other',
        ];
    }

    /**
     * Get available project categories
     */
    public static function getProjectCategories()
    {
        return [
            'Web3' => 'Web3',
            'DeFi' => 'DeFi',
            'NFT' => 'NFT',
            'Gaming' => 'Gaming',
            'Metaverse' => 'Metaverse',
            'AI' => 'AI',
            'Infrastructure' => 'Infrastructure',
            'Layer1' => 'Layer 1',
            'Layer2' => 'Layer 2',
            'DEX' => 'DEX',
            'DAO' => 'DAO',
            'SocialFi' => 'SocialFi',
            'Other' => 'Other',
        ];
    }

    /**
     * Get available stages
     */
    public static function getStages()
    {
        return [
            'Seed' => 'Seed',
            'Private' => 'Private Sale',
            'Pre-Sale' => 'Pre-Sale',
            'ICO' => 'ICO',
            'IEO' => 'IEO',
            'IDO' => 'IDO',
            'Public' => 'Public Sale',
        ];
    }
}

