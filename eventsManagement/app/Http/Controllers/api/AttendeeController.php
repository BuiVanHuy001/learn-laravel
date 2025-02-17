<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AttendeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('throttle:api')->only(['store', 'destroy', 'update']);
        $this->authorizeResource(Attendee::class, 'attendee');
    }

    public function index(Event $event): AnonymousResourceCollection
    {
        $attendees = $event->attendees()->latest();

        return AttendeeResource::collection($attendees->paginate());
    }

    public function store(Request $request, Event $event): AttendeeResource
    {
        $attendee = $event->attendees()->create([
            'user_id' => 1
        ]);
        return new AttendeeResource($attendee);
    }

    public function show(Event $event, Attendee $attendee): AttendeeResource
    {
        return new AttendeeResource($attendee);
    }

    public function destroy(Event $event, Attendee $attendee): Application|Response|ResponseFactory
    {
        $attendee->delete();

        return response(status: 204);
    }
}
