{{-- Chat Widget Mejorado --}}
<div id="chat" class="chat-widget" :class="{ 'show': chatOpen }">
    <div class="chat-header">
        <div class="chat-header-content">
            <div class="chat-avatar">
                <i class="bi bi-headset"></i>
            </div>
            <div class="chat-title">
                <h4>Contáctanos</h4>
                <span class="chat-subtitle">Estamos aquí para ayudarte</span>
            </div>
        </div>
        <button id="cerrarChat" class="chat-close-btn" aria-label="Cerrar chat">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="chat-body">
        <div class="chat-welcome">
            <p>¡Hola! 👋 Completa el formulario y nos pondremos en contacto contigo pronto.</p>
        </div>

        <form action="{{ route('notificaciones-contacto.store') }}" method="POST" class="chat-form">
            @csrf
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nombre" class="form-label">
                        <i class="bi bi-person"></i>
                        Nombre *
                    </label>
                    <input type="text" 
                           id="nombre"
                           name="nombre"
                           class="form-input @error('nombre') error @enderror"
                           placeholder="Tu nombre"
                           value="{{ old('nombre') }}" 
                           required>
                    @error('nombre')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="apellidos" class="form-label">
                        <i class="bi bi-person-plus"></i>
                        Apellidos *
                    </label>
                    <input type="text" 
                           id="apellidos"
                           name="apellidos"
                           class="form-input @error('apellidos') error @enderror"
                           placeholder="Tus apellidos"
                           value="{{ old('apellidos') }}" 
                           required>
                    @error('apellidos')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="correo" class="form-label">
                    <i class="bi bi-envelope"></i>
                    Correo electrónico *
                </label>
                <input type="email" 
                       id="correo"
                       name="correo"
                       class="form-input @error('correo') error @enderror"
                       placeholder="tu@email.com"
                       value="{{ old('correo') }}" 
                       required>
                @error('correo')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="celular" class="form-label">
                    <i class="bi bi-phone"></i>
                    Teléfono
                </label>
                <input type="tel" 
                       id="celular"
                       name="celular"
                       class="form-input @error('celular') error @enderror"
                       placeholder="+593 99 999 9999"
                       value="{{ old('celular') }}">
                @error('celular')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="mensaje" class="form-label">
                    <i class="bi bi-chat-text"></i>
                    Mensaje *
                </label>
                <textarea id="mensaje"
                          name="mensaje" 
                          class="form-textarea @error('mensaje') error @enderror"
                          rows="4" 
                          placeholder="Cuéntanos cómo podemos ayudarte..."
                          required>{{ old('mensaje') }}</textarea>
                @error('mensaje')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="submit-btn">
                <i class="bi bi-send-fill"></i>
                <span>Enviar mensaje</span>
                <div class="btn-loader" style="display: none;">
                    <i class="bi bi-arrow-clockwise spin"></i>
                </div>
            </button>
        </form>
    </div>
</div>

{{-- Notificación de éxito --}}
@if (session('status'))
    <div class="success-notification" id="successNotification">
        <div class="notification-content">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('status') }}</span>
        </div>
        <button class="notification-close" onclick="closeNotification()">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif

{{-- Botón flotante --}}
<button id="abrirChat" class="chat-toggle-btn" aria-label="Abrir chat de contacto">
    <div class="btn-content">
        <i class="bi bi-chat-dots-fill"></i>
        <span class="btn-text">¿Necesitas ayuda?</span>
    </div>
    <div class="btn-pulse"></div>
</button>

<style>
/* Variables CSS */
:root {
    --chat-primary: #667eea;
    --chat-primary-dark: #5a6fd8;
    --chat-secondary: #764ba2;
    --chat-success: #10b981;
    --chat-error: #ef4444;
    --chat-text: #374151;
    --chat-text-light: #6b7280;
    --chat-bg: #ffffff;
    --chat-bg-secondary: #f9fafb;
    --chat-border: #e5e7eb;
    --chat-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --chat-shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --chat-radius: 16px;
    --chat-radius-sm: 8px;
    --chat-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Chat Widget Principal */
.chat-widget {
    position: fixed;
    bottom: 120px;
    right: 20px;
    width: 400px;
    max-width: calc(100vw - 40px);
    background: var(--chat-bg);
    border-radius: var(--chat-radius);
    box-shadow: var(--chat-shadow-lg);
    z-index: 1000;
    transform: translateY(20px) scale(0.95);
    opacity: 0;
    visibility: hidden;
    transition: var(--chat-transition);
    backdrop-filter: blur(10px);
    border: 1px solid var(--chat-border);
}

.chat-widget.show {
    transform: translateY(0) scale(1);
    opacity: 1;
    visibility: visible;
}

/* Header del Chat */
.chat-header {
    background: linear-gradient(135deg, var(--chat-primary), var(--chat-secondary));
    color: white;
    padding: 20px;
    border-radius: var(--chat-radius) var(--chat-radius) 0 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.chat-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
    border-radius: var(--chat-radius) var(--chat-radius) 0 0;
    pointer-events: none;
}

.chat-header-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.chat-avatar {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.chat-title h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.chat-subtitle {
    font-size: 13px;
    opacity: 0.9;
    display: block;
    margin-top: 2px;
}

.chat-close-btn {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--chat-transition);
    font-size: 14px;
}

.chat-close-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

/* Cuerpo del Chat */
.chat-body {
    padding: 24px;
    max-height: 600px;
    overflow-y: auto;
}

.chat-body::-webkit-scrollbar {
    width: 6px;
}

.chat-body::-webkit-scrollbar-track {
    background: var(--chat-bg-secondary);
    border-radius: 3px;
}

.chat-body::-webkit-scrollbar-thumb {
    background: var(--chat-border);
    border-radius: 3px;
}

.chat-body::-webkit-scrollbar-thumb:hover {
    background: var(--chat-text-light);
}

/* Mensaje de bienvenida */
.chat-welcome {
    background: var(--chat-bg-secondary);
    padding: 16px;
    border-radius: var(--chat-radius-sm);
    margin-bottom: 24px;
    border-left: 4px solid var(--chat-primary);
}

.chat-welcome p {
    margin: 0;
    color: var(--chat-text);
    font-size: 14px;
    line-height: 1.5;
}

/* Formulario */
.chat-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: var(--chat-text);
    margin-bottom: 0;
}

.form-label i {
    font-size: 12px;
    color: var(--chat-primary);
}

.form-input,
.form-textarea {
    padding: 12px 16px;
    border: 2px solid var(--chat-border);
    border-radius: var(--chat-radius-sm);
    font-size: 14px;
    color: var(--chat-text);
    background: var(--chat-bg);
    transition: var(--chat-transition);
    outline: none;
    font-family: inherit;
}

.form-input:focus,
.form-textarea:focus {
    border-color: var(--chat-primary);
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-input.error,
.form-textarea.error {
    border-color: var(--chat-error);
}

.form-textarea {
    resize: vertical;
    min-height: 80px;
    max-height: 120px;
}

.error-message {
    color: var(--chat-error);
    font-size: 12px;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.error-message::before {
    content: '⚠';
    font-size: 10px;
}

/* Botón de envío */
.submit-btn {
    background: linear-gradient(135deg, var(--chat-primary), var(--chat-secondary));
    color: white;
    border: none;
    padding: 14px 24px;
    border-radius: var(--chat-radius-sm);
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--chat-transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    position: relative;
    overflow: hidden;
}

.submit-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
}

.submit-btn:active {
    transform: translateY(0);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn-loader {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.spin {
    animation: spin 1s linear infinite;
}

/* Botón flotante */
.chat-toggle-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: linear-gradient(135deg, var(--chat-primary), var(--chat-secondary));
    color: white;
    border: none;
    padding: 16px 20px;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: var(--chat-shadow);
    transition: var(--chat-transition);
    font-weight: 600;
    font-size: 14px;
    z-index: 999;
    position: relative;
    overflow: hidden;
}

.chat-toggle-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--chat-shadow-lg);
}

.chat-toggle-btn:active {
    transform: translateY(0);
}

.btn-content {
    display: flex;
    align-items: center;
    gap: 8px;
    position: relative;
    z-index: 1;
}

.btn-text {
    white-space: nowrap;
}

.btn-pulse {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    transform: translate(-50%, -50%) scale(0);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: translate(-50%, -50%) scale(0);
        opacity: 1;
    }
    70% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0;
    }
    100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0;
    }
}

/* Notificación de éxito */
.success-notification {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: var(--chat-success);
    color: white;
    padding: 16px 20px;
    border-radius: var(--chat-radius-sm);
    box-shadow: var(--chat-shadow);
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 1001;
    animation: slideIn 0.3s ease-out;
    max-width: 350px;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
}

.notification-close {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    transition: var(--chat-transition);
}

.notification-close:hover {
    background: rgba(255, 255, 255, 0.3);
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Responsive */
@media (max-width: 480px) {
    .chat-widget {
        bottom: 100px;
        right: 10px;
        left: 10px;
        width: auto;
        max-width: none;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .chat-toggle-btn {
        bottom: 10px;
        right: 10px;
        padding: 14px 18px;
    }
    
    .btn-text {
        display: none;
    }
    
    .success-notification {
        bottom: 10px;
        right: 10px;
        left: 10px;
        max-width: none;
    }
}

@media (max-width: 320px) {
    .chat-body {
        padding: 16px;
    }
    
    .chat-header {
        padding: 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chat = document.getElementById('chat');
    const abrirChat = document.getElementById('abrirChat');
    const cerrarChat = document.getElementById('cerrarChat');
    const form = document.querySelector('.chat-form');
    const submitBtn = document.querySelector('.submit-btn');
    
    // Toggle chat
    function toggleChat() {
        chat.classList.toggle('show');
        
        // Si se abre el chat, hacer foco en el primer campo
        if (chat.classList.contains('show')) {
            setTimeout(() => {
                const firstInput = chat.querySelector('input');
                if (firstInput) firstInput.focus();
            }, 300);
        }
    }
    
    abrirChat.addEventListener('click', toggleChat);
    cerrarChat.addEventListener('click', toggleChat);
    
    // Cerrar chat al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!chat.contains(e.target) && !abrirChat.contains(e.target) && chat.classList.contains('show')) {
            chat.classList.remove('show');
        }
    });
    
    // Prevenir cierre cuando se hace clic dentro del chat
    chat.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Manejo del formulario
    if (form) {
        form.addEventListener('submit', function(e) {
            const btnText = submitBtn.querySelector('span');
            const btnLoader = submitBtn.querySelector('.btn-loader');
            
            // Mostrar loading
            submitBtn.disabled = true;
            btnText.style.opacity = '0';
            btnLoader.style.display = 'block';
        });
    }
    
    // Auto-resize textarea
    const textarea = document.getElementById('mensaje');
    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });
    }
    
    // Cerrar notificación automáticamente
    const notification = document.getElementById('successNotification');
    if (notification) {
        setTimeout(() => {
            closeNotification();
        }, 5000);
    }
});

// Función para cerrar notificación
function closeNotification() {
    const notification = document.getElementById('successNotification');
    if (notification) {
        notification.style.animation = 'slideIn 0.3s ease-out reverse';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }
}

// Validación en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-input, .form-textarea');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                this.classList.remove('error');
                const errorMsg = this.parentNode.querySelector('.error-message');
                if (errorMsg && !errorMsg.textContent.includes('campo es obligatorio')) {
                    errorMsg.style.display = 'none';
                }
            }
        });
    });
});

function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';
    
    // Validaciones básicas
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'Este campo es obligatorio';
    } else if (fieldName === 'correo' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Ingresa un correo válido';
        }
    } else if (fieldName === 'celular' && value) {
        const phoneRegex = /^[\+]?[\d\s\-\(\)]{8,}$/;
        if (!phoneRegex.test(value)) {
            isValid = false;
            errorMessage = 'Ingresa un teléfono válido';
        }
    }
    
    // Mostrar/ocultar error
    if (!isValid) {
        field.classList.add('error');
        showFieldError(field, errorMessage);
    } else {
        field.classList.remove('error');
        hideFieldError(field);
    }
    
    return isValid;
}

function showFieldError(field, message) {
    let errorElement = field.parentNode.querySelector('.error-message');
    if (!errorElement) {
        errorElement = document.createElement('span');
        errorElement.className = 'error-message';
        field.parentNode.appendChild(errorElement);
    }
    errorElement.textContent = message;
    errorElement.style.display = 'flex';
}

function hideFieldError(field) {
    const errorElement = field.parentNode.querySelector('.error-message');
    if (errorElement) {
        errorElement.style.display = 'none';
    }
}
</script>