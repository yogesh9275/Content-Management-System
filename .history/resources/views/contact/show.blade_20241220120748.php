@extends('layouts.home')

@section('title', 'Contact Details')

@section('page')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Contact Details</h1>
            <div class="card mt-4">
                <div class="card-header">
                    Contact: {{ $contact->name }}
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                    <p><strong>Mobile Number:</strong> {{ $contact->mo_no }}</p>
                    <p><strong>Message:</strong> {{ $contact->message }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back to Contacts</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
