<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const VIEW_PATH = 'clients.';
    private const PUBLIC_PATH = 'clients';
    public function index()
    {
        $data = Client::paginate(5);
        return view(self::VIEW_PATH . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'company_name' => 'required',
                'avatar' => 'image',
                'account' => 'required',
                'project' => 'required',
                'invoices' => 'required',
                'category' => 'required',
                'status' => [
                    'required',
                    Rule::in([
                        Client::IN_ACTIVE,
                        Client::IS_ACTIVE,
                    ]),
                ]
            ]
        );
        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $data['avatar'] = Storage::put(self::PUBLIC_PATH, $request->file('avatar'));
        }
        Client::create($data);
        Alert::success('success', 'Created Successfully');
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate(
            [
                'company_name' => 'required',
                'avatar' => 'image',
                'account' => 'required',
                'project' => 'required',
                'invoices' => 'required',
                'category' => 'required',
                'status' => [
                    'required',
                    Rule::in([
                        Client::IN_ACTIVE,
                        Client::IS_ACTIVE,
                    ]),
                ]
            ]
        );
        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $data['avatar'] = Storage::put(self::PUBLIC_PATH, $request->file('avatar'));
        }
        $currentAvatar = $client->avatar;
        if ($request->hasFile('avatar')) {
            Storage::delete($currentAvatar);
        }
        $client->update($data);
        Alert::success('success', 'Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        if (Storage::exists($client->avatar)) {
            Storage::delete($client->avatar);
        }
        $client->delete();
        toast('Deleted Successfully', 'success');
        return redirect()->back();
    }
}
