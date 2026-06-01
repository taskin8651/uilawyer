<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AdminNotificationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notifications = AdminNotification::latest()->get();

        return view('admin.notifications.index', compact('notifications'));
    }

    public function show(AdminNotification $notification)
    {
        abort_if(Gate::denies('notification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (! $notification->read_at) {
            $notification->update(['read_at' => now()]);
        }

        return view('admin.notifications.show', compact('notification'));
    }

    public function markRead(AdminNotification $notification)
    {
        abort_if(Gate::denies('notification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notification->update(['read_at' => now()]);

        return back()->with('message', 'Notification marked as read.');
    }

    public function destroy(AdminNotification $notification)
    {
        abort_if(Gate::denies('notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notification->delete();

        return back()->with('message', 'Notification deleted successfully.');
    }
}
