<?php

namespace App\Http\Controllers;

use Auth;
use Flash;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Update according to roles
        // switch (Auth::user()->roles->first()->id) {
        //     case config("enums.roles.SUPER_ADMIN.id"):
                if (\Request::routeIs(["home"])) {
                    return response(view("home"));
                } else {
                    return redirect(route("home"));
                }
        //     break;

        //     case config("enums.roles.HOLDING_ADMIN.id"):
        //         return redirect(route("holdings.dashboard", [Auth::user()->holding_id]));
        //     break;

        //     case config("enums.roles.COMPANY_ADMIN.id"):
        //         return redirect(route('companies.dashboard', [Auth::user()->holding_id, Auth::user()->company_id]));
        //     break;

        //     case config("enums.roles.SUBSIDIARY_ADMIN.id"):
        //         return redirect(route('mySubsidiaries.index', [Auth::user()->holding_id, Auth::user()->company_id]));
        //     break;

        //     case config("enums.roles.COMMON.id"):
        //         return redirect(route('mySubsidiaries.index', [Auth::user()->holding_id, Auth::user()->company_id]));
        //     break;

        //     default:
        //         Auth::logout();
        //         Flash::error(Lang::get('flash.invalid_login'));
        //         return redirect(route('login'));
        //     break;
        // }
    }
}
