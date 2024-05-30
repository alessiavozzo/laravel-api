@extends('layouts.admin')

@section('content')
    <section id="all_projects" class="mb-5">


        <div class="card projects-card">
            <div class="card-header px-4 py-3 d-flex justify-content-between align-items-center">
                <h3 class="text-white">My Projects</h3>
                <div class="add-filter d-flex gap-5 justify-content-center align-items-center">

                    {{-- Filter by type --}}

                    <form data-bs-theme="dash-dark" class="d-flex justify-content-end align-items-center gap-2"
                        action="{{ route('admin.projects.index') }}" method="get">
                        {{-- type --}}
                        <div class="">
                            <select class="form-select form-select" name="type_id" id="type_id">
                                <option selected disabled>All</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn filter-btn" type="submit">Filter</button>
                        <a class="btn filter-btn" href="{{ route('admin.projects.index') }}">Cancel</a>
                    </form>

                    <a class="btn add-btn" href="{{ route('admin.projects.create') }}">Add new project</a>
                </div>
            </div>

            <div class="card-body p-4">
                @include('admin.partials.session-messages')
                <div class="table-responsive rounded">
                    <table data-bs-theme="dash-dark" class="table projects-table table-hover m-0">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">TITLE</th>
                                {{-- <th scope="col">SLUG</th> --}}
                                <th scope="col">PROJECT IMAGE</th>
                                <th scope="col">TECHNOLOGIES</th>
                                <th scope="col">PREVIEW</th>
                                {{-- <th scope="col">TOOLS</th> --}}
                                <th scope="col">PROJECT LINK</th>
                                <th scope="col">GITHUB LINK</th>
                                <th scope="col">TYPE</th>
                                <th scope="col">CREATION DATE</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($projects as $project)
                                <tr class="align-middle">
                                    <td scope="row">{{ $project->id }}</td>
                                    <td>{{ $project->title }}</td>
                                    {{-- <td>{{ $project->slug }}</td> --}}
                                    <td>
                                        {{-- <img width="100" src="{{ $project->project_image }}" alt="{{ $project->title }}"> --}}
                                        @if (Str::startsWith($project->project_image, 'https://'))
                                            <img width="100" loading="lazy" src="{{ $project->project_image }}"
                                                alt="{{ $project->title }}">
                                        @else
                                            <img width="100" loading="lazy"
                                                src="{{ asset('storage/' . $project->project_image) }}"
                                                alt="{{ $project->title }}">
                                        @endif
                                    </td>
                                    <td style="width: 15%">
                                        @foreach ($project->technologies as $tech)
                                            <div class="badge rounded-pill" style="background-color: {{ $tech->color }}">
                                                {{ $tech->name }}</div>
                                        @endforeach
                                    </td>

                                    <td><a class="td-link text-decoration-none text-white"
                                            href="{{ $project->preview }}">Video link</a></td>
                                    {{-- <td>{{ $project->tools }}</td> --}}
                                    <td><a class="td-link text-decoration-none text-white"
                                            href="{{ $project->project_link }}">Project link</a>
                                    </td>
                                    <td><a class="td-link text-decoration-none text-white"
                                            href="{{ $project->github_link }}">Github link</a>
                                    </td>

                                    <td>
                                        @if ($project->type)
                                            <div class="badge p-2" style="background-color: {{ $project->type->color }}"
                                                href="{{ route('admin.types.show', $project->type) }}">
                                                {{ $project->type->name }}</div>
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>{{ $project->creation_date }}</td>
                                    <td style="width: 15%">
                                        <a class="btn view-btn" href="{{ route('admin.projects.show', $project) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn edit-btn" href="{{ route('admin.projects.edit', $project) }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>

                                        <button type="button" class="btn delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $project->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        {{-- @include('admin.partials.project-delete') --}}
                                        <x-delete-modal :id="$project->id" :name="$project->title" :route="route('admin.projects.destroy', $project)" />

                                    </td>
                                </tr>

                            @empty

                                <tr class="">
                                    <td scope="row" colspan="6">No projects found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
        {{ $projects->links('pagination::bootstrap-5') }}
        {{-- @dd($projects) --}}




    </section>
@endsection
