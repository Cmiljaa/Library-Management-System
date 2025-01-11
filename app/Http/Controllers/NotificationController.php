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
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index(): View
    {
        return view('users.notifications', ['notifications' => Auth::user()->notifications]);
    }

    public function destroy(DatabaseNotification $notification): RedirectResponse
    {
        $this->notificationService->deleteNotification($notification);
        return redirect()->back()->with('success', 'Overdue fee successfully paid');
    }
}
