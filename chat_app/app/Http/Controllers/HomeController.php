<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Friend_Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{



    public function home()
    {
        $data = new Post;
        $like = Like::where(['contentid'=>85])->get();
        $adminData = User::where(['id'=>1]);
        $id = session('adminData')[0]->id;
        $Data = User::find($id);//('bookings', function($join)

        $users = User::leftJoin('friend_request',function($join){
            $join->on('friend_request.owner_request','=','users.id')->orOn('friend_request.owner_target','=','users.id');
        })->where('users.id','!=',$id)->get();
        $notiFriend = Friend_Request::where('owner_target',$id)->where('request_status','pending')->count();
        $noti = Notification::where('content_owner',$id)->
        where('content_type','Message')->where('noti_status',0)->count();
        $notipost = Notification::where('content_owner',$id)->
        where('content_type','Post')->where('noti_status',0)->count();
        $data2 = Post::join('users','users.id','=','post.user_id')
        ->join('comments','comments.post_id','=','post.postid')
        ->latest('post.created_at')->orderBy('post.created_at')->paginate(PAGINATION_COUNT);
        $com =new Comment;
        return view('messenger',compact('adminData','data2','users','Data','like','noti','notipost','com','notiFriend'));
    }
    public $password;
    public $email;

    protected $rules = [
        'password' => 'required|min:6',
        'email' => 'required|email',
    ];

    // public function updated($email)
    // {
    //     $this->validateOnly($email);
    // }


    // Check Login
    function check_login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);
        $admin=User::where(['email'=>$request->email,'password'=>$request->password])->count();
        if($admin>0){
            $adminData=User::where(['email'=>$request->email,'password'=>$request->password])->get();
            session(['adminData'=>$adminData]);
                $t =$adminData[0]->id;
            $Data =  User::find($t);
            $users = User::where('id','!=',$t)->get();
            $usernum = User::all()->count();

            // $like = Like::find(14);
            // $users = User::leftJoin('friend_request',function($join){
            //     $join->on('friend_request.owner_request','=','users.id')->orOn('friend_request.owner_target','=','users.id');
            // })->where('users.id','!=',$t)->get();
            // $noti = Notification::where('content_owner',$t)->
            // where('content_type','Message')->where('noti_status',0)->count();
            // $notipost = Notification::where('content_owner',$t)->
            // where('content_type','Post')->where('noti_status',0)->count();
            // $data2 =  Post::join('users','users.id','=','post.user_id')
            // ->leftJoin('comments','comments.post_id','=','post.postid')
            // ->latest('post.created_at')->orderBy('post.created_at')->paginate(PAGINATION_COUNT);
            // $com =new Comment;
            return view('messenger',compact('adminData','Data','users','usernum'));
        }else{
            session()->flash('msg','Invalid email/Password!!');
            return redirect('/')->with('msg','Invalid email/Password!!');
        }


    }

    public function signup(Request $request)
    {

        $request->validate([

            "gender"=>"required"
        ]);
       $data = new User;

       if($request->img !== null){

        $request->validate([

            "img"=>"required|mimes:png,jpg"
        ]);
        $image = $request->img;
        // $imagename =time().'.'.$image->getClientOriginalExtension();
        $request->img->move('imagepost',$image);

        $data->img=$imagename;
        $images = $request->img;
        }

        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->gender=$request->gender;
        if($request->img == null){
            if($request->gender == 'Male'){
                $request->img= 'user_male.jpg';
            }else{
                $request->img= 'user_female.jpg';
            }
            // $image = $request->img;
            // $imagename =time().'.'.$image->getClientOriginalExtension();
            // $request->img->move('imagepost',$imagename);
            $images = $request->img;
            // $data->img=$imagename;
        }
        // $data->user_id=$id;

        // $data->save();
        DB::insert('insert into users ( name,email,password,gender,img) values (?, ?,?,?,?)', [$request->name,$request->email,$request->password,$request->gender,$images]);

        return redirect('/')->with(['success' => 'تم ألاضافة بنجاح']);
    }

}
