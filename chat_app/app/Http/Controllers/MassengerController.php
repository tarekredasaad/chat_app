<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
class MassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('adminData')[0]->id;
        $users = User::where('id','!=',$id)->get();
        return view('layout.message',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //$message = Message::where('sender','=',$userid,'and','receiver','=',$id ||'receiver','=',$userid,'and','sender','=',$id )->join('users','users.id','=',$userid || $id);
    public function create($userid)
    {
        $id = session('adminData')[0]->id;
        $user= session('adminData')[0];
        $sender = Message::join('users','users.id','=','message.sender')->where(
            'receiver',$id)->where('sender',$userid
            )->orWhere(
            'sender',$id)->where('receiver',$userid
            )->latest()->paginate(7);
        $receiver = Message::where('receiver',$userid)->latest()->paginate(7);
        $users = User::where('id','!=',$id)->get();
        return view('messengers',compact('user','users','userid','sender','receiver'))->with(['success' => 'تم ألاضافة بنجاح']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$userid,$id)
    {
        $data = new Message;
            if($request->upload_image == null && $request->message == null){

                $request->validate([

                    "message"=>"required|max:150"

                ]);
            }

        if($request->upload_image !== null){

            $request->validate([


                "upload_image"=>"required|mimes:png,jpg"
            ]);
            $image = $request->upload_image;
            $imagename =time().'.'.$image->getClientOriginalExtension();
            $request->upload_image->move('imagepost',$imagename);

            $data->file=$imagename;
        }else{

            $request->upload_image = null;
        }
        // $allfileData = $request->upload_image;
        // $file_Name = $allfileData->getClientOriginalName();
        // $allfileData->move(public_path()."/imagepost/".$file_Name);

        // $data->file=$file_Name;

        $data->sender=$userid;
        $data->receiver=$id;
        $data->message=$request->message;
        $data->save();
        // DB::insert('insert into message ( sender,receiver,message,file) values (?, ?,?,?)', [$userid,$id,$request->message,$request->upload_image]);
        session()->flash('message','your message has been submited');
        return redirect('messageuser/'.$id)->with($userid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
