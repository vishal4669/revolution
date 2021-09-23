<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessages;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class ContactMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ContactMessages::query()->select(sprintf('%s.*', (new ContactMessages())->table));
            $table = Datatables::of($query);

            $table->addIndexColumn('');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $deleteGate = 'contact_messages_delete';
                $crudRoutePart = 'contact-messages';

                return view('admin.contact-messages.datatablesActions', compact(
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });            
            $table->editColumn('user_id', function ($row) {
                return $row->user_id ? User::find($row->user_id)->full_name : 'Guest';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'srno']);

            return $table->make(true);
        }

        return view('admin.contact-messages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(Auth::check());
        $data = array();
        $data = $request->all();
        if(!Auth::check()){
            $message = ContactMessages::create($data);
        }else{
            $data['user_id'] = Auth::user()->id;
            $message = ContactMessages::create($data);
        }

        return redirect()->back()->with('success', 'Message submitted successfully!');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactMessages  $contactMessages
     * @return \Illuminate\Http\Response
     */
    public function show(ContactMessages $contactMessages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactMessages  $contactMessages
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactMessages $contactMessages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactMessages  $contactMessages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactMessages $contactMessages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactMessages  $contactMessages
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactMessages $contactMessages)
    {
        $contactMessages->delete();

        return back();
    }
}
