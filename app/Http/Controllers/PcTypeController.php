<?php

namespace App\Http\Controllers;

use App\Models\PcType;
use App\Notifications\CreatedPcTypeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PcTypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class PcTypeController extends Controller
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
        $this->authorize('viewAny', PcType::class);
        $pcTypes = PcType::paginate(5);

        return view('pc-type.index', compact('pcTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', PcType::class);
        $pcType = new PcType();

        return view('pc-type.create', compact('pcType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PcTypeRequest $request): RedirectResponse
    {
        $this->authorize('create', PcType::class);
        $pcType = PcType::create($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new CreatedPcTypeNotification($pcType, Auth::user()));

        return Redirect::route('pc-types.index')
            ->with('success', 'PcType created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pcType = PcType::findOrFail($id);
        $this->authorize('view', $pcType);

        return view('pc-type.show', compact('pcType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pcType = PcType::findOrFail($id);
        $this->authorize('update', $pcType);

        return view('pc-type.edit', compact('pcType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PcTypeRequest $request, PcType $pcType): RedirectResponse
    {
        $this->authorize('update', $pcType);
        $pcType->update($request->validated());

        return Redirect::route('pc-types.index')
            ->with('success', 'PcType updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $pcType = PcType::findOrFail($id);
        $this->authorize('delete', $pcType);
        $pcType->delete();

        return Redirect::route('pc-types.index')
            ->with('success', 'PcType deleted successfully');
    }
}
