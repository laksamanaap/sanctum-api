<?php
namespace App\Http\Controllers;
use http\Env\Response;
use App\Models\Product;
use Illuminate\Http\Request;
use app\Http\Controllers\ProductController;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/greet",
     *     tags={"greeting"},
     *     summary="Returns a Sample API response",
     *     description="A sample greeting to test out the API",
     *     operationId="greet",
     *     @OA\Parameter(
     *          name="firstname",
     *          description="nama depan",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="lastname",
     *          description="nama belakang",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function greet(Request $request)
    {
        $userData = $request->only([
            'firstname',
            'lastname',
        ]);
        if (empty($userData['firstname']) && empty($userData['lastname'])) {
            return new \Exception('Missing data', 404);
        }
        return 'Halo ' . $userData['firstname'] . ' ' . $userData['lastname'];
    }

    /**
     * @OA\Get(
     *     path="/products",
     *     tags={"products"},
     *     summary="Get list of products",
     *     description="Get list of products",
     *     operationId="products",
     *     
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * @OA\Get(
     *     path="/products/{id}",
     *     tags={"products"},
     *     summary="Show specific products",
     *     description="Show specific products",
     *     operationId="Showproducts",
     *     
     * @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * 
     * 
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function show(string $id)
    {
        return Product::find($id);
    }


    /**
     * @OA\Get(
     *     path="/products/search/{name}",
     *     tags={"products"},
     *     summary="Search specific products",
     *     description="Show specific products",
     *     operationId="Searchproducts",
     *     
     * @OA\Parameter(
     *          name="name",
     *          description="Project name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     * 
     * 
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function search($name)
    {
        return Product::where('name', 'like', '%'. $name .'%')->get();

    }

/**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/products",
 *     tags={"products"},
 *     summary="Post store products",
 *     @OA\RequestBody(
 *          description= "- Post new products",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="name", type="string"),
 *              @OA\Property(property="slug", type="string"),
 *              @OA\Property(property="description", type="string"),
 *              @OA\Property(property="price", type="float")
 *          )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="get token",
 *      ),
 *    )
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);

        return Product::create($request->all());
    } 
 
    /**
     * @OA\Put(
     *     path="/products",
     *     tags={"products"},
     *     summary="Update products",
     *     @OA\RequestBody(
     *          description= "- Update products",
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="id", type="int"),
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="slug", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="price", type="float")
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="get token",
     *      ),
     *    )
     *
     *
     */

 public function update(Request $request)
 {
    
    $requestData = $request->only([
        'id',
        'name',
        'slug',
        'description',
        'price'
    ]);

    $id = $requestData['id'];
    $name = $requestData['name'];
    $slug = $requestData['slug'];
    $description = $requestData['description'];
    $price = $requestData['price']; 

    $Product = Product::find($id);
    $Product->name = $name;
    $Product->slug = $slug;
    $Product->description = $description;
    $Product->price = $price;

    $Product->save();
    return response($Product, 200);

 } 

    /**
     * @OA\Delete(
     *     path="/products/{id}",
     *     tags={"products"},
     *     summary="Delete products",
     *     description="Delete products",
     *     operationId="deleteProducts",
     *     
     * @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * 
     * 
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        return Product::destroy($id);
    }

 
}