@extends('layouts.admin')

@section('title', 'المستخدمون')
@section('subtitle', 'إدارة حسابات المستخدمين وصلاحياتهم')

@section('content')
    <div class="page-heading">
        <div>
            <h1>المستخدمون</h1>
            <p>عرض جميع الحسابات المسجلة في مكتبة الرَّف.</p>
        </div>

        <button type="button" id="openUserModalBtn" class="btn btn-primary open-create-user">
            <x-icon name="plus" :size="16" class="icon-add" />
            <span>إضافة مستخدم</span>
        </button>

    </div>

    <form class="card toolbar" method="GET" action="{{ url()->current() }}">
        <div class="search-box">
            <x-icon name="search" :size="17" />
            <input class="control" type="search" name="q" value="{{ request('q') }}"
                placeholder="ابحث بالاسم أو البريد الإلكتروني...">
        </div>
        <select class="control filter-control" name="role">
            <option value="">كل الصلاحيات</option>
            <option value="Admin" @selected(request('role') === 'admin')>مسؤول</option>
            <option value="Customer" @selected(request('role') === 'customer')>عميل</option>
        </select>
        <select class="control filter-control" name="status">
            <option value="">كل الحالات</option>
            <option value="Active" @selected(request('status') === 'active')>نشط</option>
            <option value="Inactive" @selected(request('status') === 'de_active')>غير نشط</option>
        </select>
        <button class="btn btn-primary" type="submit">تصفية</button>
        @if (request()->hasAny(['q', 'role', 'status']))
            <a class="btn btn-outline" href="{{ url()->current() }}">مسح</a>
        @endif
    </form>

    <div class="card table-card">
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>المستخدم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الصلاحية</th>
                        <th>الحالة</th>
                        <th>الإجرائات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="book-cell">
                                    <span class="avatar">{{ mb_strtoupper(mb_substr($user['user_name'], 0, 1)) }}</span>
                                    <div class="cell-main">
                                        <strong>{{ $user['user_name'] }}</strong>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user['email'] }}</td>
                            <td>
                                @if ($user['role'] === 'admin')
                                    <span class="pill pill-warning">مسؤول</span>
                                @else
                                    <span class="pill pill-neutral">عميل</span>
                                @endif
                            </td>
                            <td>
                                @if ($user['status'] === 'active')
                                    <span class="pill pill-success">نشط</span>
                                @else
                                    <span class="pill pill-danger">غير نشط</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">

                                    <a href="{{ route('admin.users.show', $user['id']) }}" class="table-icon"
                                        title="عرض">
                                        <x-icon name="eye" :size="15" />
                                    </a>


                                    <button type="button" class="table-icon open-edit-user"
                                        data-url="{{ route('admin.users.update', $user['id']) }}"
                                        data-user_name="{{ $user['user_name'] }}" data-email="{{ $user['email'] }}"
                                        data-phone_number="{{ $user['phone_number'] }}" data-role="{{ $user['role'] }}"
                                        data-status="{{ $user['status'] }}" title="تعديل">

                                        <x-icon name="edit" :size="15" />

                                    </button>



                                    <form action="{{ route('admin.users.toggleStatus', $user['id']) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PATCH')

                                        @if ($user['status'] === 'active')
                                            <button type="submit" class="table-icon" title="تعطيل">
                                                <x-icon name="ban" :size="15" />
                                            </button>
                                        @else
                                            <button type="submit" class="table-icon" title="تفعيل">
                                                <x-icon name="check" :size="15" />
                                            </button>
                                        @endif
                                    </form>



                                    <form action="{{ route('admin.users.destroy', $user['id']) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">

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
                                    <strong>لا يوجد مستخدمون</strong>
                                    <span>غيّر البحث أو الفلاتر وحاول مرة أخرى.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-pagination :paginator="$users" />
    @include('user.partials.user-modal')
@endsection
