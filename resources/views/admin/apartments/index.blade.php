@extends('layouts.admin')

@section('content')
    <div class="container mt-4">

        <h1>Lista appartamenti</h1>

        <div class="my-4 d-flex justify-content-end">
            <a class="btn btn-bnb mt-2 rounded-pill d-flex justify-content-center align-items-center"
                href="{{ route('admin.apartments.create') }}" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                <span class="ms-2">Aggiungi Appartamento</span>
            </a>
        </div>

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }} 🤩
            </div>
        @endif

        <div class="pt-2">
            {{ $apartments->links('pagination::bootstrap-5') }}
        </div>
        <div class="wrapper my-2">
            @forelse ($apartments as $apartment)
                <div class="card border-0 border-top rounded-0">
                    <div class="card-body row row-cols-1 row-cols-md-5 justify-content-between px-0">
                        <div class="d-flex align-items-center">
                            @if ($apartment->images->where('is_main', true)->first()?->path)
                                <img style="height:60px"
                                    src="{{ asset('storage/' . $apartment->images->where('is_main', true)->first()->path) }}">
                            @else
                                <img style="height:60px" src="{{ asset('storage/placeholders/placeholder.jpg') }}">
                            @endif
                        </div>
                        <div class="row row-cols-2 row-cols-md-1 align-items-center my-1">
                            <div>
                                <strong>Titolo</strong>:
                            </div>
                            <div>
                                {{ $apartment->title }}
                            </div>
                        </div>
                        <div class="row row-cols-2 row-cols-md-1 align-items-center my-1">
                            <div>
                                <strong>Indirizzo</strong>:
                            </div>
                            <div>
                                {{ $apartment->address ? $apartment->address : 'Non Impostato' }}
                            </div>
                        </div>
                        <div class="row row-cols-2 row-cols-md-1 align-items-center my-1">
                            <div>
                                <strong>Visibile su BoolBnB</strong>:
                            </div>
                            <div>
                                {{ $apartment->is_visible ? 'Si' : 'No' }}
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <a class="btn btn-light rounded-circle border bnb-btn-shadow me-1 bnb-btn-actions"
                                href="{{ route('admin.apartments.show', $apartment->id) }}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg>
                            </a>
                            <a class="btn btn-success rounded-circle border bnb-btn-shadow me-1 bnb-btn-actions"
                                href="{{ route('admin.apartments.images.index', $apartment) }}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-images" viewBox="0 0 16 16">
                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                    <path
                                        d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10" />
                                </svg>
                            </a>
                            <a class="btn btn-warning rounded-circle border bnb-btn-shadow me-1 bnb-btn-actions"
                                href="{{ route('admin.apartments.edit', $apartment->id) }}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                            <!-- MODAL DELETE -->
                            <button type="button"
                                class="btn btn-danger rounded-circle border bnb-btn-shadow ms-1 bnb-btn-actions"
                                data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $apartment->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                </svg>
                            </button>
                            <div class="modal fade" id="deleteModal-{{ $apartment->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">
                                                Eliminare appartamento?
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <span class="mx-1">
                                                <i class="fa-solid fa-circle-exclamation fa-lg" style="color: #e00b41;"></i>
                                                <span class="mx-1">
                                                    <strong>Attenzione</strong>: questa azione è
                                                    irreversibile e verranno eliminati immagini e messaggi
                                                    correlati a questo appartamento
                                                </span>
                                            </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    Non sono ancora stati caricati appartamenti!
                </div>
            @endforelse
        </div>

    </div>
@endsection
