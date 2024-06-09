@extends('layouts.admin')

@section('content')
    <section id="technologies-content">
        {{-- @dd($technologies) --}}
        <div class="container-fluid" data-bs-theme="dash-dark">
            <div class="row g-5">

                {{-- left --}}
                <div class="col-12 col-lg-4">

                    {{-- creation form: name, color and possibility to add logo img --}}

                    <form data-bs-theme="dash-dark" action="{{ route('admin.technologies.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="first-line mb-2 gap-2">
                            {{-- name --}}
                            <div class="name">
                                <input type="text"
                                    class="form-control {{ session('form-name') === 'form-new' && $errors->has('name') ? 'is-invalid' : '' }}"
                                    name="name" id="name" aria-describedby="nameHelper"
                                    placeholder="New technology name" value="{{ old('name') }}" />

                                @if (session('form-name') == 'form-new')
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            {{-- color --}}
                            <div class="color">
                                <input type="color"
                                    class="form-control h-100 {{ session('form-name') === 'form-new' && $errors->has('color') ? 'is-invalid' : '' }}"
                                    name="color" id="color" aria-describedby="colorHelper"
                                    value="{{ old('color', '#FFFFFF') }}" />

                                @if (session('form-name') == 'form-new')
                                    @error('color')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        </div>


                        {{-- image --}}
                        <div class="mb-2">
                            <input type="file"
                                class="form-control {{ session('form-name') === 'form-new' && $errors->has('image') ? 'is-invalid' : '' }}"
                                name="image" id="image" aria-describedby="imageHelper" value="{{ old('image') }}" />

                            @if (session('form-name') == 'form-new')
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <button class="btn add-btn text-white" type="submit">Add new technology</button>

                    </form>

                </div>

                {{-- right --}}
                <div class="col-12 col-lg-8 tech-table">
                    <div class="card p-4">
                        @include('admin.partials.session-messages')
                        <div class="table-responsive rounded">
                            <table data-bs-theme="dash-dark" class="table projects-table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th scope="col">NAME</th>
                                        <th scope="col">SLUG</th>
                                        <th scope="col">COLOR</th>
                                        <th scope="col">LOGO</th>
                                        <th scope="col">PROJECTS</th>
                                        <th scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($technologies as $technology)
                                        <tr class="align-middle">
                                            <td>
                                                {{-- form to edit NAME --}}
                                                <form data-bs-theme="dash-dark"
                                                    action="{{ route('admin.technologies.update', $technology) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="">
                                                        <a class="btn" data-bs-toggle="collapse"
                                                            href="#edit-collapse-{{ $technology->id }}" role="button"
                                                            aria-expanded="false"
                                                            aria-controls="edit-collapse-{{ $technology->id }}">
                                                            {{ $technology->name }}
                                                        </a>
                                                        <div class="collapse w-50"
                                                            id="edit-collapse-{{ $technology->id }}">

                                                            <input type="text"
                                                                class="form-control mb-2 edit-input {{ session('form-name') === "form-edit-{$technology->id}" && $errors->has('name') ? 'is-invalid' : '' }}"
                                                                name="name" id="name" aria-describedby="nameHelper"
                                                                value="{{ session('form-name') === 'form-edit-' . $technology->id ? old('name', $technology->name) : $technology->name }}" />

                                                            <button class="btn edit-btn" type="submit">Edit</button>
                                                        </div>

                                                        @if (session('form-name') === "form-edit-{$technology->id}")
                                                            @error('name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        @endif
                                                    </div>

                                                </form>

                                            </td>

                                            {{-- slug in autogenerated in technology controller --}}
                                            <td>{{ $technology->slug }}</td>

                                            <td>
                                                {{-- form to edit COLOR --}}
                                                <form data-bs-theme="dash-dark"
                                                    action="{{ route('admin.technologies.update', $technology) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="">
                                                        <a class="btn" data-bs-toggle="collapse"
                                                            href="#edit-collapse-{{ $technology->id }}-color"
                                                            role="button" aria-expanded="false"
                                                            aria-controls="edit-collapse-{{ $technology->id }}-color">
                                                            <div class="color-preview"
                                                                style="background-color:{{ $technology->color }}">
                                                            </div>
                                                        </a>
                                                        <div class="collapse w-50"
                                                            id="edit-collapse-{{ $technology->id }}-color">

                                                            <input type="hidden" name="name"
                                                                value="{{ $technology->name }}">

                                                            <div class="mb-2">
                                                                <input type="color"
                                                                    class="form-control {{ session('form-name') === "form-edit-{$technology->id}" && $errors->has('color') ? 'is-invalid' : '' }}"
                                                                    name="color" id="color"
                                                                    aria-describedby="colorHelper"
                                                                    value="{{ session('form-name') === 'form-edit-' . $technology->id ? old('color', $technology->color) : $technology->color }}" />

                                                                @if (session('form-name') === "form-edit-{$technology->id}")
                                                                    @error('color')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                @endif
                                                            </div>

                                                            <button class="btn edit-btn" type="submit">Edit</button>
                                                        </div>


                                                    </div>

                                                </form>
                                            </td>

                                            <td>
                                                {{-- form to edit IMAGE --}}
                                                <form data-bs-theme="dash-dark"
                                                    action="{{ route('admin.technologies.update', $technology) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')

                                                    {{--  @dd($technology->image) --}}
                                                    {{-- @dd(Storage::exists($technology->image)) --}}
                                                    <div class="">
                                                        <a class="btn" data-bs-toggle="collapse"
                                                            href="#edit-collapse-{{ $technology->id }}-image"
                                                            role="button" aria-expanded="false"
                                                            aria-controls="edit-collapse-{{ $technology->id }}-image">
                                                            @if ($technology->image)
                                                                <div class="old-image">
                                                                    {{-- if img exists in storage, render img, else if img exists in public/img,render img --}}
                                                                    @if (Storage::exists($technology->image))
                                                                        <img src="{{ Storage::disk('local')->url($technology->image) }}"
                                                                            alt="{{ $technology->name }}">
                                                                    @else
                                                                        <img src="{{ asset($technology->image) }}"
                                                                            alt="{{ $technology->name }}">
                                                                    @endif
                                                                </div>
                                                            @endif

                                                        </a>
                                                        <div class="collapse w-50"
                                                            id="edit-collapse-{{ $technology->id }}-image">

                                                            <input type="hidden" name="name"
                                                                value="{{ $technology->name }}">

                                                            <input type="file"
                                                                class="form-control {{ session('form-name') === "form-edit-{$technology->id}" && $errors->has('image') ? 'is-invalid' : '' }}"
                                                                name="image" id="image"
                                                                aria-describedby="imageHelper" />
                                                            @if (session('form-name') === "form-edit-{$technology->id}")
                                                                @error('image')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            @endif

                                                            <button class="btn edit-btn" type="submit">Edit</button>
                                                        </div>

                                                    </div>

                                                </form>
                                            </td>

                                            <td>
                                                {{-- show project with that technology + count them --}}
                                                <a href="{{ route('admin.technologies.show', $technology) }}"
                                                    class="btn view-btn text-white">View
                                                    projects ({{ $technology->projects()->count() }})</a>

                                            </td>

                                            {{-- delete --}}
                                            <td style="width: 15%">
                                                <button technology="button" class="btn delete-btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalId-{{ $technology->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <x-delete-modal :id="$technology->id" :name="$technology->name" :route="route('admin.technologies.destroy', $technology)" />

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
                    {{ $technologies->links('pagination::bootstrap-5') }}
                </div>

            </div>

        </div>
    </section>
@endsection
