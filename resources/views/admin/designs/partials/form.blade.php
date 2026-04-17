<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" value="{{ old('title', $design->title ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $design->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" name="image" class="form-control">
    <small class="text-secondary d-block mt-2">Upload a new image to replace the current one. Max size: 2MB.</small>
    @if(!empty($design?->image))
        <div class="mt-3">
            <p class="mb-2 text-secondary">Current image</p>
            <img src="{{ asset('storage/'.$design->image) }}" alt="{{ $design->title }}" class="rounded-3 border border-secondary-subtle" style="width: 160px; height: 160px; object-fit: cover;">
        </div>
    @endif
</div>
