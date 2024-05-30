@extends('layouts.admin')

@section('content')
    <div class="projects_header bg-section-dark py-2">
        <a href="{{ route('admin.projects.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            <span>back</span>
        </a>
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="text-light">Edit project {{ $project->title }}</h2>
        </div>
    </div>
    <section id="edit_form" class="py-3 bg-section mb-5">
        <div class="container">

            <form data-bs-theme="dash-dark" class="form-control p-4 edit-project"
                action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
                @csrf

                @method('PUT')

                {{-- title --}}
                <div class="mb-3">
                    <label for="title" class="form-label"><strong>Title</strong></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" aria-describedby="titleHelper" placeholder="title"
                        value="{{ old('title', $project->title) }}" />
                    <small id="titleHelper" class="form-text text-muted">Edit the project title</small>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- slug --}}
                {{-- lo slug lo genero dietro le quinte, non devo inserirlo io --}}

                {{-- project image --}}
                {{-- <div class="mb-3">
                    <label for="project_image" class="form-label">project_image</label>
                    <input type="text" class="form-control @error('project_image') is-invalid @enderror"
                        name="project_image" id="project_image" aria-describedby="project_imageHelper"
                        placeholder="project_image" value="{{ old('project_image', $project->project_image) }}" />
                    <small id="project_imageHelper" class="form-text text-muted">Add a link to project image</small>
                    @error('project_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="mb-3 d-flex gap-3 align-items-center">
                    @if ($project->project_image)
                        <div class="old-image">
                            @if (Str::startsWith($project->project_image, 'https://'))
                                <img width="150" src="{{ $project->project_image }}" alt="{{ $project->title }}">
                            @else
                                <img width="150" src="{{ asset('storage/' . $project->project_image) }}"
                                    alt="{{ $project->title }}">
                            @endif
                        </div>
                    @endif
                    <div class="input-container w-100">
                        <label for="project_image" class="form-label"><strong>Image</strong></label>
                        <input type="file" class="form-control @error('project_image') is-invalid @enderror"
                            name="project_image" id="project_image" aria-describedby="project_imageHelper"
                            placeholder="project_image" />
                        <small id="project_imageHelper" class="form-text text-muted">Upload an image showing the project
                            preview</small>
                        @error('project_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                {{-- type --}}
                <div class="mb-3">
                    <label for="type_id" class="form-label"><strong>Type</strong></label>
                    <select class="form-select form-select" name="type_id" id="type_id">
                        <option selected disabled>Select type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach

                    </select>
                </div>

                {{-- technologies --}}
                <span class="mb-2 d-block"><strong>Technologies</strong></span>
                <div class="">
                    {{-- se ci sono errori di validazione voglio i campi compilati così come li ho lasciati prima di sbagliare la validazione --}}
                    {{-- di partenza voglio vedere le tech checkate già da prima --}}
                    @foreach ($technologies as $technology)
                        <div class="form-check form-check-inline">

                            @if ($errors->any())
                                <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                                    id="tech-{{ $technology->id }}" name="technologies[]"
                                    {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} />
                                <label class="form-check-label" for="tech-{{ $technology->id }}"> {{ $technology->name }}
                                </label>
                            @else
                                {{-- @dd($project->technologies) --}}

                                <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                                    id="tech-{{ $technology->id }}" name="technologies[]"
                                    {{ $project->technologies->contains($technology->id) ? 'checked' : '' }} />
                                <label class="form-check-label" for="tech-{{ $technology->id }}"> {{ $technology->name }}
                                </label>
                            @endif

                        </div>
                    @endforeach
                </div>
                @error('technologies')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror

                {{-- preview --}}
                <div class="mb-3">
                    <label for="preview" class="form-label"><strong>Preview</strong></label>
                    <input type="text" class="form-control @error('preview') is-invalid @enderror" name="preview"
                        id="preview" aria-describedby="previewHelper" placeholder="preview"
                        value="{{ old('preview', $project->preview) }}" />
                    <small id="previewHelper" class="form-text text-muted">Edit link to preview video</small>
                    @error('preview')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- tools --}}
                {{-- <div class="mb-3">
                    <label for="tools" class="form-label">tools</label>
                    <input type="text" class="form-control @error('tools') is-invalid @enderror" name="tools"
                        id="tools" aria-describedby="toolsHelper" placeholder="tools"
                        value="{{ old('tools', $project->tools) }}" />
                    <small id="toolsHelper" class="form-text text-muted">Write the tools you used for the project</small>
                    @error('tools')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- project link --}}
                <div class="mb-3">
                    <label for="project_link" class="form-label"><strong>Project link</strong></label>
                    <input type="text" class="form-control @error('project_link') is-invalid @enderror"
                        name="project_link" id="project_link" aria-describedby="project_linkHelper"
                        placeholder="project_link" value="{{ old('project_link', $project->project_link) }}" />
                    <small id="project_linkHelper" class="form-text text-muted">Edit project link</small>
                    @error('project_link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- github link --}}
                <div class="mb-3">
                    <label for="github_link" class="form-label"><strong>Github link</strong></label>
                    <input type="text" class="form-control @error('github_link') is-invalid @enderror"
                        name="github_link" id="github_link" aria-describedby="github_linkHelper"
                        placeholder="github_link" value="{{ old('github_link', $project->github_link) }}" />
                    <small id="github_linkHelper" class="form-text text-muted">Edit github link</small>
                    @error('github_link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- creation date --}}
                <div class="mb-3">
                    <label for="creation_date" class="form-label"><strong>Creation date</strong></label>
                    <input type="date" class="form-control @error('creation_date') is-invalid @enderror"
                        name="creation_date" id="creation_date" aria-describedby="creation_dateHelper"
                        placeholder="creation_date" value="{{ old('creation_date', $project->creation_date) }}" />
                    <small id="creation_dateHelper" class="form-text text-muted">Edit the date the project was
                        created</small>
                    @error('creation_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description --}}
                <div class="mb-3">
                    <label for="description"
                        class="form-label @error('description') is-invalid @enderror"><strong>Description</strong></label>
                    <textarea class="form-control" name="description" id="description" rows="8">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn edit-btn" type="submit">Edit project</button>


            </form>
        </div>

    </section>
@endsection
