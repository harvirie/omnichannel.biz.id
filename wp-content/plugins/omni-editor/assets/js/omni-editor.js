/**
 * Omni Editor — JS Logic
 * v1.0.0
 */

jQuery(document).ready(function ($) {
    if (!$('#omni-editor-root').length) return;

    const config = window.OmniEditorConfig;
    const $root = $('#omni-editor-root');
    const $panel = $('#oe-editor-panel');
    const $toastContainer = $('#oe-toast-container');
    const $toolbar = $('#oe-text-toolbar');
    const $saveBtn = $('#oe-save-btn');
    const $resetBtn = $('#oe-reset-btn');
    const $previewIframe = $('#oe-preview-iframe');
    const $status = $('#oe-save-status');

    let currentPage = 'home';
    let contentData = JSON.parse(JSON.stringify(config.current)); // Deep copy
    let isSaving = false;
    let hasUnsavedChanges = false;
    let autoSaveTimer = null;
    let currentSelectionRange = null;

    // ─── INIT ────────────────────────────────────────────────────────
    
    function init() {
        bindNavigation();
        bindPreviewControls();
        bindGlobalActions();
        bindToolbar();
        
        loadPageEditor(currentPage);
        
        // Auto save loop
        setInterval(() => {
            if ($('#oe-autosave-cb').is(':checked') && hasUnsavedChanges && !isSaving) {
                saveCurrentPage();
            }
        }, 15000);
    }

    // ─── NAVIGATION ──────────────────────────────────────────────────
    
    function bindNavigation() {
        $('.oe-nav-item').on('click', function () {
            if ($(this).hasClass('active')) return;
            
            // Check for unsaved changes (could prompt here, but auto-save is better)
            if (hasUnsavedChanges && $('#oe-autosave-cb').is(':checked')) {
                saveCurrentPage(false); // background save
            }
            
            $('.oe-nav-item').removeClass('active');
            $(this).addClass('active');
            
            currentPage = $(this).data('page');
            $('#oe-current-page-label').text($(this).text().trim());
            
            // Update preview URL
            let previewUrl = config.pages[currentPage] || config.siteUrl;
            previewUrl += (previewUrl.indexOf('?') !== -1 ? '&' : '?') + 'omni_preview=1';
            $('#oe-preview-url').text(previewUrl);
            $('#oe-preview-open').attr('href', previewUrl);
            
            // Reload iframe if it's a different page
            const currentSrc = $previewIframe.attr('src');
            // Remove trailing slash for comparison if needed, but strict is fine
            if (currentSrc !== previewUrl) {
                $previewIframe.attr('src', previewUrl);
            }
            
            loadPageEditor(currentPage);
        });
    }

    // ─── PREVIEW CONTROLS ────────────────────────────────────────────

    function bindPreviewControls() {
        $('.oe-preview-device').on('click', function () {
            $('.oe-preview-device').removeClass('active');
            $(this).addClass('active');
            $('#oe-preview-wrap').attr('data-device', $(this).data('device'));
            resizePreview();
        });
        
        $('#oe-refresh-preview').on('click', function() {
            refreshPreview();
        });

        $(window).on('resize', function() {
            resizePreview();
        });
        
        // Initial resize
        setTimeout(resizePreview, 100);
    }
    
    function resizePreview() {
        const $wrap = $('#oe-preview-wrap');
        const $iframe = $('#oe-preview-iframe');
        if (!$wrap.length || !$iframe.length) return;
        
        const device = $wrap.attr('data-device');
        const wrapW = $wrap.width();
        const wrapH = $wrap.height();
        
        // Target widths for different devices
        let targetW = 1440;
        if (device === 'tablet') targetW = 768;
        else if (device === 'mobile') targetW = 375;
        
        const paddingX = device === 'desktop' ? 0 : 40;
        const availableW = wrapW - paddingX;
        
        const scale = Math.min(1, availableW / targetW);
        const scaledW = targetW * scale;
        
        $iframe.css({
            position: 'absolute',
            left: '50%',
            top: '12px', // matches wrapper padding
            marginLeft: -(scaledW / 2) + 'px',
            width: targetW + 'px',
            height: ((wrapH - 24) / scale) + 'px',
            transform: `scale(${scale})`,
            transformOrigin: 'top left'
        });
    }
    
    function refreshPreview() {
        $previewIframe.attr('src', $previewIframe.attr('src'));
        showToast('Preview direfresh', 'info');
    }

    // ─── GLOBAL ACTIONS ──────────────────────────────────────────────

    function bindGlobalActions() {
        $saveBtn.on('click', () => saveCurrentPage(true));
        $resetBtn.on('click', () => resetCurrentPage());
        
        // Track changes
        $panel.on('input change', 'input, textarea, .oe-richtext', function() {
            markUnsaved();
        });
        
        // Media uploader
        $panel.on('click', '.oe-btn-change-img', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const $wrap = $btn.closest('.oe-image-picker');
            const dataPath = $btn.data('path');
            
            let frame = wp.media({
                title: 'Pilih Gambar',
                button: { text: 'Gunakan Gambar Ini' },
                multiple: false
            });
            
            frame.on('select', function() {
                const attachment = frame.state().get('selection').first().toJSON();
                const url = attachment.sizes && attachment.sizes.large ? attachment.sizes.large.url : attachment.url;
                const id = attachment.id;
                
                $wrap.find('img').attr('src', url);
                $wrap.find('.oe-image-preview').removeClass('empty').html(`<img src="${url}" alt="">`);
                
                updateDataByPath(dataPath + '.image_url', url);
                updateDataByPath(dataPath + '.image_id', id);
                markUnsaved();
            });
            
            frame.open();
        });
        
        // Section toggle
        $panel.on('click', '.oe-section-header', function(e) {
            if ($(e.target).closest('button, input').length) return;
            const $card = $(this).closest('.oe-section-card');
            $(this).toggleClass('open');
            $card.find('.oe-section-body').slideToggle(200).toggleClass('open');
        });
        
        // Inner tabs (e.g. for pricing)
        $panel.on('click', '.oe-inner-tab', function() {
            const target = $(this).data('target');
            const $container = $(this).closest('.oe-section-body');
            
            $container.find('.oe-inner-tab').removeClass('active');
            $(this).addClass('active');
            
            $container.find('.oe-inner-tab-panel').removeClass('active');
            $container.find(target).addClass('active');
        });
    }

    // ─── TEXT TOOLBAR ────────────────────────────────────────────────
    
    function bindToolbar() {
        // Show toolbar on selection inside richtext
        $panel.on('mouseup keyup', '.oe-richtext', function(e) {
            const selection = window.getSelection();
            if (!selection.isCollapsed && selection.rangeCount > 0) {
                currentSelectionRange = selection.getRangeAt(0);
                
                // Position toolbar
                const rect = currentSelectionRange.getBoundingClientRect();
                const toolbarW = $toolbar.outerWidth();
                let top = rect.top - $toolbar.outerHeight() - 10;
                let left = rect.left + (rect.width / 2) - (toolbarW / 2);
                
                // Boundaries
                if (top < 0) top = rect.bottom + 10;
                if (left < 0) left = 10;
                if (left + toolbarW > window.innerWidth) left = window.innerWidth - toolbarW - 10;
                
                $toolbar.css({ top: top, left: left }).fadeIn(150);
                updateToolbarState();
            } else {
                $toolbar.fadeOut(150);
            }
        });
        
        $(document).on('mousedown', function(e) {
            if (!$(e.target).closest('.oe-text-toolbar, .oe-richtext').length) {
                $toolbar.fadeOut(150);
            }
        });
        
        // Toolbar actions
        $('.oe-toolbar-btn').on('click', function(e) {
            // Prevent color input click from triggering this if we clicked the input itself
            if (e.target.tagName.toLowerCase() === 'input') return;
            
            e.preventDefault();
            const cmd = $(this).data('cmd');
            let val = $(this).data('val') || null;
            
            if (cmd === 'foreColor') {
                $(this).find('input').trigger('click');
                return;
            }
            
            restoreSelection();
            document.execCommand(cmd, false, val);
            
            // Trigger input event to save data
            const $activeEl = $(currentSelectionRange.startContainer).closest('.oe-richtext');
            if ($activeEl.length) {
                $activeEl.trigger('input');
            }
            
            updateToolbarState();
        });
        
        $('.oe-color-input').on('change', function() {
            const color = $(this).val();
            $(this).siblings('.oe-color-preview').css('background', color);
            
            restoreSelection();
            document.execCommand('foreColor', false, color);
            
            const $activeEl = $(currentSelectionRange.startContainer).closest('.oe-richtext');
            if ($activeEl.length) {
                $activeEl.trigger('input');
            }
        });

        // Handle font name and font size selects
        $panel.on('change', '.oe-rt-fontname, .oe-rt-fontsize', function() {
            const cmd = $(this).hasClass('oe-rt-fontname') ? 'fontName' : 'fontSize';
            const val = $(this).val();
            if (!val) return;
            
            let $activeEl = null;
            if (currentSelectionRange) {
                $activeEl = $(currentSelectionRange.startContainer).closest('.oe-richtext');
                if ($activeEl.length) {
                    $activeEl.focus();
                }
            }
            restoreSelection();
            
            document.execCommand(cmd, false, val);
            this.selectedIndex = 0;
            
            if ($activeEl && $activeEl.length) {
                $activeEl.trigger('input');
            }
        });
    }
    
    function restoreSelection() {
        if (currentSelectionRange) {
            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(currentSelectionRange);
        }
    }
    
    function updateToolbarState() {
        $('.oe-toolbar-btn[data-cmd]').each(function() {
            const cmd = $(this).data('cmd');
            if (cmd !== 'insertHTML' && cmd !== 'foreColor' && cmd !== 'removeFormat') {
                if (document.queryCommandState(cmd)) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            }
        });
    }

    // ─── DATA BINDING ────────────────────────────────────────────────
    
    function updateDataByPath(path, value) {
        const parts = path.split('.');
        let current = contentData[currentPage];
        
        for (let i = 0; i < parts.length - 1; i++) {
            const part = parts[i];
            // Handle array indices like items[0]
            if (part.includes('[')) {
                const arrName = part.split('[')[0];
                const index = parseInt(part.match(/\[(\d+)\]/)[1]);
                if (!current[arrName]) current[arrName] = [];
                current = current[arrName][index];
            } else {
                if (!current[part]) current[part] = {};
                current = current[part];
            }
        }
        
        const lastPart = parts[parts.length - 1];
        if (lastPart.includes('[')) {
            const arrName = lastPart.split('[')[0];
            const index = parseInt(lastPart.match(/\[(\d+)\]/)[1]);
            current[arrName][index] = value;
        } else {
            current[lastPart] = value;
        }
    }
    
    // Bind all inputs inside a container
    function bindDataInputs($container, basePath) {
        $container.find('[data-bind]').each(function() {
            const $el = $(this);
            const bindPath = basePath ? `${basePath}.${$el.data('bind')}` : $el.data('bind');
            
            if ($el.hasClass('oe-richtext')) {
                $el.on('input blur', function() {
                    updateDataByPath(bindPath, $el.html());
                });
            } else {
                $el.on('input change', function() {
                    updateDataByPath(bindPath, $el.val());
                });
            }
        });
    }

    // ─── UI GENERATOR ────────────────────────────────────────────────

    function loadPageEditor(page) {
        $panel.html('<div class="oe-loading"><div class="oe-spinner"></div><span>Memuat...</span></div>');
        
        setTimeout(() => {
            $panel.empty();
            const data = contentData[page];
            
            // Page Header
            $panel.append(`
                <div class="oe-page-header">
                    <div>
                        <h2 class="oe-page-title">${getPageTitle(page)}</h2>
                        <div class="oe-page-subtitle">Edit konten untuk halaman ini.</div>
                    </div>
                </div>
            `);
            
            // Build sections based on page
            if (page === 'home') buildHomeEditor(data);
            else if (page === 'fitur') buildFiturEditor(data);
            else if (page === 'usecase') buildUseCaseEditor(data);
            else if (page === 'analitik') buildAnalitikEditor(data);
            else if (page === 'harga') buildHargaEditor(data);
            else if (page === 'footer') buildFooterEditor(data);
            
            // Bind input changes to our data object
            bindDataInputs($panel, '');
            
            hasUnsavedChanges = false;
            updateStatusUI();
            
        }, 100); // Small delay for UI smoothness
    }
    
    function getPageTitle(page) {
        const titles = { home: 'Beranda', fitur: 'Fitur Utama', usecase: 'Use Case', analitik: 'Analitik Data', harga: 'Harga & Paket', footer: 'Global Footer' };
        return titles[page] || page;
    }

    // ─── COMPONENT BUILDERS ──────────────────────────────────────────

    function createCard(title, icon, badge, isOpen, content) {
        return `
            <div class="oe-section-card">
                <div class="oe-section-header ${isOpen ? 'open' : ''}">
                    <div class="oe-section-icon"><i data-lucide="${icon}"></i></div>
                    <div class="oe-section-label">${title}</div>
                    ${badge ? `<div class="oe-section-badge">${badge}</div>` : ''}
                    <div class="oe-section-toggle">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>
                <div class="oe-section-body ${isOpen ? 'open' : ''}">
                    ${content}
                </div>
            </div>
        `;
    }

    function createField(label, bindPath, value, type = 'text', hint = '') {
        // Auto-upgrade text and textarea to richtext, except for technical fields
        if (type === 'text' || type === 'textarea') {
            const isTech = bindPath.includes('url') || bindPath.includes('.id') || bindPath.includes('icon') || bindPath.includes('whatsapp') || label.toLowerCase().includes('url') || label.toLowerCase().includes('icon');
            if (!isTech) {
                type = 'richtext';
            }
        }

        let inputHtml = '';
        if (type === 'richtext') {
            const fontOptions = `
                <option value="">Font Family</option>
                <option value="Inter, sans-serif">Inter</option>
                <option value="Outfit, sans-serif">Outfit</option>
                <option value="Roboto, sans-serif">Roboto</option>
                <option value="'Open Sans', sans-serif">Open Sans</option>
                <option value="Georgia, serif">Georgia</option>
            `;
            const sizeOptions = `
                <option value="">Ukuran Font</option>
                <option value="1">10px</option>
                <option value="2">13px</option>
                <option value="3">16px (Bawaan)</option>
                <option value="4">18px</option>
                <option value="5">24px</option>
                <option value="6">32px</option>
                <option value="7">48px</option>
            `;
            inputHtml = `
            <div class="oe-rt-toolbar">
                <select class="oe-rt-fontname">
                    ${fontOptions}
                </select>
                <select class="oe-rt-fontsize">
                    ${sizeOptions}
                </select>
                <button type="button" onmousedown="event.preventDefault()" onclick="document.execCommand('bold', false, null)" title="Bold"><b>B</b></button>
                <button type="button" onmousedown="event.preventDefault()" onclick="document.execCommand('italic', false, null)" title="Italic"><i>I</i></button>
                <button type="button" onmousedown="event.preventDefault()" onclick="const url = prompt('Enter link URL:'); if(url) document.execCommand('createLink', false, url);" title="Link">🔗</button>
                <button type="button" onmousedown="event.preventDefault()" onclick="document.execCommand('unlink', false, null)" title="Remove Link">🚫</button>
            </div>
            <div class="oe-richtext" contenteditable="true" data-bind="${bindPath}" data-placeholder="Ketik disini...">${value}</div>`;
        } else if (type === 'textarea') {
            inputHtml = `<textarea class="oe-input" data-bind="${bindPath}" rows="3">${value}</textarea>`;
        } else if (type === 'image') {
            const imgUrl = value.url || '';
            const imgPreview = imgUrl ? `<img src="${imgUrl}" alt="">` : `<div class="oe-image-placeholder"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg><span>No Image</span></div>`;
            inputHtml = `
                <div class="oe-image-picker">
                    <div class="oe-image-preview ${!imgUrl ? 'empty' : ''}">${imgPreview}</div>
                    <div class="oe-image-actions">
                        <button class="oe-btn oe-btn-ghost oe-btn-sm oe-btn-change-img" data-path="${bindPath.replace('.image_url', '')}">Pilih Gambar</button>
                    </div>
                </div>
            `;
        } else {
            inputHtml = `<input type="${type}" class="oe-input" data-bind="${bindPath}" value="${value.replace(/"/g, '&quot;')}">`;
        }

        return `
            <div class="oe-field">
                <div class="oe-field-label">${label}</div>
                ${inputHtml}
                ${hint ? `<div class="oe-field-hint">${hint}</div>` : ''}
            </div>
        `;
    }

    function createListEditor(items, bindPath, templateFn) {
        const listId = 'list-' + Math.random().toString(36).substr(2, 9);
        let itemsHtml = '';
        
        items.forEach((item, index) => {
            itemsHtml += `
                <div class="oe-list-item" data-index="${index}">
                    <div class="oe-drag-handle"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></div>
                    <div class="oe-list-item-content">
                        ${templateFn(item, `${bindPath}[${index}]`)}
                    </div>
                    <div class="oe-list-item-actions">
                        <button class="oe-btn-icon danger oe-remove-item" title="Hapus"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
                    </div>
                </div>
            `;
        });

        setTimeout(() => {
            const el = document.getElementById(listId);
            if (el && typeof Sortable !== 'undefined') {
                new Sortable(el, {
                    handle: '.oe-drag-handle',
                    animation: 150,
                    onEnd: function (evt) {
                        // Reorder array in contentData
                        const arrPath = bindPath;
                        const parts = arrPath.split('.');
                        let current = contentData[currentPage];
                        for (let i = 0; i < parts.length - 1; i++) {
                            current = current[parts[i]];
                        }
                        const lastPart = parts[parts.length - 1];
                        const arr = current[lastPart];
                        
                        const item = arr.splice(evt.oldIndex, 1)[0];
                        arr.splice(evt.newIndex, 0, item);
                        
                        markUnsaved();
                        // Re-render editor to update bindings
                        loadPageEditor(currentPage);
                    }
                });
            }
            
            // Bind add/remove
            $(`#${listId}-add`).on('click', function() {
                // Determine empty item structure based on the first item or a default
                const emptyItem = JSON.parse(JSON.stringify(items[0] || {}));
                Object.keys(emptyItem).forEach(k => emptyItem[k] = '');
                
                const parts = bindPath.split('.');
                let current = contentData[currentPage];
                for (let i = 0; i < parts.length - 1; i++) current = current[parts[i]];
                current[parts[parts.length-1]].push(emptyItem);
                
                markUnsaved();
                loadPageEditor(currentPage);
            });
            
            $(`#${listId}`).on('click', '.oe-remove-item', function() {
                const index = $(this).closest('.oe-list-item').data('index');
                const parts = bindPath.split('.');
                let current = contentData[currentPage];
                for (let i = 0; i < parts.length - 1; i++) current = current[parts[i]];
                current[parts[parts.length-1]].splice(index, 1);
                
                markUnsaved();
                loadPageEditor(currentPage);
            });
            
        }, 50);

        return `
            <div class="oe-list-editor" id="${listId}">
                ${itemsHtml}
            </div>
            <button class="oe-add-item-btn mt-3" id="${listId}-add">+ Tambah Item</button>
        `;
    }

    // ─── SPECIFIC PAGE BUILDERS ──────────────────────────────────────

    function buildHomeEditor(data) {
        let html = '';
        
        // Hero
        html += createCard('Hero Section', 'layout-template', 'Section', true, `
            ${createField('Judul Utama', 'hero.title', data.hero.title, 'richtext')}
            ${createField('Sub-judul', 'hero.subtitle', data.hero.subtitle, 'textarea')}
            <div class="oe-grid-2">
                ${createField('Badge 1', 'hero.badge1', data.hero.badge1)}
                ${createField('Badge 2', 'hero.badge2', data.hero.badge2)}
            </div>
            <div class="oe-grid-2">
                ${createField('Tombol Utama (Teks)', 'hero.cta_primary', data.hero.cta_primary)}
                ${createField('Tombol Utama (URL)', 'hero.cta_primary_url', data.hero.cta_primary_url)}
            </div>
        `);
        
        // Integrasi
        html += createCard('Integrasi', 'link', 'Section', false, `
            ${createField('Judul', 'integration.title', data.integration.title, 'richtext')}
            ${createField('Sub-judul', 'integration.subtitle', data.integration.subtitle)}
        `);
        
        // Trusted
        html += createCard('Trusted By', 'shield-check', 'Section', false, `
            ${createField('Judul', 'trusted.title', data.trusted.title)}
            ${createField('Sub-judul', 'trusted.subtitle', data.trusted.subtitle)}
        `);
        
        // CTA
        html += createCard('Call To Action', 'zap', 'Section', false, `
            ${createField('Judul', 'cta.title', data.cta.title)}
            ${createField('Sub-judul', 'cta.subtitle', data.cta.subtitle)}
            <div class="oe-grid-2">
                ${createField('Teks Tombol', 'cta.btn_text', data.cta.btn_text)}
                ${createField('URL Tombol', 'cta.btn_url', data.cta.btn_url)}
            </div>
        `);
        
        $panel.append(html);
        if (window.lucide) window.lucide.createIcons();
    }
    
    function buildFiturEditor(data) {
        let html = '';
        
        // Hero
        html += createCard('Hero Section', 'layout-template', 'Section', true, `
            ${createField('Badge', 'hero.badge', data.hero.badge)}
            ${createField('Judul', 'hero.title', data.hero.title, 'richtext')}
            ${createField('Sub-judul', 'hero.subtitle', data.hero.subtitle, 'textarea')}
            ${createField('Gambar Ilustrasi', 'hero.image_url', {url: data.hero.image_url, id: data.hero.image_id}, 'image')}
        `);
        
        // Feature Sections List
        html += `<div class="oe-section-group-title">Grup Fitur</div>`;
        
        data.sections.forEach((sec, sIdx) => {
            const itemsHtml = createListEditor(sec.items, `sections[${sIdx}].items`, (item, path) => `
                <div class="oe-list-item-row mb-2">
                    <input type="text" class="oe-input" style="width: 80px; flex:none" data-bind="${path}.icon" value="${item.icon}" placeholder="Icon name" title="Lucide icon name">
                    <input type="text" class="oe-input" data-bind="${path}.title" value="${item.title}" placeholder="Judul fitur">
                </div>
                <input type="text" class="oe-input" data-bind="${path}.desc" value="${item.desc}" placeholder="Deskripsi fitur">
            `);
            
            html += createCard(sec.badge || 'Section', 'layers', 'Fitur Group', false, `
                <div class="oe-grid-2">
                    ${createField('Badge', `sections[${sIdx}].badge`, sec.badge)}
                    ${createField('ID (Untuk URL/Anchor)', `sections[${sIdx}].id`, sec.id)}
                </div>
                ${createField('Judul', `sections[${sIdx}].title`, sec.title, 'richtext')}
                ${createField('Sub-judul', `sections[${sIdx}].subtitle`, sec.subtitle, 'textarea')}
                
                <div class="oe-field mt-4">
                    <div class="oe-field-label">Daftar Fitur</div>
                    ${itemsHtml}
                </div>
            `);
        });
        
        $panel.append(html);
        if (window.lucide) window.lucide.createIcons();
    }

    function buildUseCaseEditor(data) {
        let html = '';
        
        // Hero
        html += createCard('Hero Section', 'layout-template', 'Section', true, `
            ${createField('Badge', 'hero.badge', data.hero.badge)}
            ${createField('Judul', 'hero.title', data.hero.title, 'richtext')}
            ${createField('Sub-judul', 'hero.subtitle', data.hero.subtitle, 'textarea')}
            ${createField('Gambar Ilustrasi', 'hero.image_url', {url: data.hero.image_url, id: data.hero.image_id}, 'image')}
        `);
        
        // Use cases
        const itemsHtml = createListEditor(data.cases, 'cases', (item, path) => `
            <div class="oe-list-item-row mb-2">
                <input type="text" class="oe-input" style="width: 80px; flex:none" data-bind="${path}.icon" value="${item.icon}" placeholder="Icon">
                <input type="text" class="oe-input" data-bind="${path}.industry" value="${item.industry}" placeholder="Industri">
                <select class="oe-input" data-bind="${path}.package" style="width:140px; flex:none">
                    <option value="standard" ${item.package === 'standard' ? 'selected' : ''}>Standard</option>
                    <option value="pro" ${item.package === 'pro' ? 'selected' : ''}>Professional Plus</option>
                    <option value="all" ${item.package === 'all' ? 'selected' : ''}>Semua Paket</option>
                </select>
            </div>
            <textarea class="oe-input" data-bind="${path}.desc" rows="2" placeholder="Deskripsi use case">${item.desc}</textarea>
        `);
        
        html += createCard('Daftar Use Case', 'briefcase', 'List', false, `
            ${createField('Teks Banner Bawah Hero', 'banner.text', data.banner.text, 'richtext')}
            <div class="oe-field mt-4">
                <div class="oe-field-label">Industri & Kasus Penggunaan</div>
                ${itemsHtml}
            </div>
        `);
        
        $panel.append(html);
        if (window.lucide) window.lucide.createIcons();
    }

    function buildAnalitikEditor(data) {
        let html = '';
        html += createCard('Hero Section', 'layout-template', 'Section', true, `
            ${createField('Badge', 'hero.badge', data.hero.badge)}
            ${createField('Judul', 'hero.title', data.hero.title, 'richtext')}
            ${createField('Sub-judul', 'hero.subtitle', data.hero.subtitle, 'textarea')}
            ${createField('Gambar Ilustrasi', 'hero.image_url', {url: data.hero.image_url, id: data.hero.image_id}, 'image')}
        `);
        
        // Content
        const contentListHtml = createListEditor(data.content.items, 'content.items', (item, path) => `
            <input type="text" class="oe-input" data-bind="${path}" value="${item}">
        `);
        html += createCard('Konten Utama', 'file-text', 'Section', false, `
            ${createField('Judul', 'content.title', data.content.title)}
            ${createField('Sub-judul', 'content.subtitle', data.content.subtitle, 'textarea')}
            <div class="oe-field mt-4">
                <div class="oe-field-label">Poin-poin Manfaat</div>
                ${contentListHtml}
            </div>
        `);
        
        // Metrics
        const metricsHtml = createListEditor(data.metrics, 'metrics', (item, path) => `
            <div class="oe-list-item-row mb-2">
                <input type="text" class="oe-input" style="width: 80px; flex:none" data-bind="${path}.icon" value="${item.icon}" placeholder="Icon">
                <input type="text" class="oe-input" data-bind="${path}.title" value="${item.title}" placeholder="Judul metrik">
                <input type="text" class="oe-input" style="width: 100px; flex:none" data-bind="${path}.value" value="${item.value}" placeholder="Nilai (ex: 98%)">
            </div>
            <input type="text" class="oe-input" data-bind="${path}.desc" value="${item.desc}" placeholder="Deskripsi singkat">
        `);
        html += createCard('Daftar Metrik', 'bar-chart-2', 'List', false, `
            <div class="oe-field">
                <div class="oe-field-label">Indikator Kinerja Kunci (KPI)</div>
                ${metricsHtml}
            </div>
        `);
        
        $panel.append(html);
        if (window.lucide) window.lucide.createIcons();
    }

    function buildHargaEditor(data) {
        let html = '';
        html += createCard('Hero Section', 'layout-template', 'Section', true, `
            ${createField('Badge', 'hero.badge', data.hero.badge)}
            ${createField('Judul', 'hero.title', data.hero.title, 'richtext')}
            ${createField('Sub-judul', 'hero.subtitle', data.hero.subtitle, 'textarea')}
            ${createField('Gambar Ilustrasi', 'hero.image_url', {url: data.hero.image_url, id: data.hero.image_id}, 'image')}
        `);
        
        // Features list generator for packages
        const buildFeaturesList = (items, bindPath) => createListEditor(items, bindPath, (item, p) => `
            <div class="oe-list-item-row mb-2">
                <input type="text" class="oe-input" style="width: 80px; flex:none" data-bind="${p}.icon" value="${item.icon}" placeholder="Icon">
                <input type="text" class="oe-input" data-bind="${p}.label" value="${item.label}" placeholder="Label (ex: Kanal)">
                <label style="display:flex;align-items:center;gap:4px;font-size:11px;color:#94A3B8"><input type="checkbox" data-bind="${p}.highlight" ${item.highlight ? 'checked' : ''} style="accent-color:#D4AF37"> Highlight</label>
            </div>
            <input type="text" class="oe-input" data-bind="${p}.value" value="${item.value}" placeholder="Nilai/Deskripsi">
        `);

        html += createCard('Paket Harga', 'tag', 'Pricing', false, `
            <div class="oe-inner-tabs">
                <button class="oe-inner-tab active" data-target="#tab-std">Paket Standard</button>
                <button class="oe-inner-tab" data-target="#tab-pro">Professional Plus</button>
            </div>
            
            <div id="tab-std" class="oe-inner-tab-panel active">
                <div class="oe-grid-2">
                    ${createField('Nama Paket', 'paket_standard.name', data.paket_standard.name)}
                    ${createField('Harga per Bulan', 'paket_standard.price', data.paket_standard.price)}
                </div>
                <div class="oe-grid-2">
                    ${createField('Total Tagihan', 'paket_standard.total', data.paket_standard.total)}
                    ${createField('Syarat Durasi', 'paket_standard.duration', data.paket_standard.duration)}
                </div>
                <div class="oe-field mt-4">
                    <div class="oe-field-label">Daftar Fitur Paket</div>
                    ${buildFeaturesList(data.paket_standard.features, 'paket_standard.features')}
                </div>
            </div>
            
            <div id="tab-pro" class="oe-inner-tab-panel">
                <div class="oe-grid-2">
                    ${createField('Nama Paket', 'paket_pro.name', data.paket_pro.name)}
                    ${createField('Harga per Bulan', 'paket_pro.price', data.paket_pro.price)}
                </div>
                <div class="oe-grid-2">
                    ${createField('Total Tagihan', 'paket_pro.total', data.paket_pro.total)}
                    ${createField('Syarat Durasi', 'paket_pro.duration', data.paket_pro.duration)}
                </div>
                ${createField('Badge Rekomendasi', 'paket_pro.badge', data.paket_pro.badge)}
                <div class="oe-field mt-4">
                    <div class="oe-field-label">Daftar Fitur Paket</div>
                    ${buildFeaturesList(data.paket_pro.features, 'paket_pro.features')}
                </div>
            </div>
        `);
        
        html += createCard('Lainnya', 'more-horizontal', 'Section', false, `
            ${createField('Disclaimer / Syarat Ketentuan', 'disclaimer', data.disclaimer, 'textarea')}
            <div class="oe-section-group-title">Banner Enterprise Bawah</div>
            ${createField('Judul', 'enterprise.title', data.enterprise.title)}
            ${createField('Sub-judul', 'enterprise.subtitle', data.enterprise.subtitle, 'textarea')}
            <div class="oe-grid-2">
                ${createField('Teks Tombol', 'enterprise.btn_text', data.enterprise.btn_text)}
                ${createField('URL Tombol', 'enterprise.btn_url', data.enterprise.btn_url)}
            </div>
        `);
        
        $panel.append(html);
        if (window.lucide) window.lucide.createIcons();
    }

    function buildFooterEditor(data) {
        let html = '';
        
        html += createCard('Informasi Utama', 'info', 'Section', true, `
            ${createField('Tagline Pendek', 'tagline', data.tagline, 'textarea')}
            ${createField('Copyright Text', 'copyright', data.copyright)}
            ${createField('No. WhatsApp (Format 62xxx)', 'whatsapp', data.whatsapp)}
        `);
        
        // Navigation Lists
        const createNavEditor = (items, bindPath) => createListEditor(items, bindPath, (item, p) => `
            <div class="oe-list-item-row">
                <input type="text" class="oe-input" data-bind="${p}.label" value="${item.label}" placeholder="Label menu">
                <input type="text" class="oe-input" data-bind="${p}.url" value="${item.url}" placeholder="URL tujuan">
            </div>
        `);
        
        html += createCard('Menu Navigasi', 'link', 'List', false, `
            <div class="oe-grid-2">
                <div class="oe-field">
                    <div class="oe-field-label">Kolom 1 (Produk)</div>
                    ${createNavEditor(data.nav_produk, 'nav_produk')}
                </div>
                <div class="oe-field">
                    <div class="oe-field-label">Kolom 2 (Perusahaan)</div>
                    ${createNavEditor(data.nav_perusahaan, 'nav_perusahaan')}
                </div>
            </div>
        `);
        
        html += createCard('Media Sosial', 'share-2', 'Links', false, `
            <div class="oe-social-grid">
                <div class="oe-social-field">
                    <i class="oe-social-icon fa-brands fa-facebook" style="color:#1877F2"></i>
                    <input type="text" data-bind="social.facebook" value="${data.social.facebook}" placeholder="URL Facebook">
                </div>
                <div class="oe-social-field">
                    <i class="oe-social-icon fa-brands fa-x-twitter" style="color:#fff"></i>
                    <input type="text" data-bind="social.twitter" value="${data.social.twitter}" placeholder="URL X/Twitter">
                </div>
                <div class="oe-social-field">
                    <i class="oe-social-icon fa-brands fa-instagram" style="color:#E4405F"></i>
                    <input type="text" data-bind="social.instagram" value="${data.social.instagram}" placeholder="URL Instagram">
                </div>
                <div class="oe-social-field">
                    <i class="oe-social-icon fa-brands fa-linkedin" style="color:#0A66C2"></i>
                    <input type="text" data-bind="social.linkedin" value="${data.social.linkedin}" placeholder="URL LinkedIn">
                </div>
                <div class="oe-social-field">
                    <i class="oe-social-icon fa-brands fa-youtube" style="color:#FF0000"></i>
                    <input type="text" data-bind="social.youtube" value="${data.social.youtube}" placeholder="URL YouTube">
                </div>
            </div>
        `);
        
        $panel.append(html);
        if (window.lucide) window.lucide.createIcons();
    }

    // ─── SAVE / RESET / STATUS ───────────────────────────────────────
    
    function markUnsaved() {
        if (!hasUnsavedChanges) {
            hasUnsavedChanges = true;
            updateStatusUI();
        }
    }
    
    function updateStatusUI() {
        if (hasUnsavedChanges) {
            $status.html('Ada perubahan belum disimpan <span class="oe-unsaved-dot"></span>').removeClass('saved').addClass('saving');
        } else {
            $status.html('Semua perubahan tersimpan').removeClass('saving').addClass('saved');
        }
    }

    function flushDataInputs() {
        $panel.find('[data-bind]').each(function() {
            const $el = $(this);
            const bindPath = $el.attr('data-bind');
            if ($el.hasClass('oe-richtext')) {
                updateDataByPath(bindPath, $el.html());
            } else if ($el.is(':checkbox')) {
                updateDataByPath(bindPath, $el.is(':checked'));
            } else {
                updateDataByPath(bindPath, $el.val());
            }
        });
    }

    function saveCurrentPage(showFeedback = false) {
        if (isSaving) return;
        isSaving = true;
        
        flushDataInputs();

        
        if (showFeedback) {
            $saveBtn.html('<span class="oe-spinner" style="width:14px;height:14px;border-width:2px;margin-right:6px"></span>Menyimpan...');
        }
        
        $.ajax({
            url: config.ajaxUrl,
            type: 'POST',
            data: {
                action: 'omni_editor_save',
                nonce: config.nonce,
                page: currentPage,
                data: JSON.stringify(contentData[currentPage])
            },
            success: function(res) {
                isSaving = false;
                if (showFeedback) {
                    $saveBtn.html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13"/><polyline points="7 3 7 8 15 8"/></svg> Simpan');
                }
                
                if (res.success) {
                    hasUnsavedChanges = false;
                    updateStatusUI();
                    if (showFeedback) showToast(res.data.message, 'success');
                    
                    // Refresh iframe to show changes
                    refreshPreview();
                } else {
                    showToast(res.data || 'Gagal menyimpan', 'error');
                }
            },
            error: function() {
                isSaving = false;
                if (showFeedback) {
                    $saveBtn.html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13"/><polyline points="7 3 7 8 15 8"/></svg> Simpan');
                    showToast('Terjadi kesalahan koneksi', 'error');
                }
            }
        });
    }

    function resetCurrentPage() {
        if (!confirm('Anda yakin ingin mengembalikan konten halaman ini ke pengaturan awal (default)? Semua perubahan akan hilang.')) return;
        
        $resetBtn.css('opacity', '0.5').css('pointer-events', 'none');
        
        $.ajax({
            url: config.ajaxUrl,
            type: 'POST',
            data: {
                action: 'omni_editor_reset',
                nonce: config.nonce,
                page: currentPage
            },
            success: function(res) {
                $resetBtn.css('opacity', '1').css('pointer-events', 'auto');
                if (res.success) {
                    showToast(res.data.message, 'success');
                    contentData[currentPage] = res.data.defaults; // Load default back
                    hasUnsavedChanges = false;
                    loadPageEditor(currentPage);
                    refreshPreview();
                } else {
                    showToast(res.data || 'Gagal mereset', 'error');
                }
            },
            error: function() {
                $resetBtn.css('opacity', '1').css('pointer-events', 'auto');
                showToast('Terjadi kesalahan koneksi', 'error');
            }
        });
    }

    function showToast(msg, type = 'info') {
        const icons = {
            success: '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>',
            error: '<circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line>',
            info: '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line>'
        };
        
        const $toast = $(`
            <div class="oe-toast ${type}">
                <div class="oe-toast-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">${icons[type]}</svg></div>
                <div class="oe-toast-msg">${msg}</div>
                <div class="oe-toast-time">Baru saja</div>
            </div>
        `);
        
        $toastContainer.append($toast);
        
        setTimeout(() => {
            $toast.css('opacity', '0').css('transform', 'translateY(10px) scale(0.95)');
            setTimeout(() => $toast.remove(), 300);
        }, 4000);
    }

    // ─── START ───────────────────────────────────────────────────────
    init();

});
