<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>To Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4db6ac, #26a69a);
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 60px; /* Adjust for navbar height */
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .container {
            background-color: #e0f7fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
        }

        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card-body {
            padding: 25px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 6px;
            padding: 10px 15px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 6px;
            padding: 10px 15px;
        }

        .btn-secondary:hover {
            background-color: #545b62;
            border-color: #4e555b;
        }

        .list-group-item {
            border: 1px solid #f0f0f0;
            border-radius: 6px;
            margin-bottom: 8px;
            padding: 15px;
            background-color: #fff;
        }

        .list-group-item del {
            color: #888;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .edit-btn {
            margin-left: 5px;
        }

        .radio {
            margin-right: 15px;
        }

        .pagination .page-link {
            border-radius: 6px;
            margin-right: 5px;
            border-color: #ddd;
            color: #333;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-group button {
            height: 30px;
            width: 30px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            font-size: 1em;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Farrel Alfared Carasiola</div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">To Do List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card mb-3">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- 02. Form input data -->
                    <form id="todo-form" action="{{ route('todo.post') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="task" id="todo-input"
                                placeholder="Add New Task" required value="{{ old('task') }}">
                            <button class="btn btn-primary" type="submit">
                                Save
                            </button>
                        </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="todo-form" action="{{ route('todo') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                    placeholder="Enter keyword">
                                <button class="btn btn-secondary" type="submit">
                                    Search
                                </button>
                            </div>
                        </form>
                        
                        <ul class="list-group mb-4" id="todo-list">
                            @foreach ($data as $item)
                            <!-- 04. Display Data -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="task-text">
                                    {!! $item -> is_done == '1'?'<del>':'' !!}
                                    {{ $item -> task}}
                                    {!! $item -> is_done == '1'?'</del>':'' !!}
                                </span>
                                <input type="text" class="form-control edit-input" style="display: none;"
                                value="{{ $item -> task}}">
                                <div class="btn-group">
                                    <form action="{{ route('todo.delete', ['id' => $item -> id]) }}" method="POST" onsubmit="return confirm('Yakin akan menghapus data?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete-btn">✕</button>
                                    </form>
                                    <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $loop -> index }}" aria-expanded="false">✎</button>
                                </div>
                            </li>
                            <!-- 05. Update Data -->
                            <li class="list-group-item collapse" id="collapse-{{ $loop -> index }}">
                                <form action="{{ route('todo.update', ['id' => $item -> id]) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="task"
                                            value="{{ $item -> task}}">
                                            <button class="btn btn-outline-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="radio px-2">
                                            <label>
                                                <input type="radio" value="1" name="is_done" {{ $item -> is_done == '1'?'checked':'' }}> Done
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="0" name="is_done" {{ $item -> is_done == '0'?'checked':'' }}> Not yet
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                        {{ $data -> links() }}
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>