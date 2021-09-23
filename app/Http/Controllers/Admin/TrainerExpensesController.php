<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTrainerExpenseRequest;
use App\Http\Requests\StoreTrainerExpenseRequest;
use App\Http\Requests\UpdateTrainerExpenseRequest;
use App\Models\Trainer;
use App\Models\TrainerExpense;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TrainerExpensesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = TrainerExpense::with(['trainer'])->select(sprintf('%s.*', (new TrainerExpense())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'trainer_expense_show';
                $editGate = 'trainer_expense_edit';
                $deleteGate = 'trainer_expense_delete';
                $crudRoutePart = 'trainer-expenses';

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

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'trainer']);

            return $table->make(true);
        }

        return view('admin.trainerExpenses.index');
    }

    public function create()
    {

        $trainers = Trainer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trainerExpenses.create', compact('trainers'));
    }

    public function store(StoreTrainerExpenseRequest $request)
    {
        $trainerExpense = TrainerExpense::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $trainerExpense->id]);
        }

        return redirect()->route('admin.trainer-expenses.index');
    }

    public function edit(TrainerExpense $trainerExpense)
    {

        $trainers = Trainer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trainerExpense->load('trainer');

        return view('admin.trainerExpenses.edit', compact('trainers', 'trainerExpense'));
    }

    public function update(UpdateTrainerExpenseRequest $request, TrainerExpense $trainerExpense)
    {
        $trainerExpense->update($request->all());

        return redirect()->route('admin.trainer-expenses.index');
    }

    public function show(TrainerExpense $trainerExpense)
    {

        $trainerExpense->load('trainer');

        return view('admin.trainerExpenses.show', compact('trainerExpense'));
    }

    public function destroy(TrainerExpense $trainerExpense)
    {

        $trainerExpense->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrainerExpenseRequest $request)
    {
        TrainerExpense::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {

        $model         = new TrainerExpense();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
