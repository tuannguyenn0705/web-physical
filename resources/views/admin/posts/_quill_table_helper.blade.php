<style>
    /* Định dạng Bảng gọn gàng, hiện đại ngay trong khung soạn thảo Admin */
    .ql-editor table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin: 1.25rem 0;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        overflow: hidden;
        background-color: #ffffff;
        font-size: 0.92rem;
        line-height: 1.55;
    }

    .ql-editor table td,
    .ql-editor table th {
        padding: 10px 14px;
        border-bottom: 1px solid #e2e8f0;
        border-right: 1px solid #e2e8f0;
        color: #334155;
        vertical-align: top;
        min-width: 70px;
    }

    .ql-editor table tr td:last-child,
    .ql-editor table tr th:last-child {
        border-right: none;
    }

    .ql-editor table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Hàng đầu tiên tự động hiển thị như dòng tiêu đề bảng (Header Row) */
    .ql-editor table tbody tr:first-child td,
    .ql-editor table thead th {
        background-color: #f8fafc;
        color: #0f172a;
        font-weight: 700;
        border-bottom: 1.5px solid #cbd5e1;
    }

    /* Hộp chọn kích thước bảng trực quan (giống Word / Google Docs) */
    .table-grid-popover {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        z-index: 80;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0 12px 30px -4px rgba(15, 23, 42, 0.16);
        width: 196px;
        user-select: none;
    }

    .table-grid-title {
        font-family: 'Inter', sans-serif;
        font-size: 11.5px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
        text-align: center;
    }

    .table-grid-cells {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 4px;
    }

    .table-grid-cell {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid #cbd5e1;
        background-color: #f8fafc;
        cursor: pointer;
        transition: all 0.1s ease;
    }

    .table-grid-cell.active {
        background-color: #ffedd5;
        border-color: #ea580c;
    }

    /* Thanh công cụ chỉnh sửa bảng thông minh (hiện khi đặt con trỏ trong bảng) */
    .table-context-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        background-color: #f8fafc;
        border-left: 1px solid #e2e8f0;
        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        font-family: 'Inter', sans-serif;
        font-size: 11.5px;
    }

    .table-context-bar.hidden {
        display: none !important;
    }

    .table-context-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 9px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background-color: #ffffff;
        color: #1e293b;
        font-weight: 600;
        font-size: 11px;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .table-context-btn:hover {
        background-color: #f1f5f9;
        border-color: #94a3b8;
    }

    .table-context-btn.danger {
        color: #dc2626;
        border-color: #fecaca;
        background-color: #fef2f2;
    }

    .table-context-btn.danger:hover {
        background-color: #fee2e2;
        border-color: #f87171;
    }
</style>

<script>
/**
 * Chuẩn hóa HTML bảng khi Paste từ Gemini, ChatGPT, Word, Excel, Google Docs
 * để Quill 2.0 giữ nguyên 100% số dòng, số cột và tiêu đề in đậm.
 */
function normalizeTablesInHtml(html) {
    if (!html || !/<table/i.test(html)) {
        return html;
    }

    const doc = (new DOMParser()).parseFromString(html, 'text/html');
    doc.querySelectorAll('table').forEach(table => {
        // Loại bỏ các thẻ chú thích phụ (citation footnotes của Gemini/ChatGPT) trong bảng
        table.querySelectorAll('source-footnote, sup, button, svg, script, style').forEach(el => el.remove());

        // Chuyển <th> thành <td><strong>...</strong></td> để Quill 2.0 nhận diện đúng cột tiêu đề
        table.querySelectorAll('th').forEach(th => {
            const td = doc.createElement('td');
            const strong = doc.createElement('strong');
            while (th.firstChild) {
                strong.appendChild(th.firstChild);
            }
            td.appendChild(strong);
            th.replaceWith(td);
        });

        // Gom các dòng trong thead / tfoot vào tbody theo đúng thứ tự
        let tbody = table.querySelector('tbody');
        if (!tbody) {
            tbody = doc.createElement('tbody');
            table.appendChild(tbody);
        }

        const thead = table.querySelector('thead');
        if (thead) {
            const headRows = Array.from(thead.querySelectorAll('tr'));
            headRows.reverse().forEach(tr => {
                tbody.insertBefore(tr, tbody.firstChild);
            });
            thead.remove();
        }

        const tfoot = table.querySelector('tfoot');
        if (tfoot) {
            Array.from(tfoot.querySelectorAll('tr')).forEach(tr => {
                tbody.appendChild(tr);
            });
            tfoot.remove();
        }

        // Làm phẳng các thẻ block (<p>, <div>, <li>) bên trong từng ô <td> để tránh bị tách nhầm thành nhiều ô
        table.querySelectorAll('td').forEach(td => {
            td.querySelectorAll('p, div, li, h1, h2, h3, h4, h5, h6').forEach((block, idx) => {
                const span = doc.createElement('span');
                while (block.firstChild) {
                    span.appendChild(block.firstChild);
                }
                if (idx > 0 && span.textContent.trim()) {
                    td.insertBefore(doc.createTextNode(' • '), block);
                }
                block.replaceWith(span);
            });

            td.querySelectorAll('ul, ol').forEach(list => {
                const span = doc.createElement('span');
                while (list.firstChild) {
                    span.appendChild(list.firstChild);
                }
                list.replaceWith(span);
            });

            td.querySelectorAll('br').forEach(br => {
                br.replaceWith(doc.createTextNode(' '));
            });

            if (!td.textContent || td.textContent.trim() === '') {
                td.textContent = '\u00a0';
            }
        });
    });

    return doc.body.innerHTML;
}

/**
 * Khởi tạo bộ công cụ Tạo bảng, Chỉnh sửa bảng và Copy-Paste bảng cho Quill 2.0
 */
function initQuillTableSupport(quill, contentInput) {
    const tableModule = quill.getModule('table');
    const toolbarModule = quill.getModule('toolbar');
    const toolbarEl = toolbarModule ? toolbarModule.container : null;
    if (!tableModule || !toolbarEl) return;

    // 1. Hook bộ chuyển đổi Clipboard của Quill để hỗ trợ Paste bảng từ Gemini / Word / Excel
    const origConvert = quill.clipboard.convert.bind(quill.clipboard);
    quill.clipboard.convert = function({ html, text }, formats = {}) {
        if (html && /<table/i.test(html)) {
            html = normalizeTablesInHtml(html);
        }
        return origConvert({ html, text }, formats);
    };

    // 2. Tạo thanh điều khiển bảng thông minh (hiện ngay dưới thanh công cụ khi đặt chuột vào bảng)
    const contextBar = document.createElement('div');
    contextBar.id = 'tableContextBar';
    contextBar.className = 'table-context-bar hidden';
    contextBar.innerHTML = `
        <span class="text-xs font-bold text-slate-700 mr-1">Chỉnh sửa bảng:</span>
        <button type="button" class="table-context-btn" data-action="row-above">+ Hàng trên</button>
        <button type="button" class="table-context-btn" data-action="row-below">+ Hàng dưới</button>
        <button type="button" class="table-context-btn" data-action="col-left">+ Cột trái</button>
        <button type="button" class="table-context-btn" data-action="col-right">+ Cột phải</button>
        <span class="w-px h-4 bg-slate-200 mx-0.5"></span>
        <button type="button" class="table-context-btn danger" data-action="del-row">Xóa hàng</button>
        <button type="button" class="table-context-btn danger" data-action="del-col">Xóa cột</button>
        <button type="button" class="table-context-btn danger" data-action="del-table">Xóa bảng</button>
    `;

    quill.container.parentNode.insertBefore(contextBar, quill.container);

    contextBar.querySelectorAll('button[data-action]').forEach(btn => {
        btn.addEventListener('mousedown', function(e) {
            e.preventDefault(); // Giữ nguyên vị trí con trỏ trong ô bảng
            const action = this.getAttribute('data-action');
            switch (action) {
                case 'row-above': tableModule.insertRowAbove(); break;
                case 'row-below': tableModule.insertRowBelow(); break;
                case 'col-left':  tableModule.insertColumnLeft(); break;
                case 'col-right': tableModule.insertColumnRight(); break;
                case 'del-row':   tableModule.deleteRow(); break;
                case 'del-col':   tableModule.deleteColumn(); break;
                case 'del-table':
                    if (confirm('Bạn có chắc muốn xóa toàn bộ bảng này?')) {
                        tableModule.deleteTable();
                        contextBar.classList.add('hidden');
                    }
                    break;
            }
            if (contentInput) {
                contentInput.value = quill.root.innerHTML;
            }
        });
    });

    // Tự động ẩn/hiện thanh chỉnh sửa bảng khi con trỏ nằm trong bảng
    function updateTableContextVisibility() {
        const range = quill.getSelection();
        if (!range) return;
        const [tableContainer] = tableModule.getTable(range);
        if (tableContainer) {
            contextBar.classList.remove('hidden');
        } else {
            contextBar.classList.add('hidden');
        }
    }

    quill.on('selection-change', updateTableContextVisibility);
    quill.root.addEventListener('click', updateTableContextVisibility);

    // 3. Tạo hộp chọn kích thước bảng trực quan (Grid Picker 8x6) gắn vào nút Table trên thanh công cụ
    const tableBtn = toolbarEl.querySelector('button.ql-table');
    if (tableBtn) {
        tableBtn.style.position = 'relative';
        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.display = 'inline-flex';
        tableBtn.parentNode.insertBefore(wrapper, tableBtn);
        wrapper.appendChild(tableBtn);

        const popover = document.createElement('div');
        popover.className = 'table-grid-popover hidden';

        const titleEl = document.createElement('div');
        titleEl.className = 'table-grid-title';
        titleEl.textContent = 'Chèn bảng: 3 × 3';
        popover.appendChild(titleEl);

        const gridEl = document.createElement('div');
        gridEl.className = 'table-grid-cells';

        const maxRows = 6;
        const maxCols = 8;
        const cells = [];

        function highlightGrid(rows, cols) {
            titleEl.textContent = `Chèn bảng: ${rows} hàng × ${cols} cột`;
            cells.forEach(c => {
                if (c.r <= rows && c.c <= cols) {
                    c.el.classList.add('active');
                } else {
                    c.el.classList.remove('active');
                }
            });
        }

        for (let r = 1; r <= maxRows; r++) {
            for (let c = 1; c <= maxCols; c++) {
                const cell = document.createElement('div');
                cell.className = 'table-grid-cell';
                cell.addEventListener('mouseenter', () => highlightGrid(r, c));
                cell.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    popover.classList.add('hidden');

                    quill.focus();
                    const range = quill.getSelection(true) || { index: quill.getLength() - 1, length: 0 };
                    quill.setSelection(range.index, 0, 'silent');
                    tableModule.insertTable(r, c);

                    if (contentInput) {
                        contentInput.value = quill.root.innerHTML;
                    }
                    setTimeout(updateTableContextVisibility, 50);
                });
                gridEl.appendChild(cell);
                cells.push({ r, c, el: cell });
            }
        }

        popover.appendChild(gridEl);
        wrapper.appendChild(popover);

        // Bấm nút Table trên thanh công cụ -> Bật/tắt bảng chọn kích thước
        tableBtn.addEventListener('mousedown', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isHidden = popover.classList.contains('hidden');
            if (isHidden) {
                highlightGrid(3, 3);
                popover.classList.remove('hidden');
            } else {
                popover.classList.add('hidden');
            }
        });

        document.addEventListener('mousedown', function(e) {
            if (!wrapper.contains(e.target)) {
                popover.classList.add('hidden');
            }
        });
    }
}
</script>
