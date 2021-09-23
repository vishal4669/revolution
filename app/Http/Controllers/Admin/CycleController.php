<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCycleRequest;
use App\Http\Requests\StoreCycleRequest;
use App\Http\Requests\UpdateCycleRequest;
use App\Models\Cycle;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CycleController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('cycle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Cycle::query()->select(sprintf('%s.*', (new Cycle())->table));
            $table = Datatables::of($query);

            $table->addIndexColumn('');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cycle_show';
                $editGate = 'cycle_edit';
                $deleteGate = 'cycle_delete';
                $crudRoutePart = 'admin.cycles';

                return view('admin.partials.datatablesActions', compact(
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('photo', function ($row) {
                if (!$row->photo) {
                    return '';
                }
                $links = [];
                foreach ($row->photo as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('cycle_cost', function ($row) {
                return $row->cycle_cost ? $row->cycle_cost : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Cycle::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('serial_number', function ($row) {
                return $row->serial_number ? $row->serial_number : '';
            });
            $table->editColumn('rent_month', function ($row) {
                return $row->rent_month ? $row->rent_month : '';
            });
            $table->editColumn('rent_hour', function ($row) {
                return $row->rent_hour ? $row->rent_hour : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? 'Active' : 'Inactive';
            });
            $table->editColumn('is_rented', function ($row) {
                return $row->is_rented ? 'Rented' : 'Not Rented';
            });

            $table->rawColumns(['actions', 'srno', 'photo']);

            return $table->make(true);
        }

        return view('admin.cycles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cycle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.cycles.create');
    }

    public function store(StoreCycleRequest $request)
    {
        $request->is_active = 1;
        $cycle = Cycle::create($request->all());

        

        foreach ($request->input('photo', []) as $file) {
            $cycle->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cycle->id]);
        }

        return redirect()->route('admin.cycles.index');
    }

    public function edit(Cycle $cycle)
    {
        abort_if(Gate::denies('cycle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.cycles.edit', compact('cycle'));
    }

    public function update(UpdateCycleRequest $request, Cycle $cycle)
    {
        $cycle->update($request->all());

        if (count($cycle->photo) > 0) {
            foreach ($cycle->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $cycle->photo->pluck('file_name')->toArray();
        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $cycle->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.cycles.index');
    }

    public function show(Cycle $cycle)
    {
        abort_if(Gate::denies('cycle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.cycles.show', compact('cycle'));
    }

    public function destroy(Cycle $cycle)
    {
        abort_if(Gate::denies('cycle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cycle->delete();

        return back();
    }

    public function massDestroy(MassDestroyCycleRequest $request)
    {
        Cycle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('cycle_create') && Gate::denies('cycle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $model         = new Cycle();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function addReview(Request $request, $id)
    {
        $cycle = Cycle::find($id);
        $user = auth()->user();

        $cycle->makeReview($user, $request->rating, $request->review);

        return back();
    }
}
