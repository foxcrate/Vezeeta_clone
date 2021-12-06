@extends('backEnd.dashbord.layout2')
@section('title','Patients')
@section('content')
@include('backEnd.dashbord.nav')
<div class="patient-section">
    <div class="container-fluid">
        <h4 class="mt-3 mb-3">Patients Sections</h4>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">FirstName</th>
                <th scope="col">LastName</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">BirthDate</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @isset($patients)
                    @foreach ($patients as $patient)
                        <tr>
                            <th scope="row">{{ $patient->id }}</th>
                            <td><img class="rounded" width="100" src="{{ $patient->image }}"></td>
                            <td>{{ $patient->firstName }}</td>
                            <td>{{ $patient->lastName }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->gender }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>
                                <a href="{{ route('patients.destroy',$patient->id) }}" class="btn btn-danger"><i class="fa fa-close"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
              @endisset
            </tbody>
          </table>
    </div>
</div>


@stop
