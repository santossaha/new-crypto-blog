<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirDrops extends Model
{
    use HasFactory;

    protected $table = "air_drops";
    // protected $fillable = [
    // 'type', 'name', 'coin_token_symbol', 'start_date', 'end_date',
    //  'end_date', 'winner_announcement_date', 'coin_token_image', 'coin_token_qty',
    //  'total_airdrop_qty', 'no_of_winners', 'project_website', 'email', 'description_of_project',
    //  'task_details', 'project_based_on', 'country', 'tast_link', 'facebook_link', 'facebook_url',
    //  'twitter_url', 'instagram_url', 'reddit_url', 'medium_url', 'telegram_url', 'discord_url',
    //  'contract_address', 'contact', 'contact_id', 'aprove_status', 'upvote', 'airdrop_status'
    // ];
    public $timestamps = true;
}
