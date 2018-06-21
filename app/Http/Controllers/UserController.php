<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest; //自定义表单验证类
use App\Http\Controllers\Controller;
use App\Models\User;
class UserController extends Controller
{
    //
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '个人资料已更新成功');
        //如果成功，with()方法会向Session 中写入success，可以从Session中获取success 的值
    }
}
