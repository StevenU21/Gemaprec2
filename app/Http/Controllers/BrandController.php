<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\User;
use App\Notifications\CreatedBrandNotification;
use App\Notifications\DeletedBrandNotification;
use App\Notifications\UpdatedBrandNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class BrandController extends Controller
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
        $this->authorize('viewAny', Brand::class);
        $brands = Brand::paginate(5);

        return view('brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Brand::class);
        $brand = new Brand();

        return view('brand.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request): RedirectResponse
    {
        $this->authorize('create', Brand::class);

        // Crear la marca
        $brand = Brand::create($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new CreatedBrandNotification($brand, Auth::user()));

        return Redirect::route('brands.index')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $brand = Brand::findOrFail($id);
        $this->authorize('view', $brand);

        return view('brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $brand = Brand::findOrFail($id);
        $this->authorize('update', $brand);

        return view('brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand): RedirectResponse
    {
        $this->authorize('update', $brand);

        $brand->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new UpdatedBrandNotification($brand, Auth::user()));

        return Redirect::route('brands.index')
            ->with('success', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $brand = Brand::findOrFail($id);
        $this->authorize('delete', $brand);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new DeletedBrandNotification($brand, Auth::user()));

        $brand->delete();

        return Redirect::route('brands.index')
            ->with('success', 'Brand deleted successfully');
    }
}
