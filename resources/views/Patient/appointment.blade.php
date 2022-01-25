@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="py-1 h-screen rounded-xl">
                <div class="bg-white h-full shadow-md rounded-xl p-2">
                    <div class="flex flex-col justify-between md:p-3">
                        <div class="text-3xl font-bold opacity-50">Book Appointment</div>
                        <div>
                            <patient-appt />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

