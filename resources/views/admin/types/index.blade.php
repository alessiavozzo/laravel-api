@extends('layouts.admin')

@section('content')
    {{-- @dd($types) --}}
    <section id="types-content">

        <div class="container" data-bs-theme="dash-dark">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- <a class="text-decoration-none d-flex justify-content-end my-4 new-type" href="{{ route('admin.types.create') }}">
                <i class="fa-solid fa-plus"></i>
            </a> --}}

            <a class="text-decoration-none d-flex justify-content-end my-4 new-type" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <i class="fa-solid fa-plus"></i>
            </a>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">New type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">

                    <form data-bs-theme="dash-dark" action="{{ route('admin.types.store') }}" method="post">
                        @csrf

                        {{-- name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>Name</strong></label>
                            <input type="text"
                                class="form-control  {{ session('form-name') === 'form-new' && $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" id="name" aria-describedby="nameHelper" placeholder="New type name"
                                value="{{ old('name') }}" />
                            <small id="nameHelper" class="form-text text-muted">Write type name</small>
                            @if (session('form-name') == 'form-new')
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label "><strong>Description</strong></label>
                            <textarea
                                class="form-control {{ session('form-name') === 'form-new' && $errors->has('description') ? 'is-invalid' : '' }}"
                                name="description" id="description" placeholder="A brief text describing the project type" rows="8">{{ old('description') }}</textarea>

                            @if (session('form-name') == 'form-new')
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <button class="btn add-btn text-white" type="submit">Add</button>

                    </form>



                </div>
            </div>

            @include('admin.partials.session-messages')

            <div class="row row-cols-sm-1 row-cols-md-3 gy-3">
                @forelse ($types as $type)
                    <div class="col">
                        <div class="card" style="border-color:{{ $type->color }}">
                            <div class="card-header text-center fw-bold" style="background-color:{{ $type->color }}"
                                style="border-color: {{ $type->color }}; color: black">
                                {{ $type->name }}
                            </div>
                            <div class="card-body">
                                {{-- <div class="card-text">{{ $type->slug }}</div> --}}
                                {{-- <a href="{{ route('admin.types.show', $type) }}" class="btn view-btn">Details</a> --}}

                                {{-- show details collapse menu --}}
                                <div class="show-details collapse position-relative"
                                    id="details-collapse-{{ $type->id }}">


                                    <div class="card-text mb-2">
                                        <strong style="color: {{ $type->color }}">ID: </strong>
                                        {{ $type->id }}
                                    </div>
                                    {{-- slug --}}
                                    <div class="card-text mb-2">
                                        <strong style="color: {{ $type->color }}">SLUG: </strong>
                                        {{ $type->slug }}
                                    </div>
                                    {{-- description --}}
                                    <div class="card-text mb-4">
                                        <strong style="color: {{ $type->color }}">DESCRIPTION: </strong>
                                        {{ $type->description }}
                                    </div>

                                    <button type="button" class="btn-close position-absolute top-0 end-0"
                                        data-bs-toggle="collapse" data-bs-target="#details-collapse-{{ $type->id }}"
                                        aria-expanded="false" aria-controls="details-collapse-{{ $type->id }}">
                                    </button>
                                </div>


                                {{-- show edit form collapse --}}
                                <div class="edit-content collapse position-relative"
                                    id="edit-collapse-{{ $type->id }}">

                                    <form data-bs-theme="dash-dark" action="{{ route('admin.types.update', $type) }}"
                                        method="post">
                                        @csrf

                                        @method('PUT')

                                        {{-- name --}}
                                        <div class="mb-3">
                                            <label for="name" class="form-label"><strong>Name</strong></label>
                                            <input type="text"
                                                class="form-control  {{ session('form-name') === "form-edit-{$type->id}" && $errors->has('name') ? 'is-invalid' : '' }}"
                                                name="name" id="name" aria-describedby="nameHelper"
                                                placeholder="Project name"
                                                value="{{ session('form-name') === 'form-edit-' . $type->id ? old('name', $type->name) : $type->name }} " />
                                            <small id="nameHelper" class="form-text text-muted">Edit type name</small>

                                            @if (session('form-name') === "form-edit-{$type->id}")
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>

                                        {{-- description --}}
                                        <div class="mb-3">
                                            <label for="description" class="form-label"><strong>Description</strong></label>
                                            <textarea
                                                class="form-control {{ session('form-name') === "form-edit-{$type->id}" && $errors->has('description') ? 'is-invalid' : '' }}"
                                                placeholder="A brief text describing the project type" name="description" id="description" rows="8">{{ session('form-name') === 'form-edit-' . $type->id ? old('description', $type->description) : $type->description }}</textarea>
                                            @if (session('form-name') === "form-edit-{$type->id}")
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>

                                        <button class="btn confirm-edit-btn mb-3 w-100" type="submit">Confirm
                                            changes</button>

                                        <button type="button" class="btn-close position-absolute top-0 end-0"
                                            data-bs-toggle="collapse" data-bs-target="#edit-collapse-{{ $type->id }}"
                                            aria-expanded="false" aria-controls="edit-collapse-{{ $type->id }}">
                                        </button>

                                    </form>


                                </div>

                                {{-- buttons --}}
                                <div class="buttons d-flex justify-content-center align-items-center gap-2">

                                    <a class="btn view-btn" data-bs-toggle="collapse"
                                        href="#details-collapse-{{ $type->id }}" role="button"
                                        aria-expanded="false" aria-controls="details-collapse-{{ $type->id }}">
                                        Details
                                    </a>
                                    {{-- <a href="{{ route('admin.types.edit', $type) }}" class="btn edit-btn">Edit</a> --}}
                                    <a class="btn edit-btn" data-bs-toggle="collapse"
                                        href="#edit-collapse-{{ $type->id }}" role="button" aria-expanded="false"
                                        aria-controls="edit-collapse-{{ $type->id }}">
                                        Edit
                                    </a>

                                    <button type="button" class="btn delete-btn" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $type->id }}">
                                        Delete
                                    </button>
                                    {{-- @include('admin.partials.type-delete') --}}
                                    <x-delete-modal :id="$type->id" :name="$type->name" :route="route('admin.types.destroy', $type)" />

                                </div>


                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p>No types defined</p>
                    </div>
                @endforelse
            </div>

        </div>

    </section>
@endsection
