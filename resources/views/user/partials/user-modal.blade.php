<div id="userModal" class="modal-overlay" style="display: none;">
    <div class="modal-box">

        <div class="modal-header">
            <h3 id="userModalTitle">إضافة مستخدم جديد</h3>
            <span id="closeUserModalBtn" class="close-btn">&times;</span>
        </div>

        <form id="userForm" action="{{ old('_form_action', route('admin.users.store')) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="{{ old('_method', 'POST') }}">
            <input type="hidden" name="_form_action" id="formActionInput"
                value="{{ old('_form_action', route('admin.users.store')) }}">
            <input type="hidden" name="_form_mode" id="formModeInput" value="{{ old('_form_mode', 'create') }}">

            <div class="form-grid">

                <div class="form-field">
                    <label for="user_name">اسم المستخدم *</label>
                    <input type="text" id="user_name" name="user_name" class="control" value="{{ old('user_name') }}"
                        required>
                    @error('user_name')
                        <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="email">البريد الإلكتروني *</label>
                    <input type="email" id="email" name="email" class="control" value="{{ old('email') }}"
                        required>
                    @error('email')
                        <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="phone_number">رقم الهاتف</label>
                    <input type="text" id="phone_number" name="phone_number" class="control"
                        value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="role">الصلاحية *</label>
                    <select id="role" name="role" class="control" required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>اختر الصلاحية...</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>مدير (Admin)</option>
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>عميل (Customer)
                        </option>
                    </select>
                    @error('role')
                        <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field full">
                    <label for="status">حالة الحساب *</label>
                    <select id="status" name="status" class="control" required>
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>نشط (Active)
                        </option>
                        <option value="de_active" {{ old('status') == 'de_active' ? 'selected' : '' }}>غير نشط
                            (De-active)</option>
                    </select>
                    @error('status')
                        <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="password" id="passwordLabel">كلمة المرور *</label>
                    <input type="password" id="password" name="password" class="control" required>
                    <span class="hint" id="passwordHint">يجب أن لا تقل عن 8 أحرف</span>
                    @error('password')
                        <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="confirmed_password" id="confirmPasswordLabel">تأكيد كلمة المرور *</label>
                    <input type="password" id="confirmed_password" name="confirmed_password" class="control" required>
                    @error('confirmed_password')
                        <span class="hint" style="color: #dc2626;">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" id="cancelUserModalBtn" class="control"
                    style="width: auto; cursor: pointer;">إلغاء</button>
                <button type="submit" id="userModalSubmitBtn" class="control"
                    style="width: auto; background: var(--accent-deep); color: #fff; border-color: var(--accent-deep); cursor: pointer;">حفظ
                    المستخدم</button>
            </div>

        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');
        const modalTitle = document.getElementById('userModalTitle');
        const submitBtn = document.getElementById('userModalSubmitBtn');

        const formMethod = document.getElementById('formMethod');
        const formActionInput = document.getElementById('formActionInput');
        const formModeInput = document.getElementById('formModeInput');

        const passInput = document.getElementById('password');
        const confirmPassInput = document.getElementById('confirmed_password');
        const passLabel = document.getElementById('passwordLabel');
        const confirmPassLabel = document.getElementById('confirmPasswordLabel');
        const passHint = document.getElementById('passwordHint');

        function setPasswordMode(isEdit) {
            if (isEdit) {
                passInput.required = false;
                confirmPassInput.required = false;
                passLabel.textContent = 'كلمة المرور (اختياري)';
                confirmPassLabel.textContent = 'تأكيد كلمة المرور';
                passHint.textContent = 'اترك الحقل فارغاً إذا كنت لا ترغب بتغيير كلمة المرور';
            } else {
                passInput.required = true;
                confirmPassInput.required = true;
                passLabel.textContent = 'كلمة المرور *';
                confirmPassLabel.textContent = 'تأكيد كلمة المرور *';
                passHint.textContent = 'يجب أن لا تقل عن 8 أحرف';
            }
        }

        document.querySelectorAll('.open-create-user').forEach(btn => {
            btn.addEventListener('click', function() {
                const storeUrl = "{{ route('admin.users.store') }}";

                form.reset();
                form.action = storeUrl;
                formActionInput.value = storeUrl;
                formMethod.value = 'POST';
                formModeInput.value = 'create';

                modalTitle.textContent = 'إضافة مستخدم جديد';
                submitBtn.textContent = 'حفظ المستخدم';
                setPasswordMode(false);

                modal.style.display = 'flex';
            });
        });

        document.querySelectorAll('.open-edit-user').forEach(btn => {
            btn.addEventListener('click', function() {
                const updateUrl = this.dataset.url;

                document.getElementById('user_name').value = this.dataset.user_name || '';
                document.getElementById('email').value = this.dataset.email || '';
                document.getElementById('phone_number').value = this.dataset.phone_number || '';
                document.getElementById('role').value = this.dataset.role || '';
                document.getElementById('status').value = this.dataset.status || 'active';

                passInput.value = '';
                confirmPassInput.value = '';

                form.action = updateUrl;
                formActionInput.value = updateUrl;
                formMethod.value = 'PUT';
                formModeInput.value = 'edit';

                modalTitle.textContent = 'تعديل بيانات المستخدم';
                submitBtn.textContent = 'تحديث البيانات';
                setPasswordMode(true);

                modal.style.display = 'flex';
            });
        });

        const closeModal = () => modal.style.display = 'none';
        document.getElementById('closeUserModalBtn').addEventListener('click', closeModal);
        document.getElementById('cancelUserModalBtn').addEventListener('click', closeModal);

        window.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        @if ($errors->hasAny(['user_name', 'email', 'phone_number', 'role', 'status', 'password', 'confirmed_password']))
            const isEditMode = "{{ old('_form_mode') }}" === 'edit';
            modalTitle.textContent = isEditMode ? 'تعديل بيانات المستخدم' : 'إضافة مستخدم جديد';
            submitBtn.textContent = isEditMode ? 'تحديث البيانات' : 'حفظ المستخدم';
            setPasswordMode(isEditMode);
            modal.style.display = 'flex';
        @endif
    });
</script>
