<?php

namespace App\Http\Controllers;

use App\Models\Ubication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UbicationRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\NotificationService;
use App\Notifications\CreatedUbicationNotification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DeletedUbicationNotification;
use App\Notifications\UpdatedUbicationNotification;

class UbicationController extends Controller
{
    use AuthorizesRequests;

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Ubication::class);
        $ubications = Ubication::paginate(5);

        return view('ubication.index', compact('ubications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Ubication::class);
        $ubication = new Ubication();

        return view('ubication.create', compact('ubication'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UbicationRequest $request): RedirectResponse
    {
        $this->authorize('create', Ubication::class);
        $ubication = Ubication::create($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new CreatedUbicationNotification($ubication, Auth::user()));

        return Redirect::route('ubications.index')
            ->with('success', 'Ubication created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $ubication = Ubication::findOrFail($id);
        $this->authorize('view', $ubication);

        return view('ubication.show', compact('ubication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $ubication = Ubication::findOrFail($id);
        $this->authorize('update', $ubication);

        return view('ubication.edit', compact('ubication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UbicationRequest $request, Ubication $ubication): RedirectResponse
    {
        $this->authorize('update', $ubication);
        $ubication->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new UpdatedUbicationNotification($ubication, Auth::user()));

        return Redirect::route('ubications.index')
            ->with('success', 'Ubication updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $ubication = Ubication::findOrFail($id);
        $this->authorize('delete', $ubication);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new DeletedUbicationNotification($ubication, Auth::user()));
        $ubication->delete();

        return Redirect::route('ubications.index')
            ->with('success', 'Ubication deleted successfully');
    }
}
