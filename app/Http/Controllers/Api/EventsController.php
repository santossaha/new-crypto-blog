<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventsResource;
use App\Models\EventsModel;
use App\Helpers\ImageHelper;
use Exception;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    //get all active Events
    public function get_events()
    {
        try {
            $events = EventsModel::where('status', 'Active')
            ->where('from_date', '<=', date('Y-m-d'))
            ->where('to_date', '>=', date('Y-m-d'))
            ->select('id','image', 'title', 'slug', 'location', 'from_date', 'to_date', 'start_time', 'to_time')->orderBy('id', 'desc')->paginate(10);
            $events->getCollection()->transform(function ($event) {
                if($event->from_date){
                    $event->from_date = defaultDate($event->from_date);
                }
                if($event->to_date){
                    $event->to_date = defaultDate($event->to_date);
                }
                if($event->image){
                    $event->image = getFullPath('event', $event->image);
                }
                return $event;
            });
            return response()->json(['status' => 'sucess', 'data' => $events]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

	public function search_events(Request $request)
	{
		try {
			$title = $request->get('title');
			$event_type = $request->get('event_type');
			$events = EventsModel::orderBy('id', 'desc')->where('title', 'LIKE', "%{$title}%")
    ->where('event_type', $event_type)->get();
			$getEvents = EventsResource::collection($events);
			return response()->json(['status' => 'sucess', $getEvents]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Event List API with Pagination
	 * Returns: id, image, title, content, from_date, to_date, location, author
	 */
	public function event_list(Request $request)
	{
		try {
			$perPage = $request->get('per_page', 10); // Default 10 items per page

			$events = EventsModel::select('id', 'image', 'title', 'content', 'from_date', 'to_date', 'location', 'author')
                ->where('status', 'Active')
                ->where('from_date', '<=', date('Y-m-d'))
                ->where('to_date', '>=', date('Y-m-d'))
				->orderBy('id', 'desc')
				->paginate($perPage);

			// Transform the collection to format dates and image URL
			$events->getCollection()->transform(function ($event) {
				return [
					'id' => $event->id,
					'image' => $event->image ? getFullPath('event', $event->image) : null,
					'title' => $event->title,
					'content' => $event->content,
					'from_date' => $event->from_date ? date('d-m-Y', strtotime($event->from_date)) : null,
					'to_date' => $event->to_date ? date('d-m-Y', strtotime($event->to_date)) : null,
					'location' => $event->location,
					'author' => $event->author,
				];
			});

			// Return Laravel's default pagination response
			return response()->json([
				'status' => 'success',
				'data' => $events
			]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Event Detail API
	 * Returns all event parameters
	 */
	public function event_detail($id)
	{
		try {
			$event = EventsModel::with('galleries')->find($id);

			if (!$event) {
				return response()->json([
					'status' => 'error',
					'message' => 'Event not found'
				], 404);
			}

			// Format gallery images
			$galleryImages = $event->galleries->map(function ($gallery) {
				return [
					'id' => $gallery->id,
					'image' => $gallery->image ? getFullPath('event/gallery', $gallery->image) : null,
					'sort_order' => $gallery->sort_order,
				];
			});

			$eventData = [
				'id' => $event->id,
				'user_id' => $event->user_id,
				'title' => $event->title,
				'slug' => $event->slug,
				'content' => $event->content,
				'image' => $event->image ? getFullPath('event', $event->image) : null,
				'from_date' => $event->from_date ? date('d-m-Y', strtotime($event->from_date)) : null,
				'to_date' => $event->to_date ? date('d-m-Y', strtotime($event->to_date)) : null,
				'start_date' => $event->start_date ? date('d-m-Y', strtotime($event->start_date)) : null,
				'end_date' => $event->end_date ? date('d-m-Y', strtotime($event->end_date)) : null,
				'start_time' => $event->start_time,
				'to_time' => $event->to_time,
				'location' => $event->location,
				'contact_detail' => $event->contact_detail,
				'email' => $event->email,
				'website_url' => $event->website_url,
				'facebook' => $event->facebook,
				'instagram' => $event->instagram,
				'linkedin' => $event->linkedin,
				'description' => $event->description,
				'short_description' => $event->short_description,
				'meta_title' => $event->meta_title,
				'meta_description' => $event->meta_description,
				'meta_keyword' => $event->meta_keyword,
				'canonical' => $event->canonical,
				'author' => $event->author,
				'status' => $event->status,
				'gallery_images' => $galleryImages,
				'created_at' => $event->created_at ? $event->created_at->format('d-m-Y H:i:s') : null,
				'updated_at' => $event->updated_at ? $event->updated_at->format('d-m-Y H:i:s') : null,
			];

			return response()->json([
				'status' => 'success',
				'data' => $eventData
			]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}

    public function event_detail_by_slug($slug)
    {
    
        try {
            $event = EventsModel::with('galleries')->where('slug', $slug)->first();

			if (!$event) {
				return response()->json([
					'status' => 'error',
					'message' => 'Event not found'
				], 404);
			}

            $galleryImages = $event->galleries->map(function ($gallery) {
				return [
					'id' => $gallery->id,
					'image' => $gallery->image ? getFullPath('event/gallery', $gallery->image) : null,
					'sort_order' => $gallery->sort_order,
				];
			});

            $eventData = [
                'id' => $event->id,
                'user_id' => $event->user_id,
                'title' => $event->title,
                'slug' => $event->slug,
                'content' => $event->content,
                'image' => $event->image ? getFullPath('event', $event->image) : null,
                'from_date' => defaultDate($event->from_date),
                'to_date' => defaultDate($event->to_date),
                'start_time' => $event->start_time,
                'to_time' => $event->to_time,
                'location' => $event->location,
                'contact_detail' => $event->contact_detail,
                'email' => $event->email,
                'website_url' => $event->website_url,
                'facebook' => $event->facebook,
                'instagram' => $event->instagram,
                'linkedin' => $event->linkedin,
                'description' => $event->description,
                'short_description' => $event->short_description,
                'meta_title' => $event->meta_title,
                'meta_description' => $event->meta_description,
                'meta_keyword' => $event->meta_keyword,
                'canonical' => $event->canonical,
                'author' => $event->author,
                'status' => $event->status,
                'gallery_images' => $galleryImages,
                'created_at' => $event->created_at ? $event->created_at->format('d-m-Y H:i:s') : null,
                'updated_at' => $event->updated_at ? $event->updated_at->format('d-m-Y H:i:s') : null,
            ];

            return response()->json([
				'status' => 'success',
				'data' => $eventData,
				'message' => 'Event fetched successfully'
			]);

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

	/**
	 * Create Event API
	 * Default status: Inactive
	 */
	public function create_event(Request $request)
	{
		try {
			$request->validate([
				'title' => 'required|string|max:255',
				'content' => 'required|string',
				'from_date' => 'required|date_format:d-m-Y',
				'to_date' => 'required|date_format:d-m-Y|after_or_equal:from_date',
				'location' => 'required|string|max:255',
				'author' => 'nullable|string|max:255',
				'start_time' => 'nullable|date_format:H:i',
				'to_time' => 'nullable|date_format:H:i',
				'contact_detail' => 'nullable|string|max:255',
				'email' => 'nullable|email|max:255',
				'website_url' => 'nullable|url|max:255',
				'facebook' => 'nullable|url|max:255',
				'instagram' => 'nullable|url|max:255',
				'linkedin' => 'nullable|url|max:255',
				'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:4096',
				'short_description' => 'nullable|string',
				'description' => 'nullable|string',
				'meta_title' => 'nullable|string|max:255',
				'meta_description' => 'nullable|string',
				'meta_keyword' => 'nullable|string|max:255',
				'canonical' => 'nullable|url|max:255',
			]);

			// Convert date format from DD-MM-YYYY to YYYY-MM-DD
			$fromDate = \DateTime::createFromFormat('d-m-Y', $request->from_date);
			$toDate = \DateTime::createFromFormat('d-m-Y', $request->to_date);

			$event = new EventsModel();
			$event->user_id = $request->user_id ?? 1; // Default user_id if not provided
			$event->title = $request->title;
			$event->slug = \Illuminate\Support\Str::slug($request->title);
			$event->content = $request->content;
			$event->from_date = $fromDate ? $fromDate->format('Y-m-d') : null;
			$event->to_date = $toDate ? $toDate->format('Y-m-d') : null;
			$event->start_time = $request->start_time ? date('H:i:s', strtotime($request->start_time)) : null;
			$event->to_time = $request->to_time ? date('H:i:s', strtotime($request->to_time)) : null;
			$event->location = $request->location;
			$event->contact_detail = $request->contact_detail;
			$event->email = $request->email;
			$event->website_url = $request->website_url;
			$event->facebook = $request->facebook;
			$event->instagram = $request->instagram;
			$event->linkedin = $request->linkedin;
			$event->short_description = $request->short_description;
			$event->description = $request->description;
			$event->meta_title = $request->meta_title;
			$event->meta_description = $request->meta_description;
			$event->meta_keyword = $request->meta_keyword;
			$event->canonical = $request->canonical;
			$event->author = $request->author;
			$event->status = 'Inactive'; // Default status as requested

			// Handle image upload
			if ($request->hasFile('image')) {
				$file = $request->file('image');
				$event->image = ImageHelper::uploadImage($file, 'event', null, 'event');
			}

			$event->save();

			return response()->json([
				'status' => 'success',
				'message' => 'Event created successfully',
				'data' => [
					'id' => $event->id,
					'title' => $event->title,
					'slug' => $event->slug,
					'status' => $event->status,
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
}
