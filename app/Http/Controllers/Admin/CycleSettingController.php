<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCycleSettingRequest;
use App\Http\Requests\StoreCycleSettingRequest;
use App\Http\Requests\UpdateCycleSettingRequest;
use App\Models\Cycle;
use App\Models\CycleSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CycleSettingController extends Controller
{
    public function index()
    {
        $cycleSettings = CycleSetting::with(['cycle'])->get();

        return view('admin.cycleSettings.index', compact('cycleSettings'));
    }

    public function create()
    {
        $cycles = Cycle::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cycleSettings.create', compact('cycles'));
    }

    public function store(StoreCycleSettingRequest $request)
    {
        $cycleSetting = CycleSetting::create($request->all());

        return redirect()->route('admin.cycle-settings.index');
    }

    public function edit(CycleSetting $cycleSetting)
    {
        $cycles = Cycle::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cycleSetting->load('cycle');

        return view('admin.cycleSettings.edit', compact('cycles', 'cycleSetting'));
    }

    public function update(UpdateCycleSettingRequest $request, CycleSetting $cycleSetting)
    {
        $cycleSetting->update($request->all());

        return redirect()->route('admin.cycle-settings.index');
    }

    public function show(CycleSetting $cycleSetting)
    {
        $cycleSetting->load('cycle');

        return view('admin.cycleSettings.show', compact('cycleSetting'));
    }

    public function destroy(CycleSetting $cycleSetting)
    {
        $cycleSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyCycleSettingRequest $request)
    {
        CycleSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
