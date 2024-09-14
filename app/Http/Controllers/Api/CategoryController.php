<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function categories()
	{

		try {
			$categories = BlogCategory::where('status', 'Active')->select('id', 'name', 'slug', 'type', 'status')->orderBy('id', 'desc')->get();
			return response()->json(['status' => 'success', $categories]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
}
