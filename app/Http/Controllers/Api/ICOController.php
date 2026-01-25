<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ICOOptionHelper;
use App\Helpers\ImageHelper;
use App\Models\ICO;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ICOController extends Controller
{
    const IMAGE_DIRECTORY = 'ico';
    const IMAGE_PREFIX = 'ico';

    /**
     * ICO List API with Search & Filter
     *
     * Filters:
     * - name: Search by ICO name (partial match)
     * - stage: Filter by stage (Seed, Private, Pre-Sale, ICO, IEO, IDO, Public)
     * - ico_status: Filter by ICO status (Upcoming, Ongoing, Ended)
     * - project_category: Filter by category (Web3, DeFi, NFT, etc.)
     * - blockchain_network: Filter by network (Binance-Smart-Chain, Ethereum, etc.)
     * - per_page: Items per page (default: 10)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ico_list(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);

            $query = ICO::where('status', 'Active');

            // Search by name (partial match)
            if ($request->has('name') && !empty($request->name)) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }

            // Filter by stage
            if ($request->has('stage') && !empty($request->stage)) {
                $query->where('stage', $request->stage);
            }

            // Filter by ICO status (Upcoming, Ongoing, Ended)
            if ($request->has('ico_status') && !empty($request->ico_status)) {
                $query->where('ico_status', $request->ico_status);
            }

            // Filter by project category
            if ($request->has('project_category') && !empty($request->project_category)) {
                $query->where('project_category', $request->project_category);
            }

            // Filter by blockchain network
            if ($request->has('blockchain_network') && !empty($request->blockchain_network)) {
                $query->where('blockchain_network', $request->blockchain_network);
            }

            $icos = $query->select(
                    'id',
                    'name',
                    'slug',
                    'image',
                    'launchpad',
                    'stage',
                    'total_supply_qty',
                    'tokens_for_sale',
                    'supply_percentage',
                    'ico_price',
                    'ico_price_currency',
                    'fundraising_goal',
                    'project_category',
                    'blockchain_network',
                    'soft_cap',
                    'hard_cap',
                    'start_date',
                    'end_date',
                    'ico_status',
                    'short_description'
                )
                ->orderBy('id', 'desc')
                ->paginate($perPage);

            // Transform the collection to format data
            $icos->getCollection()->transform(function ($ico) {
                return [
                    'id' => $ico->id,
                    'name' => $ico->name,
                    'slug' => $ico->slug,
                    'image' => $ico->image ? getFullPath(self::IMAGE_DIRECTORY, $ico->image) : null,
                    'launchpad' => $ico->launchpad,
                    'stage' => $ico->stage,
                    'total_supply_qty' => $ico->total_supply_qty ? number_format($ico->total_supply_qty, 2) : null,
                    'tokens_for_sale' => $ico->tokens_for_sale ? number_format($ico->tokens_for_sale, 2) : null,
                    'supply_percentage' => $ico->supply_percentage ? number_format($ico->supply_percentage, 2) . '%' : null,
                    'ico_price' => $ico->ico_price,
                    'ico_price_currency' => $ico->ico_price_currency,
                    'ico_price_display' => $ico->ico_price ? $ico->ico_price . ' ' . $ico->ico_price_currency : null,
                    'fundraising_goal' => $ico->fundraising_goal ? number_format($ico->fundraising_goal, 2) : null,
                    'project_category' => $ico->project_category,
                    'blockchain_network' => $ico->blockchain_network,
                    'soft_cap' => $ico->soft_cap,
                    'hard_cap' => $ico->hard_cap,
                    'start_date' => $ico->start_date ? date('d-m-Y', strtotime($ico->start_date)) : 'TBA',
                    'end_date' => $ico->end_date ? date('d-m-Y', strtotime($ico->end_date)) : 'TBA',
                    'date_range' => $this->formatDateRange($ico->start_date, $ico->end_date),
                    'ico_status' => $ico->ico_status,
                    'short_description' => $ico->short_description,
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $icos,
                'filters' => [
                    'stages' => ICO::getStages(),
                    'ico_statuses' => ICO::getIcoStatuses(),
                    'categories' => ICO::getProjectCategories(),
                    'networks' => ICO::getBlockchainNetworks(),
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
     * ICO Detail API by Slug
     *
     * Returns all ICO details
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function ico_detail($slug)
    {
        try {
            $ico = ICO::where('slug', $slug)
                ->where('status', 'Active')
                ->first();

            if (!$ico) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'ICO not found'
                ], 404);
            }

            $icoData = [
                'id' => $ico->id,
                'name' => $ico->name,
                'slug' => $ico->slug,
                'image' => $ico->image ? getFullPath(self::IMAGE_DIRECTORY, $ico->image) : null,

                // Basic Info
                'launchpad' => $ico->launchpad,
                'stage' => $ico->stage,
                'project_category' => $ico->project_category,
                'ico_status' => $ico->ico_status,

                // Token Details
                'total_supply_qty' => $ico->total_supply_qty,
                'total_supply_qty_formatted' => $ico->total_supply_qty ? number_format($ico->total_supply_qty, 2) : null,
                'tokens_for_sale' => $ico->tokens_for_sale,
                'tokens_for_sale_formatted' => $ico->tokens_for_sale ? number_format($ico->tokens_for_sale, 2) : null,
                'supply_percentage' => $ico->supply_percentage,
                'supply_percentage_formatted' => $ico->supply_percentage ? number_format($ico->supply_percentage, 2) . '%' : null,
                'ico_price' => $ico->ico_price,
                'ico_price_currency' => $ico->ico_price_currency,
                'ico_price_display' => $ico->ico_price ? $ico->ico_price . ' ' . $ico->ico_price_currency : null,
                'one_usdt_value' => $ico->one_usdt_value ?? 'TBA',

                // Sale Details
                'fundraising_goal' => $ico->fundraising_goal,
                'fundraising_goal_formatted' => $ico->fundraising_goal ? number_format($ico->fundraising_goal, 2) : null,
                'soft_cap' => $ico->soft_cap ?? 'TBA',
                'hard_cap' => $ico->hard_cap ?? 'TBA',
                'personal_cap' => $ico->personal_cap ?? 'TBA',
                'buy_link' => $ico->buy_link,

                // Blockchain Details
                'blockchain_network' => $ico->blockchain_network,
                'contract_address' => $ico->contract_address,

                // Dates
                'start_date' => $ico->start_date ? date('d-m-Y', strtotime($ico->start_date)) : 'TBA',
                'end_date' => $ico->end_date ? date('d-m-Y', strtotime($ico->end_date)) : 'TBA',
                'date_range' => $this->formatDateRange($ico->start_date, $ico->end_date),

                // Links
                'website_url' => $ico->website_url,
                'whitepaper_url' => $ico->whitepaper_url,
                'twitter_url' => $ico->twitter_url,
                'telegram_url' => $ico->telegram_url,
                'discord_url' => $ico->discord_url,

                // Description
                'short_description' => $ico->short_description,
                'description' => $ico->description,

                // SEO
                'meta_title' => $ico->meta_title,
                'meta_description' => $ico->meta_description,
                'meta_keyword' => $ico->meta_keyword,
                'canonical' => $ico->canonical,

                // Timestamps
                'created_at' => $ico->created_at ? $ico->created_at->format('d-m-Y H:i:s') : null,
                'updated_at' => $ico->updated_at ? $ico->updated_at->format('d-m-Y H:i:s') : null,
            ];

            return response()->json([
                'status' => 'success',
                'data' => $icoData,
                'message' => 'ICO details fetched successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create ICO API (Frontend/Guest User)
     *
     * Allows guest users to submit ICO listing request
     * Default status: Inactive (Admin will activate from backend)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create_ico(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:icos,name',
                'launchpad' => 'nullable|string|max:255',
                'stage' => 'nullable|string|max:100',
                'total_supply_qty' => 'nullable|numeric|min:0',
                'tokens_for_sale' => 'nullable|numeric|min:0',
                'supply_percentage' => 'nullable|numeric|min:0|max:100',
                'ico_price' => 'nullable|numeric|min:0',
                'ico_price_currency' => 'nullable|string|max:20',
                'one_usdt_value' => 'nullable|string|max:100',
                'fundraising_goal' => 'nullable|numeric|min:0',
                'project_category' => 'nullable|string|max:100',
                'contract_address' => 'nullable|string|max:255',
                'blockchain_network' => 'nullable|string|max:100',
                'buy_link' => 'nullable|url|max:500',
                'soft_cap' => 'nullable|string|max:100',
                'hard_cap' => 'nullable|string|max:100',
                'personal_cap' => 'nullable|string|max:100',
                'start_date' => 'nullable|date_format:d-m-Y',
                'end_date' => 'nullable|date_format:d-m-Y|after_or_equal:start_date',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                'description' => 'nullable|string',
                'short_description' => 'nullable|string|max:500',
                'website_url' => 'nullable|url|max:500',
                'whitepaper_url' => 'nullable|url|max:500',
                'twitter_url' => 'nullable|url|max:500',
                'telegram_url' => 'nullable|url|max:500',
                'discord_url' => 'nullable|url|max:500',
                'ico_status' => 'nullable|in:Upcoming,Ongoing,Ended',
            ]);

            $ico = new ICO();
            $ico->name = $request->name;
            $ico->slug = Str::slug($request->name);
            $ico->launchpad = $request->launchpad;
            
            // Handle stage - auto-add if new
            $stage = $request->stage;
            if ($stage && !ICOOptionHelper::stageExists($stage)) {
                ICOOptionHelper::addStage($stage);
            }
            $ico->stage = $stage;
            
            $ico->total_supply_qty = $request->total_supply_qty;
            $ico->tokens_for_sale = $request->tokens_for_sale;
            $ico->supply_percentage = $request->supply_percentage;
            $ico->ico_price = $request->ico_price;
            $ico->ico_price_currency = $request->ico_price_currency ?? 'USDT';
            $ico->one_usdt_value = $request->one_usdt_value;
            $ico->fundraising_goal = $request->fundraising_goal;
            
            // Handle project_category - auto-add if new
            $projectCategory = $request->project_category;
            if ($projectCategory && !ICOOptionHelper::projectCategoryExists($projectCategory)) {
                ICOOptionHelper::addProjectCategory($projectCategory);
            }
            $ico->project_category = $projectCategory;
            
            $ico->contract_address = $request->contract_address;
            
            // Handle blockchain_network - auto-add if new
            $blockchainNetwork = $request->blockchain_network;
            if ($blockchainNetwork && !ICOOptionHelper::blockchainNetworkExists($blockchainNetwork)) {
                ICOOptionHelper::addBlockchainNetwork($blockchainNetwork);
            }
            $ico->blockchain_network = $blockchainNetwork;
            $ico->buy_link = $request->buy_link;
            $ico->soft_cap = $request->soft_cap;
            $ico->hard_cap = $request->hard_cap;
            $ico->personal_cap = $request->personal_cap;

            // Handle dates (convert DD-MM-YYYY to YYYY-MM-DD)
            if ($request->start_date) {
                $startDate = \DateTime::createFromFormat('d-m-Y', $request->start_date);
                $ico->start_date = $startDate ? $startDate->format('Y-m-d') : null;
            }
            if ($request->end_date) {
                $endDate = \DateTime::createFromFormat('d-m-Y', $request->end_date);
                $ico->end_date = $endDate ? $endDate->format('Y-m-d') : null;
            }

            $ico->description = $request->description;
            $ico->short_description = $request->short_description;
            $ico->website_url = $request->website_url;
            $ico->whitepaper_url = $request->whitepaper_url;
            $ico->twitter_url = $request->twitter_url;
            $ico->telegram_url = $request->telegram_url;
            $ico->discord_url = $request->discord_url;
            $ico->ico_status = $request->ico_status ?? 'Upcoming';

            // Default status is INACTIVE - Admin will activate from backend
            $ico->status = 'Inactive';

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ico->image = ImageHelper::uploadImage($file, self::IMAGE_DIRECTORY, self::IMAGE_PREFIX);
            }

            $ico->save();

            return response()->json([
                'status' => 'success',
                'message' => 'ICO submitted successfully. It will be reviewed and activated by admin.',
                'data' => [
                    'id' => $ico->id,
                    'name' => $ico->name,
                    'slug' => $ico->slug,
                    'status' => $ico->status,
                    'ico_status' => $ico->ico_status,
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

