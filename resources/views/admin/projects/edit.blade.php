@extends('layouts.admin.app')

@section('content')
    <div class="container">

        <h2 class="fs-4 text-secondary my-4">
            {{ __('Project Edit Page for') }} {{ Auth::user()->name }}.
        </h2>
        <h3 class="fs-5 text-secondary">
            {{ __('Editing Project') }} ID: {{ $project->id }}
        </h3>

        <div class="row justify-content-center my-3">
            <div class="col">

                @include('admin.projects.partials.error_alert')

                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @method('PUT')

                    <div class="mb-3">

                        <label for="title" class="form-label"><strong>Title</strong></label>

                        <input type="text" class="form-control" name="title" id="title"
                            aria-describedby="helpTitle" value="{{ old('title') ? old('title') : $project->title }}">

                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label for="description" class="form-label"><strong>Description</strong></label>

                        <textarea class="form-control" name="description" id="description" aria-describedby="helpTitle" cols="30"
                            rows="5">{{ old('description') ? old('description') : $project->description }}</textarea>

                        {{-- OLD FORM --}}
                        {{-- <input type="text" class="form-control" name="description" id="description"
                            aria-describedby="helpTitle"
                            value="{{ old('description') ? old('description') : $project->description }}"> --}}

                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label for="tech" class="form-label"><strong>Technologies Used</strong></label>

                        <input type="text" class="form-control" name="tech" id="tech"
                            aria-describedby="helpTitle" value="{{ old('tech') ? old('tech') : $project->tech }}">

                        @error('tech')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label for="github" class="form-label"><strong>GitHub Link</strong></label>

                        <input type="text" class="form-control" name="github" id="github"
                            aria-describedby="helpTitle" value="{{ old('github') ? old('github') : $project->github }}">

                        @error('github')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label for="link" class="form-label"><strong>Project Link</strong></label>

                        <input type="text" class="form-control" name="link" id="link"
                            aria-describedby="helpTitle" value="{{ old('link') ? old('link') : $project->link }}">

                        @error('link')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <div class="mb-3">

                            @if (str_contains($project->thumb, 'http'))
                                <td><img class=" img-fluid" style="height: 100px" src="{{ $project->thumb }}"
                                        alt="{{ $project->title }}"></td>
                            @else
                                <td><img class=" img-fluid" style="height: 100px"
                                        src="{{ asset('storage/' . $project->thumb) }}"></td>
                            @endif

                        </div>

                        <label for="thumb" class="form-label"><strong>Choose a Thumbnail image file</strong></label>

                        <input type="file" class="form-control" name="thumb" id="thumb" placeholder="Cerca..."
                            aria-describedby="fileHelpThumb">

                        @error('thumb')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <button type="submit" class="btn btn-success my-3"><i class="fa-solid fa-floppy-disk"></i>
                        Save</button>
                    <a class="btn btn-primary" href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-ban"></i>
                        Cancel</a>

                </form>
            </div>
        </div>

        {{-- <h1>ADMIN/PROJECTS/EDIT.BLADE</h1> --}}
    </div>
@endsection
