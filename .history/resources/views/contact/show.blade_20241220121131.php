@extends('layouts.home')

@section('title', 'Contact Details')

@section('page')
<div style="max-width: 800px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f7f7f7; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <!-- Header with Title -->
    <div style="text-align: center;">
        <h1 style="color: #343a40;">Contact Details</h1>
        <p style="font-size: 18px; color: #6c757d;">#{{ $contact->id }}</p>
    </div>

    <!-- Table displaying Contact Information -->
    <table style="width: 100%; border-collapse: collapse; margin-top: 30px; border: 1px solid #dee2e6; background-color: #ffffff;">
        <tr>
            <th style="padding: 12px; text-align: left; background-color: #f8f9fa; border: 1px solid #dee2e6;">Field</th>
            <th style="padding: 12px; text-align: left; background-color: #f8f9fa; border: 1px solid #dee2e6;">Details</th>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #dee2e6; font-weight: bold;">Name</td>
            <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $contact->name }}</td>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #dee2e6; font-weight: bold;">Email</td>
            <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $contact->email }}</td>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #dee2e6; font-weight: bold;">Mobile Number</td>
            <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $contact->mo_no }}</td>
        </tr>
        <tr>
            <td style="padding: 12px; border: 1px solid #dee2e6; font-weight: bold;">Message</td>
            <td style="padding: 12px; border: 1px solid #dee2e6; background-color: #f1f1f1; word-wrap: break-word;">{{ $contact->message }}</td>
        </tr>
    </table>

    <!-- Footer with Action Button -->
    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('contacts.index') }}" style="background-color: #007bff; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-size: 16px;">
            Back to Contacts
        </a>
    </div>
</div>
@endsection
