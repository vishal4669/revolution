<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTestimonialRequest;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TestimonialsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        $testimonials = Testimonial::with(['user', 'media'])->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {

        $users = User::all();

        return view('admin.testimonials.create', compact('users'));
    }

    public function store(StoreTestimonialRequest $request)
    {
        $testimonial = Testimonial::create($request->all());

        if ($request->input('user_photo', false)) {
            $testimonial->addMedia(storage_path('tmp/uploads/' . basename($request->input('user_photo'))))->toMediaCollection('user_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $testimonial->id]);
        }

        return redirect()->route('admin.testimonials.index');
    }

    public function edit(Testimonial $testimonial)
    {

        $users = User::pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $testimonial->load('user');

        return view('admin.testimonials.edit', compact('users', 'testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $testimonial->update($request->all());

        if ($request->input('user_photo', false)) {
            if (!$testimonial->user_photo || $request->input('user_photo') !== $testimonial->user_photo->file_name) {
                if ($testimonial->user_photo) {
                    $testimonial->user_photo->delete();
                }
                $testimonial->addMedia(storage_path('tmp/uploads/' . basename($request->input('user_photo'))))->toMediaCollection('user_photo');
            }
        } elseif ($testimonial->user_photo) {
            $testimonial->user_photo->delete();
        }

        return redirect()->route('admin.testimonials.index');
    }

    public function show(Testimonial $testimonial)
    {

        $testimonial->load('user');

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function destroy(Testimonial $testimonial)
    {

        $testimonial->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestimonialRequest $request)
    {
        Testimonial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('testimonial_create') && Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Testimonial();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
