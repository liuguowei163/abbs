<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Topic;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use Auth;

class UsersController extends Controller
{
    public function __construct(){
        //未登录的只能访问show
        $this->middleware('auth', ['except' => ['show']]);
    }
	//个人页面展示
    public function show(User $user, Topic $topic){
        $topics = $topic->recent()->where('user_id', Auth::id())->paginate(5);
    	return view('users.show', compact('user', 'topics'));
    }
    //个人编辑页面展示
    public function edit(User $user){
        $this->authorize('update', $user);
    	return view('users.edit', compact('user'));
    }
    //个人页面编辑
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user){
    	// dd(strtolower($request->avatar->getClientOriginalExtension()));
        $this->authorize('update', $user);
    	$data = $request->all();

    	if($request->avatar){
    		$result = $uploader->save($request->avatar, 'avatars', $user->id);
    		$data['avatar'] = $result['path'];
    	}

    	$user->update($data);
    	return redirect()->route('users.show', $user->id)->with('success', '个人资料修改成功');
    }
}
