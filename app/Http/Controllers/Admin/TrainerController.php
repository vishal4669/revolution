<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTrainerRequest;
use App\Http\Requests\StoreTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use App\Models\Trainer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TrainerController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = Trainer::query()->select(sprintf('%s.*', (new Trainer())->table));
            $table = Datatables::of($query);

            $table->addIndexColumn('');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'trainer_show';
                $editGate = 'trainer_edit';
                $deleteGate = 'trainer_delete';
                $crudRoutePart = 'trainers';

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
            $table->editColumn('trainer_cost', function ($row) {
                return $row->trainer_cost ? $row->trainer_cost : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Trainer::TYPE_SELECT[$row->type] : '';
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
                return $row->is_active ? Trainer::IS_ACTIVE_RADIO[$row->is_active] : '';
            });
            $table->editColumn('is_rented', function ($row) {
                return $row->is_rented ? Trainer::IS_RENTED_RADIO[$row->is_rented] : '';
            });

            $table->rawColumns(['actions', '', 'photo']);

            return $table->make(true);
        }

        return view('admin.trainers.index');
    }

    public function create()
    {

        return view('admin.trainers.create');
    }

    public function store(StoreTrainerRequest $request)
    {
        $trainer = Trainer::create($request->all());

        foreach ($request->input('photo', []) as $file) {
            $trainer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $trainer->id]);
        }

        return redirect()->route('admin.trainers.index');
    }

    public function edit(Trainer $trainer)
    {

        return view('admin.trainers.edit', compact('trainer'));
    }

    public function update(UpdateTrainerRequest $request, Trainer $trainer)
    {
        $trainer->update($request->all());

        if (count($trainer->photo) > 0) {
            foreach ($trainer->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $trainer->photo->pluck('file_name')->toArray();
        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $trainer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.trainers.index');
    }

    public function show(Trainer $trainer)
    {
        abort_if(Gate::denies('trainer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trainers.show', compact('trainer'));
    }

    public function destroy(Trainer $trainer)
    {

        $trainer->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrainerRequest $request)
    {
        Trainer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {

        $model         = new Trainer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function addReview(Request $request, $id)
    {
        $trainer = Trainer::find($id);
        $user = auth()->user();

        $trainer->makeReview($user, $request->rating, $request->review);

        return back();
    }
}
