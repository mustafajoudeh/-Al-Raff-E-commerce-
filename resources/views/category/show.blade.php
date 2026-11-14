@extends('layouts.admin')

@section('title', 'تفاصيل التصنيف')
@section('subtitle', 'عرض معلومات التصنيف')

@section('content')

    <div class="page-heading">
        <div>
            <h1>تفاصيل التصنيف</h1>
            <p>عرض معلومات التصنيف المحدد.</p>
        </div>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
            العودة للتصنيفات
        </a>
    </div>

    <div class="card">
        <div class="detail-grid">

            <div class="detail-item">
                <span>رقم التصنيف</span>
                <strong>#{{ $category->id }}</strong>
            </div>

            <div class="detail-item">
                <span>اسم التصنيف</span>
                <strong>{{ $category->category_name }}</strong>
            </div>

            <div class="detail-item">
                <span>الوصف</span>
                <strong>{{ $category->description ?: '—' }}</strong>
            </div>

            <div class="detail-item">
                <span>رابط الصورة</span>
                @if ($category->image)
                    <a href="{{ $category->image }}" target="_blank" rel="noopener">
                        عرض الصورة
                    </a>
                @else
                    <strong>—</strong>
                @endif
            </div>

            @if ($category->image)
                <div class="detail-item">
                    <span>صورة التصنيف</span>
                    <img src="{{ $category->image }}" alt="{{ $category->category_name }}"
                        style="max-width: 180px; border-radius: 8px;">
                </div>
            @endif

        </div>
    </div>

@endsection
