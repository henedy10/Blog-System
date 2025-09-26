<?php

namespace App\Http\Controllers;
use App\Models\{Post};
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    /**
     *  @OA\Get(
        *    path         = "/api",
        *   operationId  = "getPostsList",
        *    tags         = {"Posts"},
        *    summary      = "Get list of Posts",
        *    description  = "Returns list of Posts",
        *  @OA\Parameter(
        *     name         = "search",
        *     in           = "query",
        *     description  = "Search posts by name or title",
        *     required     = false,
        *     @OA\Schema(
        *        type = "string"
        *    )
        *  ),
        *  @OA\Response(
        *      response    = 200,
        *      description = "List Posts",
        *  ),
        *  @OA\Response(
        *       response    = 404,
        *       description = "No posts found!"
        *  ),
     *  ),
     */

    public function index(){
        $search = request()->query('search');
        $posts  = Post::with('user')
        ->where('title','LIKE','%' . $search . '%')
        ->orWhereHas('user',function($q) use($search){
            $q->where('name','LIKE' ,'%' . $search . '%');
        })
        ->paginate(5);

        if( $posts->count() < 1 ){
            return response()->json([
                'message'  => 'There is no posts',
            ],404);
        }else{
            return response()->json([
                'message'      => true,
                'count'        => $posts->count(),
                'data'         => $posts->items(),
                'current_page' => $posts->currentPage(),
            ],200);
        }
    }

    /**
     *  @OA\Get(
            *  path       = "/api/posts/{post}",
            *  summary    = "show single post",
            * tags        = {"Posts"},
            * @OA\Parameter(
                *  name        = "post",
                *  in          = "path",
                *  required    = true,
                * description  = "get single post by id",
                * @OA\schema(
                    * type = "integer"
                * ),
            * ),
            *@OA\Response(
                *response    = 200,
                *description = "get single post by id",
            *),
            *@OA\Response(
                *response    = 404,
                *description = "Post not fount",
            *),
     *  ),
     */

    public function show(Post $post){
        return response()->json([
            'message' => true,
            'data'    => $post,
        ],200);
    }

        /**
         *  @OA\Post(
                *  path        = "/api/posts",
                *  summary     = "Create New Post",
                *  tags        = {"Posts"},
                * @OA\RequestBody(
                    * required=true,
                        * @OA\JsonContent(
                            *  required = {"title","description","user_id"},
                            *  @OA\Property(property = "title"      , type = "string"  , example = "New Post"),
                            *  @OA\Property(property = "description", type = "string"  , example = "Post description"),
                            *  @OA\Property(property = "user_id"    , type = "integer" , example = 1),
                        *)
                *),
                *@OA\Response(
                    *response    = 201,
                    *description = "Create new post successfully",
                *),
         *  ),
         */

        public function store(Request $request) {
            $validated = $request->validate([
                'title'        => 'required | min:3',
                'description'  => 'required | min:5',
                'user_id'      => 'required | integer | exists:users,id'
            ]);

            $post = Post::create($validated);
            return response()->json([
                'message' => 'post is created successfully',
                'data'    => $post
                ] ,201);
            }

            /**
             *  @OA\Put(
                    *  path        = "/api/posts/{post}",
                    *  summary     = "Update Post",
                    *  tags        = {"Posts"},
                    *@OA\Parameter(
                        * name     = "post",
                        * in       = "path",
                        * required = true,
                        *@OA\schema(type = "integer"),
                    *),
                    * @OA\RequestBody(
                        * required=true,
                            * @OA\JsonContent(
                                *  required = {"title","description","user_id"},
                                *  @OA\Property(property = "title"      , type = "string"  , example = "New Post"),
                                *  @OA\Property(property = "description", type = "string"  , example = "Post description"),
                                *  @OA\Property(property = "user_id"    , type = "integer" , example = 1),
                            *)
                    *),
                    *@OA\Response(
                        *response    = 200,
                        *description = "Post updated successfully",
                    *),
                    *@OA\Response(
                        *response    = 404,
                        *description = "Post not found",
                    *),
             *  ),
             */
            public function update(Request $request,Post $post){
                $validated = $request->validate([
                    'title'        => 'required | min:3',
                    'description'  => 'required | min:5',
                    'user_id'      => 'required | integer | exists:users,id'
                ]);

                $post->update($validated);

                return response()->json([
                    'message'  =>  'post is updated successfully',
                    'data'     =>  $post,
                ],200);
            }

            /**
             * @OA\Delete(
                *  path        = "/api/posts/{post}",
                *  summary     = "Delete Post",
                *  tags        = {"Posts"},
                *@OA\Parameter(
                    * name     = "post",
                    * in       = "path",
                    * required = true,
                    *@OA\schema(type = "integer"),
                *),
                *@OA\Response(
                    *response    = 200,
                    *description = "Post deleted successfully",
                *),
                *@OA\Response(
                    *response    = 404,
                    *description = "Post not found",
                *),
             * ),
             */
            public function destroy(Post $post){
            $post->delete();
            return response()->json([
                'message'       =>  'post is deleted successfully',
                'deleted_id'    =>  $post->id,
            ],200);
    }
}
