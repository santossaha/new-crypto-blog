<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogsResource;
use App\Models\BlogDetail;
use Exception;
use Illuminate\Http\Request;

class BlogController extends Controller
{

  public function get_blogs()
  {

    try {

      $blogs = BlogDetail::orderBy('id', 'desc')->get();
      $get_blogs = BlogsResource::collection($blogs);
      return response()->json(['status'=>'success', $get_blogs]);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }
}
