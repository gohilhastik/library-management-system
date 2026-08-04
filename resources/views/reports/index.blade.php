@extends('layouts.app')

@section('title', 'Reports')

@section('content')

<div class="container">

    <h2 class="mb-4">

        Reports

    </h2>

    <div class="row">

        <div class="col-md-6 mb-4">

            <div class="card border-primary">

                <div class="card-body text-center">

                    <h4>Issued Books Report</h4>

                    <p>
                        View all currently issued books.
                    </p>

                    <a href="{{ route('reports.issued') }}"
                       class="btn btn-primary">

                        View Report

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card border-success">

                <div class="card-body text-center">

                    <h4>Returned Books Report</h4>

                    <p>
                        View all returned books.
                    </p>

                    <a href="{{ route('reports.returned') }}"
                       class="btn btn-success">

                        View Report

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card border-warning">

                <div class="card-body text-center">

                    <h4>Overdue Books Report</h4>

                    <p>
                        View books whose due date has passed.
                    </p>

                    <a href="{{ route('reports.overdue') }}"
                       class="btn btn-warning">

                        View Report

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card border-info">

                <div class="card-body text-center">

                    <h4>Student History</h4>

                    <p>
                        View issue history for a specific student.
                    </p>

                    <a href="{{ route('students.index') }}"
                       class="btn btn-info">

                        Select Student

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection