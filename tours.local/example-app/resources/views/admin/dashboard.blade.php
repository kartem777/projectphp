@extends('layouts.navigationadmin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 20px;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        h3 {
            font-size: 1.8rem;
        }
        .list-group-item {
            font-size: 1.1rem;
        }
        .stat-card {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .stat-card h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        .stat-card p {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <section class="welcome-section">
            <h1>Welcome to the Admin Panel</h1>
        </section>

        <section class="dashboard-statistics-section">
            <div class="row">
                <div class="col-md-6">
                    <h3>Dashboard</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#">Manage Users</a></li>
                        <li class="list-group-item"><a href="#">Manage Posts</a></li>
                        <li class="list-group-item"><a href="/admin/tours/index">Manage Tours</a></li>
                        <li class="list-group-item"><a href="#">Manage Feedbacks</a></li>
                        <li class="list-group-item"><a href="/admin/cities/index">Manage Cities</a></li>
                        <li class="list-group-item"><a href="/admin/countries/index">Manage Countries</a></li>
                        <li class="list-group-item"><a href="/admin/tags/index">Manage Tags</a></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h3>Statistics</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="stat-card">
                                <h4>User Count</h4>
                                <p>{{ $userCount }} users</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="stat-card">
                                <h4>Post Count</h4>
                                <p>{{ $postCount }} posts</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="stat-card">
                                <h4>Tour Count</h4>
                                <p>{{ $tourCount }} tours</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="stat-card">
                                <h4>Feedback Count</h4>
                                <p>{{ $feedbackCount }} feedbacks</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="stat-card">
                                <h4>City Count</h4>
                                <p>{{ $cityCount }} cities</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="stat-card">
                                <h4>Country Count</h4>
                                <p>{{ $countryCount }} countries</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="stat-card">
                                <h4>Tag Count</h4>
                                <p>{{ $tagCount }} tags</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
