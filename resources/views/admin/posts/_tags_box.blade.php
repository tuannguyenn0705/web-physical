{{-- Box Quản lý & Gắn Thẻ Tags (Tìm kiếm + Thêm mới + Xóa trực tiếp) --}}
@php
    $selectedIds = is_array(old('tags')) ? old('tags') : ($selectedTagIds ?? []);
@endphp
<div class="bg-white p-5 rounded-2xl border border-gray-200/90 shadow-xs space-y-3" id="adminTagsBox">
    <div class="flex items-center justify-between border-b border-gray-100 pb-2.5">
        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-700">
            Gắn Thẻ (Tags)
        </h3>
        <span class="text-[11px] font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">
            Đã chọn: <strong id="selectedTagsCount" class="text-gray-900">{{ count($selectedIds) }}</strong>
        </span>
    </div>

    {{-- Ô Tìm kiếm & Thêm nhanh Tag mới --}}
    <div class="space-y-1.5">
        <div class="flex items-center gap-1.5">
            <div class="relative flex-1">
                <svg class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text"
                       id="tagSearchAndAddInput"
                       placeholder="Tìm hoặc nhập thẻ mới..."
                       autocomplete="off"
                       class="w-full pl-8 pr-2.5 py-2 border border-gray-200 rounded-xl text-xs text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
            </div>
            <button type="button"
                    id="addNewTagBtn"
                    onclick="addNewTagFromInput()"
                    class="px-3 py-2 bg-gray-950 hover:bg-gray-800 text-white rounded-xl text-xs font-semibold transition shrink-0 cursor-pointer">
                + Thêm
            </button>
        </div>
        <p id="tagActionFeedback" class="text-[11px] hidden"></p>
    </div>

    {{-- Danh sách Tags có thanh cuộn + Nút xóa từng Tag --}}
    <div id="tagsCheckboxList" class="max-h-52 overflow-y-auto space-y-1 pr-1 divide-y divide-gray-50">
        @foreach($tags as $tag)
            <div class="tag-item-row group flex items-center justify-between gap-2 py-1.5 px-2 rounded-lg hover:bg-gray-50 transition"
                 data-tag-id="{{ $tag->id }}"
                 data-tag-name="{{ mb_strtolower($tag->name) }}">
                <label class="flex items-center gap-2 text-xs text-gray-700 group-hover:text-gray-950 cursor-pointer select-none flex-1 min-w-0">
                    <input type="checkbox"
                           name="tags[]"
                           value="{{ $tag->id }}"
                           onchange="updateSelectedTagsCount()"
                           {{ in_array($tag->id, $selectedIds) ? 'checked' : '' }}
                           class="tag-checkbox h-3.5 w-3.5 text-gray-900 focus:ring-gray-900 border-gray-300 rounded shrink-0">
                    <span class="truncate font-medium">#{{ $tag->name }}</span>
                </label>
                <button type="button"
                        onclick="deleteTagItem({{ $tag->id }}, @js($tag->name), this)"
                        title="Xóa thẻ #{{ $tag->name }}"
                        class="text-gray-400 hover:text-red-600 hover:bg-red-50 p-1 rounded-md transition cursor-pointer shrink-0"
                        aria-label="Xóa thẻ {{ $tag->name }}">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endforeach
    </div>

    {{-- Thông báo khi tìm kiếm không khớp hoặc chưa có tag --}}
    <div id="tagsEmptyNotice" class="{{ $tags->count() ? 'hidden' : '' }} text-center py-3 text-xs text-gray-400">
        Không tìm thấy thẻ nào. Nhấn <strong>"+ Thêm"</strong> để tạo thẻ mới.
    </div>
</div>

@once
@push('scripts')
<script>
function updateSelectedTagsCount() {
    const checkedCount = document.querySelectorAll('#tagsCheckboxList .tag-checkbox:checked').length;
    const badge = document.getElementById('selectedTagsCount');
    if (badge) {
        badge.textContent = checkedCount;
    }
}

function showTagFeedback(message, isError = false) {
    const feedback = document.getElementById('tagActionFeedback');
    if (!feedback) return;
    feedback.textContent = message;
    feedback.className = 'text-[11px] font-medium ' + (isError ? 'text-red-600' : 'text-emerald-600');
    feedback.classList.remove('hidden');
    clearTimeout(window._tagFeedbackTimer);
    window._tagFeedbackTimer = setTimeout(() => {
        feedback.classList.add('hidden');
    }, 3500);
}

function filterTagRows(query) {
    const cleanQuery = query.replace(/^#+/, '').trim().toLowerCase();
    const rows = document.querySelectorAll('#tagsCheckboxList .tag-item-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const tagName = (row.getAttribute('data-tag-name') || '').toLowerCase();
        if (!cleanQuery || tagName.includes(cleanQuery)) {
            row.classList.remove('hidden');
            visibleCount++;
        } else {
            row.classList.add('hidden');
        }
    });

    const emptyNotice = document.getElementById('tagsEmptyNotice');
    if (emptyNotice) {
        if (visibleCount === 0) {
            emptyNotice.classList.remove('hidden');
        } else {
            emptyNotice.classList.add('hidden');
        }
    }
}

async function addNewTagFromInput() {
    const input = document.getElementById('tagSearchAndAddInput');
    const addBtn = document.getElementById('addNewTagBtn');
    if (!input) return;

    const rawName = input.value.replace(/^#+/, '').trim();
    if (!rawName) {
        input.focus();
        showTagFeedback('Vui lòng nhập tên thẻ cần thêm.', true);
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    addBtn.disabled = true;
    addBtn.textContent = '...';

    try {
        const response = await fetch(@js(route('admin.tags.store', [], false)), {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken || ''
            },
            body: JSON.stringify({ name: rawName, _token: csrfToken || '' })
        });

        const data = await response.json();
        if (!response.ok || !data.success) {
            const errMsg = data.message || (data.errors?.name ? data.errors.name[0] : 'Không thể thêm thẻ.');
            showTagFeedback(errMsg, true);
            return;
        }

        const tag = data.tag;
        const list = document.getElementById('tagsCheckboxList');
        let existingRow = list.querySelector(`.tag-item-row[data-tag-id="${tag.id}"]`);

        // Xóa bộ lọc tìm kiếm để hiển thị toàn bộ danh sách
        input.value = '';
        filterTagRows('');

        if (existingRow) {
            const cb = existingRow.querySelector('.tag-checkbox');
            if (cb) cb.checked = true;
            existingRow.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            showTagFeedback(`Đã chọn thẻ #${tag.name} có sẵn.`);
        } else {
            const row = document.createElement('div');
            row.className = 'tag-item-row group flex items-center justify-between gap-2 py-1.5 px-2 rounded-lg hover:bg-gray-50 transition bg-orange-50/60';
            row.setAttribute('data-tag-id', tag.id);
            row.setAttribute('data-tag-name', tag.name.toLowerCase());

            const label = document.createElement('label');
            label.className = 'flex items-center gap-2 text-xs text-gray-700 group-hover:text-gray-950 cursor-pointer select-none flex-1 min-w-0';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'tags[]';
            checkbox.value = tag.id;
            checkbox.checked = true;
            checkbox.className = 'tag-checkbox h-3.5 w-3.5 text-gray-900 focus:ring-gray-900 border-gray-300 rounded shrink-0';
            checkbox.addEventListener('change', updateSelectedTagsCount);

            const span = document.createElement('span');
            span.className = 'truncate font-medium';
            span.textContent = '#' + tag.name;

            label.appendChild(checkbox);
            label.appendChild(span);

            const delBtn = document.createElement('button');
            delBtn.type = 'button';
            delBtn.title = 'Xóa thẻ #' + tag.name;
            delBtn.className = 'text-gray-400 hover:text-red-600 hover:bg-red-50 p-1 rounded-md transition cursor-pointer shrink-0';
            delBtn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
            delBtn.addEventListener('click', function() {
                deleteTagItem(tag.id, tag.name, delBtn);
            });

            row.appendChild(label);
            row.appendChild(delBtn);

            list.prepend(row);
            filterTagRows('');
            showTagFeedback(`Đã thêm và tích chọn thẻ #${tag.name}!`);
        }

        updateSelectedTagsCount();
    } catch (error) {
        showTagFeedback('Lỗi kết nối máy chủ khi thêm thẻ.', true);
    } finally {
        addBtn.disabled = false;
        addBtn.textContent = '+ Thêm';
    }
}

async function deleteTagItem(tagId, tagName, btnEl) {
    if (!confirm(`Bạn có chắc muốn xóa thẻ "#${tagName}" khỏi danh sách?`)) {
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const baseUrl = @js(route('admin.tags.store', [], false));
    btnEl.disabled = true;

    try {
        const response = await fetch(`${baseUrl}/${tagId}`, {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken || ''
            }
        });

        const data = await response.json();
        if (!response.ok || !data.success) {
            showTagFeedback('Không thể xóa thẻ này.', true);
            btnEl.disabled = false;
            return;
        }

        const row = btnEl.closest('.tag-item-row');
        if (row) {
            row.remove();
        }
        const searchInput = document.getElementById('tagSearchAndAddInput');
        filterTagRows(searchInput ? searchInput.value : '');
        updateSelectedTagsCount();
        showTagFeedback(`Đã xóa thẻ #${tagName}.`);
    } catch (error) {
        showTagFeedback('Lỗi kết nối khi xóa thẻ.', true);
        btnEl.disabled = false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('tagSearchAndAddInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filterTagRows(this.value);
        });
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addNewTagFromInput();
            }
        });
    }
});
</script>
@endpush
@endonce
