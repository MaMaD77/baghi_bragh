<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Response;
use Illuminate\View\ComponentAttributeBag;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Project::query();

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

            $models = $query
                ->select('projects.*');

            return datatables()->eloquent($models)
                ->setRowId(function ($row) {
                    return $row->id;
                })
                ->editColumn('select', function ($row) {
                    return view('components.dashboard.fields.checkbox', [
                        'cols' => '',
                        'label' => '',
                        'attributes' => new ComponentAttributeBag([
                            'id' => 'project-' . $row->id,
                            'class' => 'project-checkboxes',
                        ])
                    ]);
                })
                ->editColumn('profile_type', function ($row) {
                    return $row->profile_type->description;
                })
                ->editColumn('profile', function ($row) {
                    return $row->profile->description;
                })
                ->editColumn('created_at', function ($row) {
                    return view('components.dashboard.sections.table-column-date-time', [
                        'datetime' => $row->created_at,
                    ]);
                })
                ->editColumn('deleted_at', function ($row) {
                    if ($row->trashed()) {
                        $value = view('components.dashboard.fields.pretty-switch', [
                            'cols' => '',
                            'label' => '',
                            'colorClass' => 'form-check-primary',
                            'attributes' => new ComponentAttributeBag([
                                'id' => 'delete-' . $row->id,
                                'data-id' => $row->id,
                                'data-project-action' => "restore",
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
                                'data-project-action' => "delete",
                                'checked' => true,
                                'title' => __('Delete'),
                            ]),
                        ]);
                    }
                    return $value;
                })
                ->addColumn('action', function ($row) {
                    $action_btns = '<div class="d-flex">
                            <a href="javascript:void(0)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-project-button" data-id="' . $row->id . '">
                                <i class="fa fa-edit fs-4"></i>
                            </a>
                        </div>';

                    return $action_btns;
                })
                ->rawColumns(['select', 'profile_type', 'profile', 'created_at', 'deleted_at', 'action'])
                ->toJson();
        }

        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route('dashboard'), 'name' => __('Dashboard')],
            ['name' => __('Projects')]
        ];

        return view('components.dashboard.models.project.pages.index', [
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
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->trashed()) {
            $project->restore();
            return response()->json(['message' => 'Project has been restored Successfully!.'], Response::HTTP_OK);
        } else {
            $project->delete();
            return response()->json(['message' => 'Project has been deleted Successfully!.'], Response::HTTP_OK);
        }
    }
}
