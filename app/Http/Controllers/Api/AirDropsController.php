<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AirDrop;
use App\Helpers\ImageHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AirDropsController extends Controller
{
    const IMAGE_DIRECTORY = 'airdrop';
    const IMAGE_PREFIX = 'airdrop';

    /**
     * Airdrop List API with Search & Filter
     *
     * Filters:
     * - name: Search by airdrop name (partial match)
     * - airdrop_status: Filter by status (Upcoming, Ongoing, Ended)
     * - project_category: Filter by category (Web3, DeFi, NFT, etc.)
     * - blockchain_network: Filter by network (Binance-Smart-Chain, Ethereum, etc.)
     * - per_page: Items per page (default: 10)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function airdrop_list(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);

            $query = AirDrop::where('status', 'Active');

            // Search by name (partial match)
            if ($request->has('name') && !empty($request->name)) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }

            // Filter by airdrop status (Upcoming, Ongoing, Ended)
            if ($request->has('airdrop_status') && !empty($request->airdrop_status)) {
                $query->where('airdrop_status', $request->airdrop_status);
            }

            // Filter by project category
            if ($request->has('project_category') && !empty($request->project_category)) {
                $query->where('project_category', $request->project_category);
            }

            // Filter by blockchain network
            if ($request->has('blockchain_network') && !empty($request->blockchain_network)) {
                $query->where('blockchain_network', $request->blockchain_network);
            }

            $airdrops = $query->select(
                    'id',
                    'name',
                    'slug',
                    'image',
                    'platform',
                    'total_supply',
                    'total_airdrop_qty',
                    'airdrop_value',
                    'supply_percentage',
                    'winner_count',
                    'project_category',
                    'blockchain_network',
                    'start_date',
                    'end_date',
                    'winner_announcement_date',
                    'airdrop_status'
                )
                ->orderBy('id', 'desc')
                ->paginate($perPage);

            // Transform the collection to format data
            $airdrops->getCollection()->transform(function ($airdrop) {
                return [
                    'id' => $airdrop->id,
                    'name' => $airdrop->name,
                    'slug' => $airdrop->slug,
                    'image' => $airdrop->image ? getFullPath(self::IMAGE_DIRECTORY, $airdrop->image) : null,
                    'platform' => $airdrop->platform,
                    'total_supply' => $airdrop->total_supply ? number_format($airdrop->total_supply, 2) : null,
                    'total_airdrop_qty' => $airdrop->total_airdrop_qty ? number_format($airdrop->total_airdrop_qty, 2) : null,
                    'airdrop_value' => $airdrop->airdrop_value,
                    'supply_percentage' => $airdrop->supply_percentage ? number_format($airdrop->supply_percentage, 2) . '%' : null,
                    'winner_count' => $airdrop->winner_count,
                    'project_category' => $airdrop->project_category,
                    'blockchain_network' => $airdrop->blockchain_network,
                    'start_date' => $airdrop->start_date ? date('d-m-Y', strtotime($airdrop->start_date)) : 'TBA',
                    'end_date' => $airdrop->end_date ? date('d-m-Y', strtotime($airdrop->end_date)) : 'TBA',
                    'date_range' => $this->formatDateRange($airdrop->start_date, $airdrop->end_date),
                    'airdrop_status' => $airdrop->airdrop_status,
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $airdrops,
                'filters' => [
                    'airdrop_statuses' => ['Upcoming', 'Ongoing', 'Ended'],
                    'categories' => AirDrop::getProjectCategories(),
                    'networks' => AirDrop::getBlockchainNetworks(),
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Airdrop Detail API by Slug
     *
     * Returns all airdrop details
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function airdrop_detail($slug)
    {
        try {
            $airdrop = AirDrop::where('slug', $slug)
                ->where('status', 'Active')
                ->first();

            if (!$airdrop) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Airdrop not found'
                ], 404);
            }

            $airdropData = [
                'id' => $airdrop->id,
                'name' => $airdrop->name,
                'slug' => $airdrop->slug,
                'image' => $airdrop->image ? getFullPath(self::IMAGE_DIRECTORY, $airdrop->image) : null,

                // Basic Info
                'platform' => $airdrop->platform,
                'project_category' => $airdrop->project_category,
                'airdrop_status' => $airdrop->airdrop_status,

                // Supply Details
                'total_supply' => $airdrop->total_supply,
                'total_supply_formatted' => $airdrop->total_supply ? number_format($airdrop->total_supply, 2) : null,
                'total_airdrop_qty' => $airdrop->total_airdrop_qty,
                'total_airdrop_qty_formatted' => $airdrop->total_airdrop_qty ? number_format($airdrop->total_airdrop_qty, 2) : null,
                'supply_percentage' => $airdrop->supply_percentage,
                'supply_percentage_formatted' => $airdrop->supply_percentage ? number_format($airdrop->supply_percentage, 2) . '%' : null,
                'airdrop_value' => $airdrop->airdrop_value,

                // Winner Details
                'winner_count' => $airdrop->winner_count,
                'winner_announcement_date' => $airdrop->winner_announcement_date ? date('d-m-Y', strtotime($airdrop->winner_announcement_date)) : 'TBA',

                // Blockchain Details
                'blockchain_network' => $airdrop->blockchain_network,

                // Dates
                'start_date' => $airdrop->start_date ? date('d-m-Y', strtotime($airdrop->start_date)) : 'TBA',
                'end_date' => $airdrop->end_date ? date('d-m-Y', strtotime($airdrop->end_date)) : 'TBA',
                'date_range' => $this->formatDateRange($airdrop->start_date, $airdrop->end_date),

                // Links
                'participate_link' => $airdrop->participate_link,
                'website_url' => $airdrop->website_url,
                'whitepaper_url' => $airdrop->whitepaper_url,
                'twitter_url' => $airdrop->twitter_url,
                'telegram_url' => $airdrop->telegram_url,
                'discord_url' => $airdrop->discord_url,

                // Description
                'description' => $airdrop->description,
                'how_to_participate' => $airdrop->how_to_participate,

                // SEO
                'meta_title' => $airdrop->meta_title,
                'meta_description' => $airdrop->meta_description,
                'meta_keyword' => $airdrop->meta_keyword,
                'canonical' => $airdrop->canonical,

                // Timestamps
                'created_at' => $airdrop->created_at ? $airdrop->created_at->format('d-m-Y H:i:s') : null,
                'updated_at' => $airdrop->updated_at ? $airdrop->updated_at->format('d-m-Y H:i:s') : null,
            ];

            return response()->json([
                'status' => 'success',
                'data' => $airdropData,
                'message' => 'Airdrop details fetched successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create Airdrop API (Frontend/Guest User)
     *
     * Allows guest users to submit airdrop listing request
     * Default status: Inactive (Admin will activate from backend)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create_airdrop(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:air_drops,name',
                'platform' => 'nullable|string|max:255',
                'total_supply' => 'nullable|numeric|min:0',
                'total_airdrop_qty' => 'nullable|numeric|min:0',
                'airdrop_value' => 'nullable|numeric|min:0',
                'supply_percentage' => 'nullable|numeric|min:0|max:100',
                'winner_count' => 'nullable|integer|min:0',
                'project_category' => 'nullable|string|max:100',
                'blockchain_network' => 'nullable|string|max:100',
                'start_date' => 'nullable|date_format:d-m-Y',
                'end_date' => 'nullable|date_format:d-m-Y|after_or_equal:start_date',
                'winner_announcement_date' => 'nullable|date_format:d-m-Y',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                'description' => 'nullable|string',
                'how_to_participate' => 'nullable|string',
                'participate_link' => 'nullable|url|max:500',
                'website_url' => 'nullable|url|max:500',
                'whitepaper_url' => 'nullable|url|max:500',
                'twitter_url' => 'nullable|url|max:500',
                'telegram_url' => 'nullable|url|max:500',
                'discord_url' => 'nullable|url|max:500',
                'airdrop_status' => 'nullable|in:Upcoming,Ongoing,Ended',
            ]);

            $airdrop = new AirDrop();
            $airdrop->name = $request->name;
            $airdrop->slug = Str::slug($request->name);
            $airdrop->platform = $request->platform;

            $airdrop->total_supply = $request->total_supply;
            $airdrop->total_airdrop_qty = $request->total_airdrop_qty;
            $airdrop->airdrop_value = $request->airdrop_value;
            $airdrop->supply_percentage = $request->supply_percentage;
            $airdrop->winner_count = $request->winner_count;

            $airdrop->project_category = $request->project_category;
            $airdrop->blockchain_network = $request->blockchain_network;

            // Handle dates (convert DD-MM-YYYY to YYYY-MM-DD)
            if ($request->start_date) {
                $startDate = \DateTime::createFromFormat('d-m-Y', $request->start_date);
                $airdrop->start_date = $startDate ? $startDate->format('Y-m-d') : null;
            }
            if ($request->end_date) {
                $endDate = \DateTime::createFromFormat('d-m-Y', $request->end_date);
                $airdrop->end_date = $endDate ? $endDate->format('Y-m-d') : null;
            }
            if ($request->winner_announcement_date) {
                $winnerDate = \DateTime::createFromFormat('d-m-Y', $request->winner_announcement_date);
                $airdrop->winner_announcement_date = $winnerDate ? $winnerDate->format('Y-m-d') : null;
            }

            $airdrop->description = $request->description;
            $airdrop->how_to_participate = $request->how_to_participate;
            $airdrop->participate_link = $request->participate_link;
            $airdrop->website_url = $request->website_url;
            $airdrop->whitepaper_url = $request->whitepaper_url;
            $airdrop->twitter_url = $request->twitter_url;
            $airdrop->telegram_url = $request->telegram_url;
            $airdrop->discord_url = $request->discord_url;
            $airdrop->airdrop_status = $request->airdrop_status ?? 'Upcoming';

            // Default status is INACTIVE - Admin will activate from backend
            $airdrop->status = 'Inactive';

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $airdrop->image = ImageHelper::uploadImage($file, self::IMAGE_DIRECTORY, self::IMAGE_PREFIX);
            }

            $airdrop->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Airdrop submitted successfully. It will be reviewed and activated by admin.',
                'data' => [
                    'id' => $airdrop->id,
                    'name' => $airdrop->name,
                    'slug' => $airdrop->slug,
                    'status' => $airdrop->status,
                    'airdrop_status' => $airdrop->airdrop_status,
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Airdrop Filters Data
     *
     * Returns statuses, categories, and networks
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_airdrop_filters()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'airdrop_statuses' => ['Upcoming', 'Ongoing', 'Ended'],
                    'categories' => AirDrop::getProjectCategories(),
                    'networks' => AirDrop::getBlockchainNetworks(),
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Format date range for display
     *
     * @param string|null $startDate
     * @param string|null $endDate
     * @return string
     */
    private function formatDateRange($startDate, $endDate)
    {
        if (!$startDate && !$endDate) {
            return 'TBA';
        }

        $start = $startDate ? date('d-m-Y', strtotime($startDate)) : 'TBA';
        $end = $endDate ? date('d-m-Y', strtotime($endDate)) : 'TBA';

        return $start . ' to ' . $end;
    }
}
