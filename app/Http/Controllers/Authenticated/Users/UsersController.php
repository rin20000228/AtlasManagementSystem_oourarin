<?php

namespace App\Http\Controllers\Authenticated\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Gate;
use App\Models\Users\User;
use App\Models\Users\Subjects;
use App\Searchs\DisplayUsers;
use App\Searchs\SearchResultFactories;

class UsersController extends Controller
{

    public function showUsers(Request $request){
        //dd($request->all());
        $keyword = $request->keyword;
        $category = $request->category;
        $updown = $request->updown;
        $gender = $request->sex;
        $role = $request->role;
        $subjects = $request->subject_id; // ここで検索時の科目を受け取る
        //dd($subjects);
        //メソッド
        $userFactory = new SearchResultFactories();
        // ユーザーの絞り込み
        // 検索条件に基づいて絞り込まれたユーザーのコレクションを取得する
        $users = $userFactory->initializeUsers($keyword, $category, $updown, $gender, $role, $subjects);
        // 科目の一覧表示
        $allSubjects = Subjects::all();
        return view('authenticated.users.search', compact('users', 'allSubjects'));
    }

    public function userProfile($id){
        $user = User::with('subjects')->findOrFail($id);
        $subject_lists = Subjects::all();
        return view('authenticated.users.profile', compact('user', 'subject_lists'));
    }

    public function userEdit(Request $request){
        $user = User::findOrFail($request->user_id);
        $user->subjects()->sync($request->subjects);
        return redirect()->route('user.profile', ['id' => $request->user_id]);
    }
}
