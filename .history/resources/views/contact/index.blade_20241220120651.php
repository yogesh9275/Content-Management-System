@section('title', 'Contacts')
@extends('layouts.home')

@section('page')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Contacts</h1>
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile Number</th>
                        <th scope="col">Message</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->mo_no }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>
                                public function show(Contact $contact)
                                {
                                    //
                                }
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
