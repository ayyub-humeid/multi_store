<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = Auth::user();
        // if($user->store_id){
        //     $products = Product::where('store_id',$user->store_id)->paginate();
        // } else{
        //     $products = Product::paginate();
        // }
        // if i need the admin is allowed to show all categories
        // how to except globle scope
        // with function => withOutglobleScope(name of scope)
           $products = Product::with(['category','store'])->paginate();


        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product() ;
        $categories =Category::all();
        $tags = '';
        return view('dashboard.products.create',compact('product','categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id'=>'required|exists:categories,id',
            'image' => 'file',
            'price'=>'required',
        ]);
        $data  = $request->except('tags');
         $data['image']  = $this->uploadImage($request);
        $product = Product::create($data);
        $tags = json_decode($request->post('tags'));
        $tag_ids = [];
        $saved_tags = Tag::all();
        foreach($tags as $tag){
            $slug = Str::slug($tag->value);
            $getTag = $saved_tags->where('slug',$slug)->first();
            if(!$getTag){
               $getTag= Tag::create([
                    'name'=> $tag->value,
                    'slug'=> Str::slug($tag->value)
                ]);
            }
            $tag_ids[] = $getTag->id;
        }
        $product->tags()->sync($tag_ids);
        $user = Auth::user();
    if($user && $user->store_id){

    }
        // dd($data);

        return redirect()->route('dashboard.products.index')->with('message','Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
     $product = Product::findOrFail($id);
     $tags = implode( ',',$product->tags()->pluck('name')->toArray());

        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));
        //  $data  = $request->except('tags');
        $tags = json_decode($request->post('tags'));
        $tag_ids = [];
        $saved_tags = Tag::all();
        foreach($tags as $tag){
            $slug = Str::slug($tag->value);
          $getTag = $saved_tags->where('slug',$slug)->first();
            if(!$getTag){
               $getTag= Tag::create([
                    'name'=> $tag->value,
                    'slug'=> Str::slug($tag->value)
                ]);
            }
            $tag_ids[] = $getTag->id;
        }
        $product->tags()->sync($tag_ids);



        return redirect()->route('dashboard.products.index')->with('message','Saved Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
     protected function uploadImage(Request $request){
        if(!$request->hasFile('image')){
            return;
        }
         $file = $request->file('image');
        $path = $file->store('categories','public');
        return $path;
    }
}