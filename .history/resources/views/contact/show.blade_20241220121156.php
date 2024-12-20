@extends('layouts.home')

@section('title', 'Contact Details')

@section('page')
<div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f8f9fa; border-radius: 8px;">
    <h1 style="color: #007bff;">Contact Details</h1>
    <div style="background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <h4 style="border-bottom: 2px solid #007bff; padding-bottom: 8px; color: #343a40;">{{ $contact->name }}</h4>

        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Mobile Number:</strong> {{ $contact->mo_no }}</p>
        <p><strong>Message:</strong></p>
        <p style="background-color: #f1f1f1; padding: 10px; border-radius: 4px; word-wrap: break-word;">{{ $contact->message }}</p>

        <div style="margin-top: 20px;">
            <a href="{{ route('contacts.index') }}" style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px; display: inline-block;">
                Back to Contacts
            </a>
        </div>
    </div>
</div>
@endsection
