@extends('layouts.admin')

@section('title', 'التصنيفات')
@section('subtitle', 'إدارة تصنيفات الكتب')

@section('content')

    <div class="page-heading">
        <div>
            <h1>التصنيفات</h1>
            <p>نظّم الكتب ضمن رفوف واضحة تسهّل على القارئ الوصول إليها.</p>
        </div>

        <button type="button" id="openCategoryModalBtn" class="btn btn-primary">
            <x-icon name="plus" :size="16" />
            <span>إضافة تصنيف</span>
        </button>
    </div>

    <form class="card toolbar" method="GET" action="{{ route('admin.categories.index') }}">
        <div class="search-box">
            <x-icon name="search" :size="17" />
            <input class="control" type="search" name="q" value="{{ request('q') }}"
                placeholder="ابحث باسم التصنيف أو وصفه...">
        </div>

        <button class="btn btn-primary" type="submit">بحث</button>

        @if (request()->has('q'))
            <a class="btn btn-outline" href="{{ route('admin.categories.index') }}">مسح</a>
        @endif
    </form>

    <div class="card table-card">
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>التصنيف</th>
                        <th>الوصف</th>
                        <th>الصورة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                <div class="book-cell">
                                    <div class="category-thumb">
                                        @if ($category->image)
                                            <img src="{{ $category->image }}" alt="{{ $category->category_name }}"
                                                loading="lazy" onerror="this.remove()">
                                        @else
                                            <x-icon name="folders" :size="20" />
                                        @endif
                                    </div>

                                    <div class="cell-main">
                                        <strong>{{ $category->category_name }}</strong>
                                        <span>#{{ $category->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <td>{{ $category->description ?: '—' }}</td>

                            <td>
                                @if ($category->image)
                                    <a href="{{ $category->image }}" target="_blank" rel="noopener">
                                        عرض الصورة
                                    </a>
                                @else
                                    —
                                @endif
                            </td>

                            <td>
                                <div class="table-actions">

                                    <a href="{{ route('admin.categories.show', ['category' => $category->id]) }}"
                                        class="table-icon" title="عرض">
                                        <x-icon name="eye" :size="15" />
                                    </a>

                                    <button type="button" class="table-icon open-edit-category"
                                        data-id="{{ $category->id }}"
                                        data-url="{{ route('admin.categories.update', $category->id) }}"
                                        data-name="{{ $category->category_name }}"
                                        data-description="{{ $category->description }}"
                                        data-image="{{ $category->image }}" title="تعديل">
                                        <x-icon name="edit" :size="15" />
                                    </button>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('هل تريد حذف التصنيف {{ $category->category_name }}؟')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="table-icon danger" title="حذف">
                                            <x-icon name="trash" :size="15" />
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <strong>لا توجد تصنيفات</strong>
                                    <span>أضف تصنيفاً جديداً أو غيّر عبارة البحث.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-pagination :paginator="$categories" />

    <div id="categoryModal" class="modal-overlay" style="display: none;">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="categoryModalTitle">إضافة تصنيف</h3>
                <span id="closeCategoryModalBtn" class="close-btn">&times;</span>
            </div>

            <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <input type="hidden" name="_method" id="categoryMethod" value="POST">

                <div class="form-grid">

                    <div class="form-field full">
                        <label for="categoryName">اسم التصنيف *</label>
                        <input type="text" id="categoryName" name="CategoryName" class="control" maxlength="100"
                            value="{{ old('CategoryName') }}" required>
                        @error('CategoryName')
                            <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field full">
                        <label for="categoryDescription">الوصف</label>
                        <textarea id="categoryDescription" name="Description" class="control" maxlength="255">{{ old('Description') }}</textarea>
                        @error('Description')
                            <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                        @enderror
                        <span class="hint">حد أقصى 255 حرفاً.</span>
                    </div>

                    <div class="form-field full">
                        <label for="categoryImage">رابط صورة التصنيف</label>
                        <input type="url" id="categoryImage" name="URLImage" class="control"
                            value="{{ old('URLImage') }}" placeholder="https://example.com/category.jpg">
                        @error('URLImage')
                            <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                        @enderror
                        <span class="hint">أدخل رابط الصورة.</span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" id="cancelCategoryModalBtn" class="control"
                        style="width: auto; cursor: pointer;">
                        إلغاء
                    </button>

                    <button type="submit" id="categorySubmitBtn" class="control"
                        style="width: auto; background: var(--accent-deep); color: #fff; border-color: var(--accent-deep); cursor: pointer;">
                        إضافة التصنيف
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('categoryModal');
            const form = document.getElementById('categoryForm');

            const modalTitle = document.getElementById('categoryModalTitle');
            const submitBtn = document.getElementById('categorySubmitBtn');

            const methodInput = document.getElementById('categoryMethod');

            const nameInput = document.getElementById('categoryName');
            const descriptionInput = document.getElementById('categoryDescription');
            const imageInput = document.getElementById('categoryImage');

            const storeUrl = @json(route('admin.categories.store'));

            function openModal() {
                modal.style.display = 'flex';
            }

            function closeModal() {
                modal.style.display = 'none';
            }

            document.getElementById('openCategoryModalBtn').addEventListener('click', function() {
                form.reset();

                form.action = storeUrl;
                methodInput.value = 'POST';

                modalTitle.textContent = 'إضافة تصنيف';
                submitBtn.textContent = 'إضافة التصنيف';

                openModal();
            });

            document.querySelectorAll('.open-edit-category').forEach(button => {
                button.addEventListener('click', function() {
                    form.action = this.dataset.url;
                    methodInput.value = 'PUT';

                    nameInput.value = this.dataset.name || '';
                    descriptionInput.value = this.dataset.description || '';
                    imageInput.value = this.dataset.image || '';

                    modalTitle.textContent = 'تعديل التصنيف';
                    submitBtn.textContent = 'حفظ التعديلات';

                    openModal();
                });
            });

            document.getElementById('closeCategoryModalBtn').addEventListener('click', closeModal);
            document.getElementById('cancelCategoryModalBtn').addEventListener('click', closeModal);

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            @if ($errors->hasAny(['CategoryName', 'Description', 'URLImage']))
                const oldMethod = @json(old('_method', 'POST'));

                methodInput.value = oldMethod;

                if (oldMethod === 'PUT') {
                    modalTitle.textContent = 'تعديل التصنيف';
                    submitBtn.textContent = 'حفظ التعديلات';
                } else {
                    modalTitle.textContent = 'إضافة تصنيف';
                    submitBtn.textContent = 'إضافة التصنيف';
                }

                form.action = oldMethod === 'PUT' ?
                    @json(old('_form_action', route('admin.categories.store'))) :
                    storeUrl;

                openModal();
            @endif
        });
    </script>

@endsection
