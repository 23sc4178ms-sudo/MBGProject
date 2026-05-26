<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function maintenance(Request $request) {
        if ($request->isMethod('post')) {
            $page = $request->input('target_page');
            $mode = $request->input('mode');
            if ($mode === 'normal') {
                Cache::forget("maintenance_status.$page");
                return $this->adminAjaxResponse($request, ucfirst($page).' page is now back to normal!', route('maintenance.get'));
            } else {
                Cache::put("maintenance_status.$page", $mode);
                return $this->adminAjaxResponse($request, ucfirst($page).' page status updated!', route('maintenance.get'));
            }
        }
        // Get all statuses for display
        $pages = ['dashboard','students','degrees','courses','enrollments','users','profiles','posts'];
        $statuses = [];
        foreach ($pages as $p) {
            $statuses[$p] = Cache::get("maintenance_status.$p", 'normal');
        }
        return view('maintenance', compact('statuses'));
    }
    public function demo() {
        return view('demo');
    }
}
