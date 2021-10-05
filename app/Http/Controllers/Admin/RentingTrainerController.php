<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRentingTrainerRequest;
use App\Http\Requests\StoreRentingTrainerRequest;
use App\Http\Requests\UpdateRentingTrainerRequest;
use App\Models\RentingTrainer;
use App\Models\Trainer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RentingTrainerController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = RentingTrainer::with(['trainer', 'user'])->select(sprintf('%s.*', (new RentingTrainer())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'renting_trainer_show';
                $editGate = 'renting_trainer_edit';
                $deleteGate = 'renting_trainer_delete';
                $crudRoutePart = 'admin.renting-trainers';

                return view('admin.partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('trainer_name', function ($row) {
                return $row->trainer ? $row->trainer->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('booking_type', function ($row) {
                return $row->booking_type ? RentingTrainer::BOOKING_TYPE_RADIO[$row->booking_type] : '';
            });
            $table->editColumn('total_hours', function ($row) {
                return $row->total_hours ? $row->total_hours : '';
            });

            $table->editColumn('total_days', function ($row) {
                return $row->total_days ? $row->total_days : '';
            });
            $table->editColumn('price_per_day', function ($row) {
                return $row->price_per_day ? $row->price_per_day : '';
            });
            $table->editColumn('total_rent', function ($row) {
                return $row->total_rent ? $row->total_rent : '';
            });
            $table->editColumn('deposit_received', function ($row) {
                return $row->deposit_received ? $row->deposit_received : '';
            });
            $table->editColumn('payment_option', function ($row) {
                return $row->payment_option ? RentingTrainer::PAYMENT_OPTION_RADIO[$row->payment_option] : '';
            });
            $table->editColumn('is_cancelled', function ($row) {
                return $row->is_cancelled ? RentingTrainer::IS_CANCELLED_RADIO[$row->is_cancelled] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'trainer', 'user']);

            return $table->make(true);
        }

        $trainers = Trainer::get();
        $users    = User::get();

        return view('admin.rentingTrainers.index', compact('trainers', 'users'));
    }

    public function create()
    {

        $trainers = Trainer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all();

        return view('admin.rentingTrainers.create', compact('trainers', 'users'));
    }

    public function store(StoreRentingTrainerRequest $request)
    {
        $rentingTrainer = RentingTrainer::create($request->all());

        $trainer = Trainer::find($request->trainer_id);

        $trainer->is_rented = 1;

        $trainer->save();

        return redirect()->route('admin.renting-trainers.index');
    }

    public function getTrainerDetails($id)
    {
       $trainer_details = Trainer::find($id);

       $rent = $trainer_details->rent_month;

       return $rent;
    }

    public function edit(RentingTrainer $rentingTrainer)
    {

        $trainers = Trainer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rentingTrainer->load('trainer', 'user');

        return view('admin.rentingTrainers.edit', compact('trainers', 'users', 'rentingTrainer'));
    }

    public function update(UpdateRentingTrainerRequest $request, RentingTrainer $rentingTrainer)
    {
        $rentingTrainer->update($request->all());

        return redirect()->route('admin.renting-trainers.index');
    }

    public function show(RentingTrainer $rentingTrainer)
    {
        abort_if(Gate::denies('renting_trainer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rentingTrainer->load('trainer', 'user');

        return view('admin.rentingTrainers.show', compact('rentingTrainer'));
    }

    public function destroy(RentingTrainer $rentingTrainer)
    {

        $rentingTrainer->delete();

        return back();
    }

    public function massDestroy(MassDestroyRentingTrainerRequest $request)
    {
        RentingTrainer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
