@section('title', 'Contacts')
@extends('layouts.home')

@section('page')
<div class="mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-6 text-3xl font-semibold text-dark">Contacts</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">Message</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->mo_no }}</td>
                            <td>
                                <div style="max-height: 3rem; max-width: 60rem; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $contact->message }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-primary">
                                    <x-bi-eye-fill />
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
