<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;


class AdminController extends Controller
{
    public function setting()
    {
        return View('admin.setting');
    }

    public function update(SettingRequest $request, Setting $Request)
    {
        $setting = new setting();
        $setting->emailAppro = $request->emailAppro;
        $setting->delaiRev = $request->delaiRev;
        $setting->tailleMax = $request->tailleMax;
        $setting->emailFinance = $request->emailFinance;
        $setting->save();

        return redirect()->route('admin.setting');
    }





}
