@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="py-1 h-screen rounded-xl">
                <div class="bg-gray-900 h-full text-white shadow-md rounded-xl p-2">
                    <div class="h-full flex flex-col justify-between">
                        {{-- top information --}}
                        <div class="rounded-tr-md rounded-tl-md bg-gray-100 overflow-auto h-full p-2">
                            <div class="sticky-top text-gray-900 text-3xl mb-3">
                                <div class="mb-5">
                                    <span class="font-serif">
                                        Dr. {{auth()->user()->firstname}}
                                            {{auth()->user()->lastname}}
                                    </span>
                                </div>
                            </div>
                            <appointment-time :user="{{ auth()->user() }}" />
                        </div>
                        {{--/ top information --}}
                        
                        {{-- acction buttons --}}
                        <div class="md:px-1 md:py-2">
                            
                            {{-- <div class="flex grid grid-cols-3 space-x-1">
                                <a href="{{route('bookappt')}}" class="btn btn-sm text-white bg-blue-600 border-r-4 border-blue-600 text-xl font-bold py-4">Book Appt</a>
                                <a href="" class="btn btn-sm text-white bg-red-600 py-4 px-2 text-lg font-bold">Virtual Consultation</a>
                                <a href="" class="btn btn-sm text-white bg-green-600 border-l-4 border-green-600 text-xl font-bold py-4">Profile & Results</a>
                            </div> --}}
                        </div>
                        {{--/ acction buttons --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

