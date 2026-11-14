@extends('layouts.admin')

@section('title', 'تفاصيل المستخدم')
@section('subtitle', 'عرض بيانات المستخدم')

@section('content')

    <div class="card">

        <div class="card-header">
            <h3>معلومات المستخدم</h3>

            <a href="{{ route('admin.users.index') }}" class="btn">
                العودة للمستخدمين
            </a>
        </div>

        <div class="form-grid">

            <div class="form-field">
                <label>اسم المستخدم</label>
                <input class="control" value="{{ $user->user_name }}" disabled>
            </div>

            <div class="form-field">
                <label>البريد الإلكتروني</label>
                <input class="control" value="{{ $user->email }}" disabled>
            </div>

            <div class="form-field">
                <label>رقم الهاتف</label>
                <input class="control" value="{{ $user->phone_number ?? '-' }}" disabled>
            </div>

            <div class="form-field">
                <label>الصلاحية</label>
                <input class="control" value="{{ $user->role }}" disabled>
            </div>

            <div class="form-field">
                <label>حالة الحساب</label>
                <input class="control" value="{{ $user->status }}" disabled>
            </div>

            <div class="form-field">
                <label>تاريخ الإنشاء</label>
                <input class="control" value="{{ $user->created_at?->format('Y-m-d H:i') ?? '-' }}" disabled>
            </div>

        </div>

    </div>

@endsection
