<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCycleExpenseRequest;
use App\Http\Requests\StoreCycleExpenseRequest;
use App\Http\Requests\UpdateCycleExpenseRequest;
use App\Models\Cycle;
use App\Models\CycleExpense;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CycleExpensesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = CycleExpense::with(['cycle'])->select(sprintf('%s.*', (new CycleExpense())->table));
            $table = Datatables::of($query);

            $table->addIndexColumn();
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cycle_expense_show';
                $editGate = 'cycle_expense_edit';
                $deleteGate = 'cycle_expense_delete';
                $crudRoutePart = 'cycle-expenses';

                return view('admin.partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('cycle_name', function ($row) {
                return $row->cycle ? $row->cycle->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'cycle']);

            return $table->make(true);
        }

        return view('admin.cycleExpenses.index');
    }

    public function create()
    {

        $cycles = Cycle::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cycleExpenses.create', compact('cycles'));
    }

    public function store(StoreCycleExpenseRequest $request)
    {
        $cycleExpense = CycleExpense::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cycleExpense->id]);
        }

        return redirect()->route('admin.cycle-expenses.index');
    }

    public function edit(CycleExpense $cycleExpense)
    {

        $cycles = Cycle::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cycleExpense->load('cycle');

        return view('admin.cycleExpenses.edit', compact('cycles', 'cycleExpense'));
    }

    public function update(UpdateCycleExpenseRequest $request, CycleExpense $cycleExpense)
    {
        $cycleExpense->update($request->all());

        return redirect()->route('admin.cycle-expenses.index');
    }

    public function show(CycleExpense $cycleExpense)
    {

        $cycleExpense->load('cycle');

        return view('admin.cycleExpenses.show', compact('cycleExpense'));
    }

    public function destroy(CycleExpense $cycleExpense)
    {

        $cycleExpense->delete();

        return back();
    }

    public function massDestroy(MassDestroyCycleExpenseRequest $request)
    {
        CycleExpense::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {

        $model         = new CycleExpense();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
