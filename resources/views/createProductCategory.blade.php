@include('includes.navigation')
<div class="container">
    <h2>Create Product Category</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('productcategories.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Product Category</button>
    </form>
</div>