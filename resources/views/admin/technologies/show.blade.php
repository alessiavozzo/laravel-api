@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.technologies.index') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        <span>back</span>
    </a>
    <section id="proj_with_technology" class="mb-5 ">
        <div class="container">
            <div class="card projects-card">
                <div class="card-header px-4 py-3 d-flex justify-content-between align-items-center">
                    <h3 class="text-white">My Projects with {{ $technology->name }}</h3>

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
                                    <th scopre="col">TECHNOLOGIES</th>
                                    <th scope="col">TYPE</th>
                                    <th scope="col">CREATION DATE</th>
                                    <th scope="col">VIEW PROJECT</th>
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

                                        <td>
                                            @foreach ($project->technologies as $tech)
                                                <div class="badge rounded-pill"
                                                    style="background-color: {{ $tech->color }}">{{ $tech->name }}</div>
                                            @endforeach
                                        </td>

                                        <td>
                                            @if ($project->type)
                                                <a class=" type-link text-decoration-none badge p-2"
                                                    style="background-color: {{ $project->type->color }}"
                                                    href="{{ route('admin.types.show', $project->type) }}">{{ $project->type->name }}</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td>{{ $project->creation_date }}</td>
                                        <td style="width: 15%">
                                            <a class="btn view-btn" href="{{ route('admin.projects.show', $project) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

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

        </div>
        {{-- {{ $projects->links('pagination::bootstrap-5') }} --}}
        {{-- @dd($projects) --}}




    </section>
@endsection
