<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Sql => select a.* , b.name as parent_name from categories as a
        // LEFT Join categories as b ON a.parent_id = b.id
        // inner join => return the category which has parent_id only
        // but left join return categories even the condistion is false
        $name = $request->name;
        $status = $request->status;
        // $categories = Category::query()
        // ->when($name,function(Builder $builder) use($name,$status) {
        //     $builder->where('name','LIKE',"%{$name}%");
        // })
        // ->when($status,function(Builder $builder) use($status) {
        //     $builder->where('status',$status);
        // })


        // ->paginate(1);
        // $categories = Category::active()->get() this is local scope | the globle scope alwase implement but the local we must to call it ;
        $categories = Category::withCount(
            ['products'=>function($query){
                $query->where('status','active');
            }]
        )
        // selectRaw("SELECT count(*) from products where category_id = categories.id as products_count ")
        // leftJoin('categories as parents','parents.id','=','categories.parent_id')
        // ->select(
        //     ['categories.*','parents.name as parent_name']
        // )
        // ->selectRaw('(SELECT COUNT(*) from products WHERE category_id = categories.id) as products_count' )

        ->
        filters($request->query())
        // ->with('categoryParent')
        ->paginate();
        // dd($categories);
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents= Category::all();
        $category = new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules(),[
            'required'=> 'this field (:attribute) is required',
            'name.unique'=> 'this name is already exists'
        ]);
         $request->merge([
            'slug'=> Str::slug($request->get('name'))
        ]);
        $data = $request->except('image');

        // if($request->hasFile('image')){
        //     $file =$request->file('image');
        //    $path = $file->store('categories','public');
           $data['image']  = $this->uploadImage($request);
        // //    $request
        // }


        Category::create($data);
        return redirect()->route('categories.index')->with('success','Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $category = Category::findOrFail($id);
        // if(!$category){
        //     return abort(404);
        // }
        try{
              $category = Category::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('categories.index')->with('info','Record  Not Found');
        }
        $parents = Category::whereNot('id',$id) // clothes 1 , men clothes 2 parent 1 ,
        ->where(function($query) use($id){
            $query->whereNull('parent_id')
            ->orWhere('parent_id', '<>',$id);
        })
        // ->Where('parent_id','<>',$id)

        ->get();
        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Category::rules($id),[
            'required'=> 'this field (:attribute) is required',
            // 'name.unigue'=> 'this name is already exists'
        ]);
        $category = Category::findOrFail($id);
        $old_image = $category->image;
        // dd($request->all());
        $data = $request->except('image');
        $path = $this->uploadImage($request);
        if($path){
            $data['image'] = $path;
        }
        // if($request->hasFile('image')){
        //     // dd('dd');
        //     $file =$request->file('image');
        //    $path = $file->store('categories','public');
        //    $data['image']  = $path;
        // //    dd($data['image']);
        // //    $request
        // }
        // dd($data);
        $category->update($data);
        if($old_image &&isset($data['image'])){
            // dd($old_image);
           $res= Storage::disk('public')->delete($old_image);

        }
        return redirect()->route('categories.index')->with('success','Saved Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Category::destroy($id);
        $category = Category::findOrFail($id);
        $category->delete();
        // if($category->image){
        //     Storage::disk('public')->delete($category->image);
        // }
        return redirect()->route('categories.index')->with('success','Deleted Successfully');

    }
    public function trash(){
        // dd('ds');
       $categories = Category::onlyTrashed()->paginate(5);
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore(Request $request,$id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('categories.trash')->with('success','Restred Successfully!');
    }
    public function force_delete($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
         if($category->image){
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('categories.index')->with('success','Deleted Successfully forever !');
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