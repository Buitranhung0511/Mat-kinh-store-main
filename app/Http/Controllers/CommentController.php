<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function all_comment()
    {
        $all_comment = Comment::paginate(10);
        return view('admin.all_comment', ['all_comment' => $all_comment]);
    }

    public function search_comment(Request $request)
    {

        // lây danh sách comment
        $all_comment = Comment::where('comment_name', 'like', '%' . $request->search_comment . '%')->paginate(10);

        // trả về view hiển thị sau khi lọc
        return view('admin.all_comment', ['all_comment' => $all_comment->isEmpty() ? null : $all_comment]);
    }

    public function unactive_comment($comment_id)
    {
        DB::table('comments')->where('comment_id', $comment_id)->update(['comment_status' => 1]);
        Session::put('message1', 'Deactivated comment successfully');
        return Redirect::to('all-comment');
    }

    public function active_comment($comment_id)
    {
        DB::table('comments')->where('comment_id', $comment_id)->update(['comment_status' => 0]);
        Session::put('message', 'Activated comment successfully');
        return Redirect::to('all-comment');
    }

    public function delete_comment($comment_id)
    {
        DB::table('comments')->where('comment_id', $comment_id)->delete();
        Session::put('message', 'Delete comment successfully !');
        return Redirect::to('all-comment');
    }
}
