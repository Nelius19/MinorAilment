@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="py-1 h-screen rounded-xl">
                <div class="bg-gray-500 h-full text-white shadow-md rounded-xl p-2">
                    <div class="h-full flex flex-col justify-between">
                        <div class="table-responsive p-3">
                            <table class="table text-white">
                                <thead class="bg-gray-100 text-gray-900">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Email Address</th>
                                        <th scope="col">Appointment Date</th>
                                        <th scope="col">Appointment Nature</th>
                                        <th scope="col">Issue</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apptDetails as $key => $apptDetail)
                                    <tr>
                                        <th scope="row">{{$key + 1}}</th>
                                        <td>{{$apptDetail->firstname}}</td>
                                        <td>{{$apptDetail->lastname}}</td>
                                        <td>{{$apptDetail->email}}</td>
                                        <td>{{$apptDetail->appointment_date}}</td>
                                        <td>{{$apptDetail->appt_nature}}</td>
                                        <td>{{$apptDetail->issue}}</td>
                                        <td>
                                            <a href="#" class="">
                                                <form action="{{route('deleteappt', $apptDetail->user_id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a class="text-center">
                                                        <button type="submit" class="btn btn-sm shadow-sm font-bold focus:border-outline-none bg-red-900">
                                                            <i class="fas fa-trash-alt text-yellow-400 px-1"></i>
                                                        </button>
                                                    </a>
                                                </form>
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
        </div>
    </div>
</div>
@endsection

