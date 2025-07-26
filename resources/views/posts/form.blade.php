<div class="mb-3">
    <label class="form-label">Tiêu đề</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Nội dung</label>
    <textarea name="content" class="form-control" rows="5" required>{{ old('content', $post->content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Thể loại</label>
    <select name="category_id" class="form-select" required>
        <option value="">-- Chọn thể loại --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" 
                {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Ảnh</label>
    <input type="file" name="image" class="form-control">
    @if (!empty($post->image))
        <img src="{{ asset('storage/' . $post->image) }}" width="150" class="mt-2">
    @endif
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
