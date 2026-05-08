<?php
/**
 * Plugin Name: WhatsApp Floating Chat with Lead Form
 * Plugin URI: https://omnichannel.biz.id
 * Description: Menambahkan tombol floating chat WhatsApp dengan form input (Nama, Perusahaan, Email, Pertanyaan) sebelum memulai chat.
 * Version: 1.0.0
 * Author: Harizal
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function wa_floating_chat_render_widget() {
    ?>
    <div id="wa-widget" style="position: fixed; bottom: 24px; right: 24px; z-index: 99999; display: flex; flex-direction: column; align-items: flex-end; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
      
      <!-- Form Modal -->
      <div id="wa-form-container" style="display: none; background: white; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; width: 320px; margin-bottom: 16px; overflow: hidden; transform-origin: bottom right; transition: opacity 0.3s ease; opacity: 0;">
        <div style="background: #25D366; color: white; padding: 16px; display: flex; justify-content: space-between; align-items: center;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            <h4 style="font-weight: 700; font-size: 14px; margin: 0;">Hubungi via WhatsApp</h4>
          </div>
          <button id="wa-close-btn" style="color: white; background: transparent; border: none; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; opacity: 0.8; transition: opacity 0.2s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
        </div>
        <div style="padding: 20px;">
          <p style="font-size: 13px; color: #4b5563; margin-top: 0; margin-bottom: 16px; line-height: 1.5;">Silakan isi formulir di bawah ini sebelum memulai percakapan dengan tim kami.</p>
          <form id="wa-chat-form" style="display: flex; flex-direction: column; gap: 12px; margin: 0;">
            <div>
              <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nama <span style="color: #ef4444;">*</span></label>
              <input type="text" id="wa-nama" required style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; box-sizing: border-box; transition: border-color 0.2s;">
            </div>
            <div>
              <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Perusahaan <span style="color: #ef4444;">*</span></label>
              <input type="text" id="wa-perusahaan" required style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; box-sizing: border-box; transition: border-color 0.2s;">
            </div>
            <div>
              <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Email <span style="color: #ef4444;">*</span></label>
              <input type="email" id="wa-email" required style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; box-sizing: border-box; transition: border-color 0.2s;">
            </div>
            <div>
              <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Pertanyaan <span style="color: #ef4444;">*</span></label>
              <textarea id="wa-pertanyaan" required rows="3" style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; box-sizing: border-box; transition: border-color 0.2s; resize: vertical;"></textarea>
            </div>
            <button type="submit" id="wa-submit-btn" style="width: 100%; background: #25D366; color: white; font-weight: 700; font-size: 15px; padding: 12px; border-radius: 8px; border: none; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 8px; margin-top: 8px; transition: background-color 0.2s;">
              <span>Kirim & Lanjut Chat</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
            </button>
          </form>
        </div>
      </div>
    
      <!-- Floating Button -->
      <button id="wa-toggle-btn" style="background: #25D366; color: white; border-radius: 9999px; padding: 16px; border: none; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; transform: translateY(0);">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
      </button>
    </div>
    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('wa-toggle-btn');
        const formContainer = document.getElementById('wa-form-container');
        const closeBtn = document.getElementById('wa-close-btn');
        
        // Button Hover Effects
        if (toggleBtn) {
            toggleBtn.addEventListener('mouseover', () => {
                toggleBtn.style.transform = 'translateY(-2px) scale(1.05)';
                toggleBtn.style.backgroundColor = '#20bd5a';
            });
            toggleBtn.addEventListener('mouseout', () => {
                toggleBtn.style.transform = 'translateY(0) scale(1)';
                toggleBtn.style.backgroundColor = '#25D366';
            });
            
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (formContainer.style.display === 'none' || formContainer.style.display === '') {
                    formContainer.style.display = 'block';
                    // Trigger reflow
                    void formContainer.offsetWidth;
                    formContainer.style.opacity = '1';
                } else {
                    formContainer.style.opacity = '0';
                    setTimeout(() => {
                        formContainer.style.display = 'none';
                    }, 300);
                }
            });
        }
        
        if (closeBtn) {
            closeBtn.addEventListener('mouseover', () => closeBtn.style.opacity = '1');
            closeBtn.addEventListener('mouseout', () => closeBtn.style.opacity = '0.8');
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                formContainer.style.opacity = '0';
                setTimeout(() => {
                    formContainer.style.display = 'none';
                }, 300);
            });
        }
        
        // Input Focus Effects
        const inputs = document.querySelectorAll('#wa-form-container input, #wa-form-container textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', () => input.style.borderColor = '#25D366');
            input.addEventListener('blur', () => input.style.borderColor = '#d1d5db');
        });

        // Form Submit
        const waForm = document.getElementById('wa-chat-form');
        const submitBtn = document.getElementById('wa-submit-btn');
        
        if (submitBtn) {
            submitBtn.addEventListener('mouseover', () => submitBtn.style.backgroundColor = '#20bd5a');
            submitBtn.addEventListener('mouseout', () => submitBtn.style.backgroundColor = '#25D366');
        }
        
        if (waForm) {
          waForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nama = document.getElementById('wa-nama').value;
            const perusahaan = document.getElementById('wa-perusahaan').value;
            const email = document.getElementById('wa-email').value;
            const pertanyaan = document.getElementById('wa-pertanyaan').value;
            
            const targetPhone = '6281283835553';
            const message = `Halo tim Kabayan,\n\nSaya ingin bertanya.\n\n*Nama:* ${nama}\n*Perusahaan:* ${perusahaan}\n*Email:* ${email}\n*Pertanyaan:*\n${pertanyaan}`;
            
            const encodedMessage = encodeURIComponent(message);
            const waUrl = `https://wa.me/${targetPhone}?text=${encodedMessage}`;
            
            window.open(waUrl, '_blank');
            
            formContainer.style.opacity = '0';
            setTimeout(() => {
                formContainer.style.display = 'none';
            }, 300);
            waForm.reset();
          });
        }
      });
    </script>
    <?php
}
add_action('wp_footer', 'wa_floating_chat_render_widget', 100);
