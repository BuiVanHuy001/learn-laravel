<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Policies\EventPolicy;
use App\Trait\CanLoadRelationships;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    use CanLoadRelationships;

    private array $relations = ['user', 'attendees', 'attendees.user'];

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->middleware('throttle:api')->only(['store', 'update', 'destroy']);
        $this->authorizeResource(Event::class, 'event');
    }

    public function index(): AnonymousResourceCollection
    {
        $query = Event::query();
        $this->loadRelationships($query);
        return EventResource::collection($query->latest()->paginate());
    }

    public function store(Request $request): EventResource
    {
        $event = Event::create([
            ...$request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time'
            ]),
            'user_id' => $request->user->id
        ]);
        return new EventResource($this->loadRelationships($event));
    }


    public function show(Event $event): EventResource
    {
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request, Event $event): EventResource
    {
        $event->update(
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time'
            ])
        );

        return new EventResource($this->loadRelationships($event));
    }

    public function destroy(Event $event): Application|Response|ResponseFactory
    {
        $event->delete();

        return response(status: 204);
    }
}
