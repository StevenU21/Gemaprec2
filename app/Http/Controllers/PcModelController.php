<?php

namespace App\Http\Controllers;

use App\Models\PcModel;
use App\Notifications\CreatedPcModelNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PcModelRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UpdatedPcModelNotification;
use App\Notifications\DeletedPcModelNotification;

class PcModelController extends Controller
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
        $this->authorize('viewAny', PcModel::class);
        $pcModels = PcModel::paginate(5);

        return view('pc-model.index', compact('pcModels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', PcModel::class);
        $pcModel = new PcModel();

        return view('pc-model.create', compact('pcModel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PcModelRequest $request): RedirectResponse
    {
        $this->authorize('create', PcModel::class);
        $pcModel = PcModel::create($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new CreatedPcModelNotification($pcModel, Auth::user()));

        return Redirect::route('pc-models.index')
            ->with('success', 'PcModel created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pcModel = PcModel::findOrFail($id);
        $this->authorize('view', $pcModel);

        return view('pc-model.show', compact('pcModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pcModel = PcModel::findOrFail($id);
        $this->authorize('update', $pcModel);

        return view('pc-model.edit', compact('pcModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PcModelRequest $request, PcModel $pcModel): RedirectResponse
    {
        $this->authorize('update', $pcModel);
        $pcModel->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new UpdatedPcModelNotification($pcModel, Auth::user()));

        return Redirect::route('pc-models.index')
            ->with('success', 'PcModel updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $pcModel = PcModel::findOrFail($id);
        $this->authorize('delete', $pcModel);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new DeletedPcModelNotification($pcModel, Auth::user()));

        $pcModel->delete();

        return Redirect::route('pc-models.index')
            ->with('success', 'PcModel deleted successfully');
    }
}
