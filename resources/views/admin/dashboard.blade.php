@extends('layouts.admin')

@section('content')
    <div class="container" data-bs-theme="dash-dark">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        {{-- @dd($lastProject->title) --}}
        <div class="row">
            <div class="col col-12 col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Last project</h4>
                    </div>
                    <div class="card-body">
                        <div class="top w-100 d-flex align-items-center gap-3">
                            <div class="col-4">
                                @if (Str::startsWith($lastProject->project_image, 'https://'))
                                    <img class="mb-3 w-100" src="{{ $lastProject->project_image }}"
                                        alt="{{ $lastProject->title }}" />
                                @else
                                    <img class="mb-3 w-100" loading="lazy"
                                        src="{{ asset('storage/' . $lastProject->project_image) }}"
                                        alt="{{ $lastProject->title }}">
                                @endif
                            </div>
                            <div class="col-8">

                                {{-- title --}}
                                <h5 class="card-text text-center mb-5">
                                    {{ $lastProject->title }}
                                </h5>
                                {{-- project link --}}
                                <div class="card-text mb-2">
                                    <strong>PROJECT LINK: </strong>
                                    <a class="text-decoration-none" href="{{ $lastProject->project_link }}"
                                        target="_blank">{{ $lastProject->project_link }}</a>
                                </div>
                                {{-- github link --}}
                                <div class="card-text mb-2">
                                    <strong>GITHUB LINK: </strong>
                                    <a class="text-decoration-none" href="{{ $lastProject->github_link }}"
                                        target="_blank">{{ $lastProject->github_link }}</a>
                                </div>
                            </div>

                        </div>
                        {{-- description --}}
                        <div class="card-text mb-2">
                            <strong>DESCRIPTION: </strong>
                            {{ $lastProject->description ? $lastProject->description : 'N/A' }}
                        </div>

                        @if ($lastProject->type)
                            {{-- type --}}
                            <div class="card-text mb-2">
                                <strong class="pe-2">TYPE:</strong>
                                <div class="type-badge text-white p-2 d-inline-block text-center {{ $lastProject->type ? '' : 'disabled ?>' }}"
                                    style="background-color: {{ $lastProject->type ? $lastProject->type->color : 'grey' }}">
                                    {{ $lastProject->type ? $lastProject->type->name : 'Not defined' }}
                                </div>

                            </div>
                        @endif

                        @if (count($lastProject->technologies) > 0)
                            {{-- technologies --}}
                            <div class="card-text mb-2">
                                <strong class="pe-2">TECHNOLOGIES:</strong>
                                @foreach ($lastProject->technologies as $technology)
                                    <div class="badge rounded-pill" style="background-color: {{ $technology->color }}">
                                        {{ $technology->name }}</div>
                                @endforeach

                            </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-4">
                <a href="{{ route('admin.projects.index') }}" class="dash-card proj-card">Projects</a>
            </div>
            <div class="col-4">
                <a href="{{ route('admin.types.index') }}" class="dash-card types-card">Types overview</a>
            </div>
            <div class="col-4">
                <a href="{{ route('admin.technologies.index') }}" class="dash-card tech-card">Technologies overview</a>
            </div>
        </div>
    @endsection
