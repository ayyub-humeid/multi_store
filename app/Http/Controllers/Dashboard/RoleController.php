<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate();
        return view('dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create',['role'=>new Role()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'abilities'=> 'required|array'
        ]);
        DB::beginTransaction();
        try{
            $role = Role::create([
            'name'=>$request->post('name')
        ]);
        foreach($request->post('abilities') as $ability){
            Permission::create([
                'role_id'=> $role->id,
                'name' => $ability,
                'type'=>'allow'
            ]);
        }
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return redirect()->route('dashboard.roles.index')->with('success','saved successfully');
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
    public function edit(Role $role)
    {
        return view('dashboard.roles.edit',compact($role));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
          $request->validate([
            'name'=> 'required|string|max:255',
            'abilities'=> 'required|array'
        ]);
        DB::beginTransaction();
        try{
            $role->update([
            'name'=>$request->post('name')
        ]);
        foreach($request->post('abilities') as $ability => $value){
            Permission::updateOrCreate([
                'role_id'=> $role->id,
                'name' => $ability,
                'type'=>$value
            ]);
        }
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return redirect()->route('dashboard.roles.index')->with('success','saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
