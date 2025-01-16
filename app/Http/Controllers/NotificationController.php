<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(): View
    {
        return view('users.notifications', ['notifications' => Auth::user()->notifications]);
    }

    public function destroy(DatabaseNotification $notification, NotificationService $notificationService): RedirectResponse
    {
        $notificationService->deleteNotification($notification);
        return redirect()->back()->with('success', 'Overdue fee successfully paid');
    }
}
