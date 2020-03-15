<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Support\Str;
use App\Product;
use App\Product_size;
use App\Attribute;
use App\Attribute_set;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->per_page ? $request->per_page : 5;
        $sortBy = $request->sort_by;
        $orderBy = $request->order_by;
        return response()->json([
            'products' => new ProductCollection(Product::with('product_sizes')->orderBy($sortBy, $orderBy)->paginate($per_page))
        ], 200);
    }

    public function store(Request $request)
    {
        if ($request->image1) {
                $name_img1 = Str::random(16).'.'.explode('/', explode(':', substr($request->image1, 0, strpos($request->image1, ';')))[1])[1];
                \Image::make($request->image1)->resize(600, 800)->save(public_path('storage/images/').$name_img1);
            $request->image1 = $name_img1;
        }
        if ($request->image2) {
                $name_img2 = Str::random(16).'.'.explode('/', explode(':', substr($request->image2, 0, strpos($request->image2, ';')))[1])[1];
                \Image::make($request->image2)->resize(600, 800)->save(public_path('storage/images/').$name_img2);
            $request->image2 = $name_img2;
        }
        if ($request->image3) {
                $name_img3 = Str::random(16).'.'.explode('/', explode(':', substr($request->image3, 0, strpos($request->image3, ';')))[1])[1];
                \Image::make($request->image3)->resize(600, 800)->save(public_path('storage/images/').$name_img3);
            $request->image3 = $name_img3;
        }
        if ($request->image4) {
                $name_img4 = Str::random(16).'.'.explode('/', explode(':', substr($request->image4, 0, strpos($request->image4, ';')))[1])[1];
                \Image::make($request->image4)->resize(600, 800)->save(public_path('storage/images/').$name_img4);
            $request->image4 = $name_img4;
        }
      //  dd($request);
       // $product = Product::create($request->all() + ['image1' =>  $request->image1]);
       $product = new Product([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'isActive' => $request->isActive,
                'price_pkr' => $request->price_pkr,
                'price_usd' => $request->price_usd,
                'price_aud' => $request->price_aud,
                'price_eur' => $request->price_eur,
                'price_gbp' => $request->price_gbp,
                'special_price_percentage' => $request->special_price_percentage,
                'special_price_start' => $request->special_price_start,
                'special_price_end' => $request->special_price_end,
                'image1' => 'images/'.$name_img1,
                'image2' => 'images/'.$name_img2,
                'image3' => 'images/'.$name_img3,
                'image4' => 'images/'.$name_img4,
                'new_from' => $request->new_from,
                'new_to' => $request->new_to,
            ]);
            $product->save();

           $sizes = $request->size_attribs;

            foreach( $sizes as $size )
            {
                Product_size::create([
                    'product_id' => $product->id,
                    'attributes_id' => $size['attribute'],
                    'xs' => $size['xs'],
                    's' => $size['s'],
                    'm' => $size['m'],
                    'l' => $size['l'],
                    'xl' => $size['xl'],
                ]);
            }
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $role = Role::where('name', $request->role)->first();
    //     $product = new User([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //     ]);
    //     $product->role()->associate($role);
    //     $product->save();
    //     $product->profile()->save(new Profile());
    //     return response()->json(['user'=> new ProductResource($product)], 200);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // $per_page = $request->per_page ? $request->per_page : 5;
        // $sortBy = $request->sort_by;
        // $orderBy = $request->order_by;
        // $users = Product::where('name', 'LIKE', "%$id%")->orderBy($sortBy, $orderBy)->paginate(5);
        // return response()->json(['users'=> $users], 200);

        $per_page = $request->per_page ? $request->per_page : 5;
        $sortBy = $request->sort_by ? $request->sort_by : 'name';
        $orderBy = $request->order_by ? $request->order_by : 'asc';
        $users = Product::where('name', 'LIKE', "%$id%");
        return response()->json([
            'users' => new ProductCollection($users->orderBy($sortBy, $orderBy)->paginate($per_page)) ,
            'roles' => Role::pluck('name')->all()
        ], 200);

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
        $role = Role::where('name', $request->role)->first();
        $product = Product::find($id);
        $product->name = $request->name;
        $product->role()->dissociate($product->role);
        $product->role()->associate($role);
        $product->save();
        return response()->json(['user' => new ProductResource($product)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return response()->json(['product' => $product], 200);
    }

    public function deleteAll(Request $request)
    {
        Product::whereIn('id', $request->users)->delete();
        return response()->json(['message', 'Records Deleted Successfully'], 200);
    }
}
