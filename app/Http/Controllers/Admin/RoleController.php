<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $roles = Role::query()
        //     ->select([
        //         'id',
        //         'name',
        //         'created_at',
        //     ])
        //     ->when($request->name, fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
        //     ->latest('id')
        //     ->paginate(10);
        $roles = Role::select(['id', 'name', 'created_at'])
            ->latest('id')->paginate(10);

        return Inertia::render('Role/Index', [
            // 'title' => 'Roles',
            'roles' => RoleResource::collection($roles),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Created At',
                    'name' => 'created_at',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                ],
            ],
            // 'filters' => (object) $request->all(),
            // 'routeResourceName' => $this->routeResourceName,
            // 'can' => [
            //     'create' => $request->user()->can('create role'),
            // ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Role/Create',[
            'edit' => false,
            'title' => 'Create a new role',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Role::create($request->validated());
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully ! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return Inertia::render('Role/Create', [
            'role' => new RoleResource($role),
            'title' =>'Edit Role',
            'edit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success', 'Role deleted successfully!');
    }
}
