<?php 
$title = 'Chat de Apoio';
require_once __DIR__ . '/../layout/header.php'; 
?>

<main class="py-6 px-4 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 mb-6 sticky top-20 z-10">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                    <a href="/conversa" class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-900 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div class="flex-1">
                        <h1 class="text-xl md:text-2xl font-bold text-gray-900">
                            <?php if ($user['role'] === 'volunteer' || $user['role'] === 'admin'): ?>
                                <?= htmlspecialchars($chatRoom['user_name']) ?>
                            <?php else: ?>
                                <?= $chatRoom['volunteer_name'] ? htmlspecialchars($chatRoom['volunteer_name']) : 'Aguardando voluntária' ?>
                            <?php endif; ?>
                        </h1>
                        <div class="flex items-center gap-3 mt-1 flex-wrap">
                            <?php if ($chatRoom['status'] === 'waiting'): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <svg class="w-3.5 h-3.5 mr-1.5 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Aguardando
                                </span>
                            <?php elseif ($chatRoom['status'] === 'active'): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                    Online
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800 border border-gray-200">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Encerrado
                                </span>
                            <?php endif; ?>
                            <span class="text-sm text-gray-500">Chat #<?= $chatRoom['id'] ?></span>
                        </div>
                    </div>
                </div>

                <?php if ($chatRoom['status'] === 'active'): ?>
                    <div class="flex gap-2">
                        <?php if ($user['role'] === 'user' && $chatRoom['user_id'] == $user['id']): ?>
                            <!-- Botão para usuária finalizar o chat -->
                            <button id="finish-chat-btn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg text-sm" onclick="finishChat()">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Finalizar Chat
                            </button>
                        <?php elseif (($user['role'] === 'volunteer' || $user['role'] === 'admin') && $chatRoom['volunteer_id'] == $user['id']): ?>
                            <!-- Botão para voluntária/admin encerrar o chat -->
                            <form method="POST" action="/conversa/<?= $chatRoom['id'] ?>/close" class="inline">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg text-sm" onclick="return confirm('Tem certeza que deseja encerrar esta conversa?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Encerrar
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Status Alerts -->
        <?php if ($chatRoom['status'] === 'waiting' && $user['role'] === 'user'): ?>
            <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-yellow-500 flex-shrink-0 mt-0.5 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <span>Sua mensagem foi recebida. Uma voluntária irá atendê-la em breve. Por favor, aguarde.</span>
            </div>
        <?php endif; ?>

        <?php if ($chatRoom['status'] === 'closed'): ?>
            <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 text-blue-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <span>Esta conversa foi encerrada. Se precisar de mais ajuda, você pode iniciar uma nova conversa.</span>
            </div>
        <?php endif; ?>

        <!-- Messages Container -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 mb-6 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        <span class="font-semibold text-gray-900">Mensagens</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div id="message-count" class="text-sm text-gray-500 font-medium">
                            <?= count($messages) ?> mensagem<?= count($messages) !== 1 ? 's' : '' ?>
                        </div>
                        <div id="typing-indicator" class="hidden text-sm text-primary font-medium flex items-center gap-1.5">
                            <span class="flex gap-1">
                                <span class="w-2 h-2 bg-primary rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                                <span class="w-2 h-2 bg-primary rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                                <span class="w-2 h-2 bg-primary rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                            </span>
                            Digitando
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="messages-container" class="p-6 space-y-4 max-h-[600px] overflow-y-auto bg-gradient-to-br from-gray-50/30 to-white">
                <?php if (empty($messages)): ?>
                    <div class="text-center py-20">
                        <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Nenhuma mensagem ainda</h3>
                        <p class="text-gray-600">Envie a primeira mensagem para iniciar a conversa.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($messages as $message): ?>
                        <?php $isOwnMessage = $message['sender_id'] == $user['id']; ?>
                        <div class="flex <?= $isOwnMessage ? 'justify-end' : 'justify-start' ?> animate-fade-in">
                            <div class="max-w-[75%] md:max-w-[60%]">
                                <div class="<?= $isOwnMessage ? 'bg-gradient-to-br from-primary to-primary-hover text-white' : 'bg-white border-2 border-gray-200 text-gray-900' ?> rounded-2xl px-5 py-3 shadow-md">
                                    <p class="text-sm leading-relaxed whitespace-pre-wrap break-words"><?= nl2br(htmlspecialchars($message['content'])) ?></p>
                                </div>
                                <div class="flex items-center gap-2 mt-2 px-2 <?= $isOwnMessage ? 'justify-end' : 'justify-start' ?>">
                                    <span class="text-xs text-gray-500 font-medium">
                                        <?= date('d/m/Y H:i', strtotime($message['created_at'])) ?>
                                    </span>
                                    <?php if (!$isOwnMessage): ?>
                                        <span class="text-xs text-gray-400 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <?= $message['sender_role'] === 'volunteer' ? 'Voluntária' : 'Usuária' ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Message Input -->
        <?php if ($chatRoom['status'] !== 'closed'): ?>
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sticky bottom-4">
                <form id="message-form" class="flex gap-3">
                    <div class="flex-1 relative">
                        <input type="text" id="message-input" name="content" required
                               class="w-full px-5 py-4 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 pr-12"
                               placeholder="Digite sua mensagem...">
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" id="send-button" class="bg-gradient-to-r from-primary to-primary-hover hover:shadow-lg text-white px-6 py-4 rounded-xl font-semibold transition-all duration-200 flex items-center gap-2 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        <span class="hidden sm:inline">Enviar</span>
                    </button>
                </form>
                
                <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-500">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Suas mensagens são seguras e anônimas
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
let lastMessageId = <?= !empty($messages) ? end($messages)['id'] : 0 ?>;
let isTyping = false;
let typingTimeout;
let isFetching = false;
const renderedIds = new Set([
    <?php if (!empty($messages)): ?>
        <?php $ids = array_map(fn($m) => (int)$m['id'], $messages); echo implode(',', $ids); ?>
    <?php endif; ?>
]);

async function fetchNewMessages() {
    if (isFetching) return;
    isFetching = true;
    try {
        const response = await fetch(`/conversa/<?= $chatRoom['id'] ?>/messages?since=${lastMessageId}`);
        if (response.ok) {
            const data = await response.json();
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(message => {
                    addMessageToChat(message);
                    lastMessageId = Math.max(lastMessageId, message.id);
                });
                updateMessageCount();
                scrollToBottom();
            }
        }
    } catch (error) {
        console.error('Erro ao buscar mensagens:', error);
    } finally {
        isFetching = false;
    }
}

function addMessageToChat(message) {
    const container = document.getElementById('messages-container');
    const isEmpty = container.querySelector('.text-center');
    
    if (isEmpty) {
        container.innerHTML = '';
    }
    
    if (renderedIds.has(message.id)) {
        return;
    }
    renderedIds.add(message.id);

    const isOwnMessage = message.sender_id == <?= $user['id'] ?>;
    const messageDiv = document.createElement('div');
    messageDiv.className = `flex ${isOwnMessage ? 'justify-end' : 'justify-start'} animate-fade-in`;
    messageDiv.dataset.messageId = String(message.id);
    
    const date = new Date(message.created_at);
    const formattedDate = date.toLocaleDateString('pt-BR') + ' ' + date.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
    
    messageDiv.innerHTML = `
        <div class="max-w-[75%] md:max-w-[60%]">
            <div class="${isOwnMessage ? 'bg-gradient-to-br from-primary to-primary-hover text-white' : 'bg-white border-2 border-gray-200 text-gray-900'} rounded-2xl px-5 py-3 shadow-md">
                <p class="text-sm leading-relaxed whitespace-pre-wrap break-words">${message.content.replace(/\n/g, '<br>')}</p>
            </div>
            <div class="flex items-center gap-2 mt-2 px-2 ${isOwnMessage ? 'justify-end' : 'justify-start'}">
                <span class="text-xs text-gray-500 font-medium">${formattedDate}</span>
                ${!isOwnMessage ? `<span class="text-xs text-gray-400 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    ${message.sender_role === 'volunteer' ? 'Voluntária' : 'Usuária'}
                </span>` : ''}
            </div>
        </div>
    `;
    
    container.appendChild(messageDiv);
}

function updateMessageCount() {
    const messages = document.querySelectorAll('#messages-container > div:not(.text-center)');
    const count = messages.length;
    document.getElementById('message-count').textContent = `${count} mensagem${count !== 1 ? 's' : ''}`;
}

function scrollToBottom() {
    const container = document.getElementById('messages-container');
    container.scrollTop = container.scrollHeight;
}

function showTypingIndicator() {
    document.getElementById('typing-indicator')?.classList.remove('hidden');
}

function hideTypingIndicator() {
    document.getElementById('typing-indicator')?.classList.add('hidden');
}

document.getElementById('message-form')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const input = document.getElementById('message-input');
    const sendButton = document.getElementById('send-button');
    const content = input.value.trim();
    
    if (!content) return;
    
    sendButton.disabled = true;
    sendButton.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
    
    try {
        const response = await fetch('/conversa/<?= $chatRoom['id'] ?>/message', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'content=' + encodeURIComponent(content)
        });
        
        if (response.ok) {
            input.value = '';
            await fetchNewMessages();
        } else {
            alert('Erro ao enviar mensagem. Tente novamente.');
        }
    } catch (error) {
        console.error('Erro ao enviar mensagem:', error);
        alert('Erro ao enviar mensagem. Tente novamente.');
    } finally {
        sendButton.disabled = false;
        sendButton.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg><span class="hidden sm:inline">Enviar</span>';
    }
});

document.getElementById('message-input')?.addEventListener('input', () => {
    if (!isTyping) {
        isTyping = true;
        showTypingIndicator();
    }
    
    clearTimeout(typingTimeout);
    typingTimeout = setTimeout(() => {
        isTyping = false;
        hideTypingIndicator();
    }, 1000);
});

setInterval(fetchNewMessages, 3000);

// Função para finalizar chat
async function finishChat() {
    if (!confirm('Tem certeza que deseja finalizar este chat? Esta ação não pode ser desfeita.')) {
        return;
    }
    
    const finishBtn = document.getElementById('finish-chat-btn');
    if (!finishBtn) return;
    
    // Desabilitar botão e mostrar loading
    finishBtn.disabled = true;
    finishBtn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Finalizando...';
    
    try {
        const response = await fetch('/conversa/<?= $chatRoom['id'] ?>/finish', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            // Mostrar mensagem de sucesso
            showSuccessMessage('Chat finalizado com sucesso!');
            
            // Redirecionar após um breve delay
            setTimeout(() => {
                window.location.href = '/conversa';
            }, 2000);
        } else {
            showErrorMessage(data.error || 'Erro ao finalizar chat');
            // Reabilitar botão
            finishBtn.disabled = false;
            finishBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Finalizar Chat';
        }
    } catch (error) {
        console.error('Erro ao finalizar chat:', error);
        showErrorMessage('Erro ao finalizar chat. Tente novamente.');
        // Reabilitar botão
        finishBtn.disabled = false;
        finishBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Finalizar Chat';
    }
}

// Funções para mostrar mensagens
function showSuccessMessage(message) {
    const alert = document.createElement('div');
    alert.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
    alert.innerHTML = `
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            ${message}
        </div>
    `;
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

function showErrorMessage(message) {
    const alert = document.createElement('div');
    alert.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
    alert.innerHTML = `
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            ${message}
        </div>
    `;
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

document.addEventListener('DOMContentLoaded', () => {
    scrollToBottom();
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>