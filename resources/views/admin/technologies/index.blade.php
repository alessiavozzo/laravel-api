@extends('layouts.admin')

@section('content')
    <section id="technologies-content">
        {{-- @dd($technologies) --}}
        <div class="container-fluid" data-bs-theme="dash-dark">
            <div class="row g-5">


                <div class="col-12 col-lg-4">
                    <form data-bs-theme="dash-dark" action="{{ route('admin.technologies.store') }}" method="post">
                        @csrf


                        <div class="mb-2">
                            <input type="text"
                                class="form-control {{ session('form-name') === 'form-new' && $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" id="name" aria-describedby="nameHelper"
                                placeholder="New technology name" value="{{ old('name') }}" />

                            {{-- <input type="hidden" name="form-name" value="form-new" /> --}}

                            @if (session('form-name') == 'form-new')
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <button class="btn add-btn text-white" type="submit">Add new technology</button>

                    </form>

                    {{-- @dd(session()->all())
                    @dd(session('form-name')) --}}

                </div>

                <div class="col-12 col-lg-8">
                    <div class="card p-4">
                        @include('admin.partials.session-messages')
                        <div class="table-responsive rounded">
                            <table data-bs-theme="dash-dark" class="table projects-table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th scope="col">NAME</th>
                                        <th scope="col">SLUG</th>
                                        <th scope="col">PROJECTS</th>
                                        <th scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($technologies as $key=>$technology)
                                        <tr class="align-middle">
                                            <td>
                                                <form data-bs-theme="dash-dark"
                                                    action="{{ route('admin.technologies.update', $technology) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')

                                                    {{-- name --}}
                                                    <div class="">
                                                        <a class="btn" data-bs-toggle="collapse"
                                                            href="#edit-collapse-{{ $technology->id }}" role="button"
                                                            aria-expanded="false"
                                                            aria-controls="edit-collapse-{{ $technology->id }}">
                                                            {{ $technology->name }}
                                                        </a>
                                                        <div class="collapse w-50" id="edit-collapse-{{ $technology->id }}">

                                                            <input type="text"
                                                                class="form-control mb-2 edit-input {{ session('form-name') === "form-edit-{$technology->id}" && $errors->has('name') ? 'is-invalid' : '' }}"
                                                                name="name" id="name" aria-describedby="nameHelper"
                                                                value="{{ session('form-name') === 'form-edit-' . $technology->id ? old('name', $technology->name) : $technology->name }}" />


                                                            {{-- <input type="hidden" name="form-name"
                                                                value="form-edit-{{ $technology->id }}" /> --}}

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

                                            {{-- <td scope="row">{{ $technology->name }}</td> --}}

                                            <td>{{ $technology->slug }}</td>

                                            <td>
                                                <a href="{{ route('admin.technologies.show', $technology) }}"
                                                    class="btn view-btn text-white">View
                                                    projects ({{ $technology->projects()->count() }})</a>

                                            </td>


                                            <td style="width: 15%">
                                                {{-- @include('admin.partials.project-delete') --}}
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

            {{-- <a class="text-decoration-none d-flex justify-content-end my-4 new-type"
                href="{{ route('admin.technologies.create') }}">
                <i class="fa-solid fa-plus"></i>
            </a>
 --}}



            {{-- @include('admin.partials.session-messages') --}}

            {{-- <div class="row row-cols-sm-1 row-cols-md-3 gy-3">
                @forelse ($technologies as $technology)
                    <div class="col">
                        <div class="card" style="border-color:{{ $technology->color }}">
                            <div class="card-header text-center fw-bold">
                                {{ $technology->name }}
                            </div>
                            <div class="card-body text-center">
                                
                                <a href="{{ route('admin.technologies.show', $technology) }}"
                                    class="btn view-btn text-white">View
                                    projects</a>
                                <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn edit-btn">Edit</a>

                                <button technology="button" class="btn delete-btn" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $technology->id }}">
                                    Delete
                                </button>
                                <x-delete-modal :id="$technology->id" :name="$technology->name" :route="route('admin.technologies.destroy', $technology)" />



                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p>No technologies defined</p>
                    </div>
                @endforelse
            </div> --}}



        </div>
    </section>
@endsection
