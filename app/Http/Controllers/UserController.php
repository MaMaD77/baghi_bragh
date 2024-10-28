<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\ComponentAttributeBag;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::query();

            if (request()->filled('created_at')) {
                $created_at_range = explode(' to ', request()->created_at);
                $from_at = $created_at_range[0];
                $to_at = $created_at_range[1] ?? $created_at_range[0];

                $query->whereDate('created_at', '>=', $from_at)->whereDate('created_at', '<=', $to_at);
            }

            if (request()->filled('show')) {
                if (request()->show == 'passive') {
                    $query->onlyTrashed();
                }
                if (request()->show == 'active') {
                    $query->withoutTrashed();
                }
            } else {
                $query->withoutTrashed();
            }

            $users = $query
                ->select('users.*');

            return datatables()->eloquent($users)
                ->setRowId(function ($row) {
                    return $row->id;
                })
                ->editColumn('select', function ($row) {
                    return view('components.dashboard.fields.checkbox', [
                        'cols' => '',
                        'label' => '',
                        'attributes' => new ComponentAttributeBag([
                            'id' => 'user-' . $row->id,
                            'class' => 'user-checkboxes',
                        ])
                    ]);
                })
                ->editColumn('name', function ($row) {
                    return  '<div class="d-flex align-items-center">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <a class="symbol symbol-45px me-5" data-fslightbox="user-image" data-type="image" href="' . $row->profile_photo_url . '">
                                        <img class="cover" src="' . ($row->profile_photo_url) . '">
                                    </a>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-900 fs-6 fw-bolder">' . str($row->name)->limit(40) . '</span>
                                    </div>
                                </div>
                            </div>';
                })
                ->editColumn('created_at', function ($row) {
                    return view('components.dashboard.sections.table-column-date-time', [
                        'datetime' => $row->created_at,
                    ]);
                })
                ->editColumn('deleted_at', function ($row) {
                    $value = '';
                    if ($row->trashed()) {
                        $value = view('components.dashboard.fields.pretty-switch', [
                            'cols' => '',
                            'label' => '',
                            'colorClass' => 'form-check-primary',
                            'attributes' => new ComponentAttributeBag([
                                'id' => 'delete-' . $row->id,
                                'data-id' => $row->id,
                                'data-user-action' => "restore",
                                'checked' => false,
                                'title' => __('Restore'),
                            ]),
                        ]);
                    } else {
                        $value = view('components.dashboard.fields.pretty-switch', [
                            'cols' => '',
                            'label' => '',
                            'colorClass' => 'form-switch-danger',
                            'attributes' => new ComponentAttributeBag([
                                'id' => 'delete-' . $row->id,
                                'data-id' => $row->id,
                                'data-user-action' => "delete",
                                'checked' => true,
                                'title' => __('Delete'),
                            ]),
                        ]);
                    }
                    return $value;
                })
                ->addColumn('action', function ($row) {
                    $action_btns = '<div class="d-flex">';

                    $action_btns .= '<a href="' . route('user.show', $row->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <i class="fa fa-eye fs-4"></i>
                        </a>';

                    $action_btns .= '<button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="fa fa-ellipsis-v fs-3"></i>
                                        </button>';

                    $action_btns .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4" data-kt-menu="true">';
                    $action_btns .= '<div class="menu-item px-3">
                                                <a href="javascript:;" class="menu-link px-3 edit-user-button" data-id="' . $row->id . '"><i class="fa fa-edit me-1"></i> Edit</a>
                                            </div>';

                    $action_btns .= '</div>';

                    $action_btns .= '</div>';

                    return $action_btns;
                })
                ->rawColumns(['select', 'name', 'mobile_number', 'created_at', 'deleted_at', 'action'])
                ->toJson();
        }

        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route('dashboard'), 'name' => __('Dashboard')],
            ['name' => __('Users')]
        ];

        return view('components.dashboard.models.user.pages.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route('dashboard'), 'name' => __('Dashboard')],
            ['link' => route('company.index'), 'name' => __('Companies')],
            ['name' => __('Show User', ['id' => $user?->id])]
        ];

        return view('components.dashboard.models.user.pages.show', [
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->trashed()) {
            $user->restore();
            return response()->json(['message' => 'User has been restored Successfully!.'], Response::HTTP_OK);
        } else {
            $user->delete();
            $user->tokens()->delete();
            DB::table(config('session.table', 'sessions'))
                ->where('user_id', $user->getAuthIdentifier())
                ->delete();
            return response()->json(['message' => 'User has been deleted Successfully!.'], Response::HTTP_OK);
        }
    }
}
