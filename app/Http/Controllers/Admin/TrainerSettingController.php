<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTrainerSettingRequest;
use App\Http\Requests\StoreTrainerSettingRequest;
use App\Http\Requests\UpdateTrainerSettingRequest;
use App\Models\Trainer;
use App\Models\TrainerSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrainerSettingController extends Controller
{
    public function index()
    {
        $trainerSettings = TrainerSetting::with(['trainer'])->get();

        return view('admin.trainerSettings.index', compact('trainerSettings'));
    }

    public function create()
    {
        $trainerSettings = TrainerSetting::pluck('id')->toArray();
        dd($trainerSettings);
        $trainers = Trainer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trainerSettings.create', compact('trainers'));
    }

    public function store(StoreTrainerSettingRequest $request)
    {
        $trainerSetting = TrainerSetting::create($request->all());

        return redirect()->route('admin.trainer-settings.index');
    }

    public function edit(TrainerSetting $trainerSetting)
    {
        $trainers = Trainer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trainerSetting->load('trainer');

        return view('admin.trainerSettings.edit', compact('trainers', 'trainerSetting'));
    }

    public function update(UpdateTrainerSettingRequest $request, TrainerSetting $trainerSetting)
    {
        $trainerSetting->update($request->all());

        return redirect()->route('admin.trainer-settings.index');
    }

    public function show(TrainerSetting $trainerSetting)
    {
        $trainerSetting->load('trainer');

        return view('admin.trainerSettings.show', compact('trainerSetting'));
    }

    public function destroy(TrainerSetting $trainerSetting)
    {
        $trainerSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrainerSettingRequest $request)
    {
        TrainerSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
