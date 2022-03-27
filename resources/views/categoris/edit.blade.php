<x-template.default>
    <x-slot name="title">Edit Category</x-slot>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Enter your category data</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('category.update', $category) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="Nama">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input Name Category" value="{{ $category->name }}">
                    @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('category.index') }}" class="btn btn-warning">Cancle</a>
                </div>
            </form>
        </div>
    </div>
</x-template.default>