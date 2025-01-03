<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        return view('user.notifications', ['notifications' => Auth::user()->notifications]);
    }

    public function destroy(DatabaseNotification $notification)
    {
        $this->notificationService->deleteNotification($notification);
        return redirect()->back()->with('success', 'Overdue fee successfully paid');
    }
}
