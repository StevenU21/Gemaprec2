<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Notifications\CreatedClientNotification;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use App\Notifications\DeletedClientNotification;
use App\Notifications\UpdatedClientNotification;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
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

    public function index(Request $request)
    {
        $this->authorize('viewAny', Client::class);

        if ($request->ajax()) {
            $data = Client::visibleToUser();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('clients.show', $row->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-eye"></i> Mostrar</a>';
                    $btn .= ' <a href="' . route('clients.edit', $row->id) . '" class="btn btn-sm btn-success"><i class="fa fa-fw fa-edit"></i> Editar</a>';
                    $btn .= ' <form action="' . route('clients.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Estas seguro que deseas eliminar?\')"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('client.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Client::class);
        $client = new Client();
        $user = new User();
        $client->user()->associate($user);

        return view('client.create', compact('client', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request): RedirectResponse
    {
        $this->authorize('create', Client::class);

        $email = $request->email;
        $password = Hash::make($email);
        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => $password,
        ]);
        $user->assignRole('client');

        $client = Client::create($request->validated() + [
            'user_id' => $user->id,
            'created_by' => auth()->id(),
        ]);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new CreatedClientNotification($client, Auth::user()));

        return Redirect::route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $client = Client::find($id);
        $this->authorize('view', $client);
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $client = Client::find($id);
        $this->authorize('update', $client);
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $this->authorize('update', $client);
        $client->update($request->validated());

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new UpdatedClientNotification($client, Auth::user()));

        return Redirect::route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $client = Client::find($id);
        $this->authorize('delete', $client);

        // Enviar la notificación a los usuarios seleccionados
        $this->notificationService->notifyAdminsAndEmployees(new DeletedClientNotification($client, Auth::user()));
        $client->delete();

        return Redirect::route('clients.index')
            ->with('success', 'Client deleted successfully');
    }
}
