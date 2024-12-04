<?php

namespace App\Http\Controllers\Backend\Airdrops;

use App\Http\Controllers\Controller;
use App\Models\AirDrops;
use Illuminate\Http\Request;

use App\Models\BlogCategory;
use App\Models\BlogDetail;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Session;
use Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AirDropsController extends Controller
{
    public function all(){
        return view('Backend.airdrops.All');
    }
    public function add(){
        $getBlogCats = BlogCategory::where('type','blog')->get();
        return  view('Backend.airdrops.Add',['getBlogCats'=>$getBlogCats]);
    }
    public function save(Request $request){
        $this->validate($request,[
            'cryptocurrency_type' => 'required',
            'coin_token_name'=>'required',
            'coin_token_symbol'=> 'required',
            'start_date'=>'required',
            'end_date'=> 'required',
            'winner_announcement_date'=> 'required',
            'no_of_winners'=> 'required',
            'project_website'=> 'required',
            'email'=> 'required',
            'project_description'=> 'required',
            'task_details'=> 'required',
            'project_based'=> 'required',
            'country_name'=> 'required',
            'task_link'=> 'required',
            'facebook_url'=> 'required',
            'twitter_account'=> 'required',
            'instagram_url'=> 'required',
            'reddit_url'=> 'required',
            'medium_url'=> 'required',
            'telegram_url'=> 'required',
            'discord_url'=> 'required',
            'contract_address'=> 'required',
            'user_contact_type'=> 'required',
            'contact_id'=> 'required',
            'coin_token_image'=> 'required'
           
        ]);
      
        $save = new AirDrops();
        $save->type = $request->get('cryptocurrency_type');
        $save->name = $request->get('coin_token_name');
        $save->coin_token_symbol = $request->get('coin_token_symbol');
        $save->start_date =  Carbon::createFromFormat('d-m-Y', $request->get('start_date'))->format('Y-m-d');
        $save->end_date = Carbon::createFromFormat('d-m-Y', $request->get('end_date'))->format('Y-m-d');
        $save->winner_announcement_date = Carbon::createFromFormat('d-m-Y', $request->get('winner_announcement_date'))->format('Y-m-d'); 
        $save->coin_token_qty = $request->get('coin_token_quantity');
        $save->total_airdrop_qty = $request->get('total_airdrop');
        $save->no_of_winners = $request->get('no_of_winners');
        $save->project_website = $request->get('project_website');
        $save->email = $request->get('email');
        $save->description_of_project = $request->get('project_description');
        $save->task_details = $request->get('task_details');
        $save->project_based_on = $request->get('project_based');
        $save->country = $request->get('country_name');
        $save->tast_link = $request->get('task_link');
     //   $save->facebook_link = $request->get('meta_keyword');
        $save->facebook_url = $request->get('facebook_url');
        $save->twitter_url = $request->get('twitter_account');
        $save->instagram_url = $request->get('instagram_url');
        $save->reddit_url = $request->get('reddit_url');
        $save->medium_url = $request->get('medium_url');
        $save->telegram_url = $request->get('telegram_url');
        $save->discord_url = $request->get('discord_url');
        $save->contract_address = $request->get('contract_address');
        $save->contact = $request->get('user_contact_type');
        $save->contact_id = $request->get('contact_id');
        $save->aprove_status = 'Pending';
      
        if ($request->hasFile('coin_token_image')) {
            $file            = $request->file('coin_token_image');
            $destinationPath = '/uploads/generalSetting/';
            $filename        = rand(10000,999999).'.'. $file->getClientOriginalExtension();
            $request->file('coin_token_image')->move(public_path().$destinationPath, $filename);
            $save->coin_token_image=$filename;
        }
        $save->save();
        FacadesSession::flash('success', "Air Drop has been create");
        return redirect()->back();
    }
    public function datatable(){
        $query = AirDrops::select('id','coin_token_image','name','coin_token_symbol','start_date','end_date');
        return DataTables::eloquent($query)
            ->addColumn('coin_token_image', function ($data) {
                if($data->image!=''){
                    return '<img src="'.$data->coin_token_image.'" width="100px" />';
                }else{
                    return 'N/A';
                }
            })
           
            ->addColumn('action', function ($data) {
                $url_update = route('editBlog', ['id' => $data->id]);
                $url_delete = route('deleteBlog', ['id' => $data->id]);
                // $url_comment = route('allComment', ['id' => $data->id]);
                $edit = '<a class="label label-primary"  href="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Blog Name: <span class=&#034;label label-primary&#034;>' . $data->title . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                // $edit .= '&nbsp<a href="' . $url_comment . '" class="label label-success"</span><i class="fa fa-envelope-o"></i> Comments </a>';
                return $edit;
            })
            ->rawColumns(['id','action','image'])
            ->toJson();
    }
    public function editBlog($id=null){
        $getBlogCats = BlogCategory::where('type','blog')->get();
        $records = AirDrops::findOrFail($id);
        return view('Backend.airdrops.Edit',[
            'records'=>$records,
            'getBlogCats'=>$getBlogCats,
        ]);
    }
    public function update(Request $request,$id=null){
        $this->validate($request,[
            'title' => 'required|unique:blog_details,title,'.$id.',id,deleted_at,NULL',
        ]);

    $user_id = Auth::User()->id;
    $update = AirDrops::findOrFail($id);
    $update->category_id = $request->get('cat_name');
    $update->user_id = $user_id;
    $update->title = $request->get('title');
    $update->slug = Str::slug($request->get('title'));
    $update->content = $request->get('content');

    $update->meta_title = $request->get('meta_title');
    $update->meta_description = $request->get('meta_description');
    $update->author = $request->get('author');
    $update->short_description = $request->get('short_description');
    $update->canonical = $request->get('canonical');
    $update->meta_keyword = $request->get('meta_keyword');


    if(!empty($request->file('image'))){
        $file            = $request->file('image');
        $destinationPath = '/uploads/generalSetting/';
        $filename        = rand(10000,999999).'.'. $file->getClientOriginalExtension();
        $request->file('image')->move(public_path().$destinationPath, $filename);


        if(file_exists(public_path().'/uploads/generalSetting/'.$update->image)){
            unlink(public_path().'/uploads/generalSetting/'.$update->image);
        }
        $update->image = $filename;
    }

    $update->save();
    Session::flash('success', "AirDrops has been update");
    return redirect()->back();
    }
    public function delete($id=null){
        $remove = AirDrops::findOrFail($id);
        $remove->delete();
        return redirect()->back();
    }

}
