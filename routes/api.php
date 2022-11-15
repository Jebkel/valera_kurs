<?php

use App\Models\Likes;
use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/set_like/{link_id}', function (Request $request, $link_id) {
    $user = $request->user();
    $check = Likes::where('user_id', $user->id)->where('links_id', $link_id)->count();
    if ($check === 0) {
        $like = new Likes;
        $like->user_id = $user->id;
        $like->links_id = $link_id;
        $like->save();
        $result = ['status' => 'success', 'message' => __('Record is successfully added to favorites')];
    } else {
        $result = ['status' => 'error', 'message' => __('Record already in the chosen one!')];
    }
    return $result;
});
Route::middleware('auth:sanctum')->post('/del_like/{link_id}', function (Request $request, $link_id) {
    $user = $request->user();
    $like = Likes::where('user_id', $user->id)->where('links_id', $link_id)->first();
    $like->delete();
    return ['status' => 'success', 'message' => __('Record delete!')];
});

Route::middleware('auth:sanctum')->post('/admin_del_like/{link_id}', function (Request $request, $link_id) {
    $user = $request->user();
    if ($user->role > 0) {
        $like = Links::find($link_id);
        if ($like) {
            $like->delete();
        } else {
            return ['status' => 'error', 'message' => __('Not found a record - ') . $link_id];
        }

        return ['status' => 'success', 'message' => __('Record delete!')];
    }
    return ['status' => 'error', 'message' => __('Not enough right!')];

});
