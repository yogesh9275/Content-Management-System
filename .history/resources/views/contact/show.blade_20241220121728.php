@extends('layouts.home')

@section('title', 'Contact Details')

@section('page')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Contact Details</h1>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title"><sContact: </strong>{{ $contact->name }}</h5>
                </div>
                <div class="card-body">
                    <!-- Email and Mobile Number in a Row -->
                    <div class="row mb-3">
                        <div class="col-md-6 d-flex align-items-center">
                            <!-- Email Icon and Email -->
                            <x-simpleline-envolope class="icon-size" style="font-size: 24px; color: #007bff; margin-right: 10px;"/>
                            <p style="margin-bottom: 0"><strong>Email:</strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <!-- Phone Icon and Mobile Number -->
                            <i class="fa fa-phone" style="font-size: 24px; color: #28a745; margin-right: 10px;"></i>
                            <p style="margin-bottom: 0"><strong>Mobile Number:</strong> {{ $contact->mo_no }}</p>
                        </div>
                    </div>

                    <!-- Message in a Styled Container -->
                    <div class="message-container" style="background-color: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #dee2e6; word-wrap: break-word;">
                        <p><strong>Message:</strong></p>
                        <p>{{ $contact->message }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back to Contacts</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
