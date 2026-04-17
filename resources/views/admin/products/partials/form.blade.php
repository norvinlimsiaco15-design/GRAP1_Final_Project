<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Discount %</label>
        <input type="number" step="0.01" name="discount_percent" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}" class="form-control">
    </div>
</div>
<div class="row g-3 mt-1">
    <div class="col-md-6">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Sizes (comma-separated)</label>
        <input type="text" name="sizes" value="{{ old('sizes', $product->sizes ?? '') }}" class="form-control">
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Product Image</label>
    <input type="file" name="image" class="form-control">
    <small class="text-secondary d-block mt-2">Upload a new image to replace the current one. Max size: 2MB.</small>
    @if(!empty($product?->image))
        <div class="mt-3">
            <p class="mb-2 text-secondary">Current image</p>
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="rounded-3 border border-secondary-subtle" style="width: 160px; height: 160px; object-fit: cover;">
        </div>
    @endif
</div>
<div class="form-check mt-3">
    <input type="checkbox" name="is_new_arrival" value="1" class="form-check-input" @checked(old('is_new_arrival', $product->is_new_arrival ?? false))>
    <label class="form-check-label">New Arrival</label>
</div>
