<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Rede Elas - Apoio e Segurança' ?></title>
    <link rel="stylesheet" href="/app/globals.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#cb99ac',
                        'primary-hover': '#b58198',
                        secondary: '#eddbe0',
                        'secondary-hover': '#e5c6d0',
                        success: '#cb99ac',
                        warning: '#cb99ac',
                        danger: '#cb99ac',
                        background: '#eddbe0',
                        foreground: '#1e293b',
                        muted: '#f6eef1',
                        'muted-foreground': '#7a5362',
                        border: '#e8d2d9'
                    }
                }
            }
        }
        
        // Função de saída rápida
        function quickExit() {
            window.location.replace('https://www.google.com');
            window.history.replaceState(null, null, 'https://www.google.com');
        }
        
        // Função de emergência
        function emergency() {
            showEmergencyModal();
        }
        
        // Mostrar modal de emergência
        function showEmergencyModal() {
            const modal = document.getElementById('emergency-modal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loadUserEmergencyContacts();
        }
        
        // Fechar modal de emergência
        function closeEmergencyModal() {
            const modal = document.getElementById('emergency-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Ligar para emergência
        function callEmergency(number) {
            window.location.href = `tel:${number}`;
            closeEmergencyModal();
        }
        
        // Buscar contatos de emergência do usuário
        async function loadUserEmergencyContacts() {
            try {
                const response = await fetch('/emergency/contacts');
                if (response.ok) {
                    const contacts = await response.json();
                    displayUserContacts(contacts);
                }
            } catch (error) {
                console.error('Erro ao carregar contatos:', error);
            }
        }
        
        // Exibir contatos do usuário no modal
        function displayUserContacts(contacts) {
            const container = document.getElementById('user-contacts-container');
            if (!container || contacts.length === 0) return;
            
            container.innerHTML = '';
            
            contacts.forEach(contact => {
                const contactDiv = document.createElement('div');
                contactDiv.className = 'flex items-center justify-between p-3 bg-purple-50 border border-purple-200 rounded-lg';
                contactDiv.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">${contact.contact_name.charAt(0)}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">${contact.contact_name}</p>
                            <p class="text-sm text-gray-600">${contact.contact_relationship}</p>
                        </div>
                    </div>
                    <button onclick="callEmergency('${contact.contact_phone}')" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Ligar
                    </button>
                `;
                container.appendChild(contactDiv);
            });
        }
        
        // Função para mostrar/ocultar menu mobile
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Fechar modal com tecla ESC
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeEmergencyModal();
            }
        });
    </script>
</head>
<body class="bg-background text-foreground font-sans">
    <!-- Botão de Saída Rápida -->
    <button onclick="quickExit()" class="fixed top-4 right-4 z-30 text-sm px-3 py-2 shadow-lg bg-red-600 hover:bg-red-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
        ✕ Sair Rápido
    </button>
    
    <!-- Botão de Emergência -->
    <button onclick="emergency()" class="fixed bottom-6 right-6 z-50 w-16 h-16 rounded-full shadow-2xl flex items-center justify-center text-2xl bg-red-600 hover:bg-red-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
        🚨
    </button>
    
    <!-- Navegação -->
    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-40 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="/public/logo.png" alt="Rede Elas" class="w-10 h-10 rounded-lg object-cover" />
                    </a>
                </div>
                
                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-primary font-medium transition-colors">Início</a>
                    <a href="/blog" class="text-gray-700 hover:text-primary font-medium transition-colors">Blog</a>
                    <a href="/depoimentos" class="text-gray-700 hover:text-primary font-medium transition-colors">Depoimentos</a>
                    <a href="/sobre" class="text-gray-700 hover:text-primary font-medium transition-colors">Sobre</a>
                    
                    <?php if (isset($user)): ?>
                        <a href="/conversa" class="text-gray-700 hover:text-primary font-medium transition-colors">Chat</a>
                        <a href="/emergency" class="text-gray-700 hover:text-primary font-medium transition-colors">Emergência</a>
                        <?php if ($user['role'] === 'admin'): ?>
                            <a href="/admin" class="text-gray-700 hover:text-primary font-medium transition-colors">Admin</a>
                        <?php endif; ?>
                        <a href="/logout" class="border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">Sair</a>
                    <?php else: ?>
                        <a href="/login" class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">Entrar</a>
                    <?php endif; ?>
                </div>
                
                <!-- Botão Menu Mobile -->
                <div class="md:hidden">
                    <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-primary focus:outline-none focus:text-primary">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Menu Mobile -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="/" class="block px-3 py-2 text-gray-700 hover:text-primary font-medium">Início</a>
                <a href="/blog" class="block px-3 py-2 text-gray-700 hover:text-primary font-medium">Blog</a>
                <a href="/depoimentos" class="block px-3 py-2 text-gray-700 hover:text-primary font-medium">Depoimentos</a>
                <a href="/sobre" class="block px-3 py-2 text-gray-700 hover:text-primary font-medium">Sobre</a>
                
                <?php if (isset($user)): ?>
                    <a href="/conversa" class="block px-3 py-2 text-gray-700 hover:text-primary font-medium">Chat</a>
                    <a href="/emergency" class="block px-3 py-2 text-gray-700 hover:text-primary font-medium">Emergência</a>
                    <?php if ($user['role'] === 'admin'): ?>
                        <a href="/admin" class="block px-3 py-2 text-gray-700 hover:text-primary font-medium">Admin</a>
                    <?php endif; ?>
                    <a href="/logout" class="block px-3 py-2 text-gray-700 hover:text-primary font-medium">Sair</a>
                <?php else: ?>
                    <a href="/login" class="block px-3 py-2 btn btn-primary text-center">Entrar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <!-- Modal de Emergência -->
    <div id="emergency-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" onclick="if (event.target === this) closeEmergencyModal()">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300" role="dialog" aria-modal="true" aria-labelledby="emergency-title">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <span class="text-red-600 text-xl">🚨</span>
                    </div>
                    <h3 id="emergency-title" class="text-lg font-semibold text-gray-900">Emergência</h3>
                </div>
                <button onclick="closeEmergencyModal()" class="text-gray-400 hover:text-gray-600 transition-colors" aria-label="Fechar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="px-6 py-4">
                <p class="text-gray-700 mb-4">
                    Se você está em perigo imediato, ligue para um dos números de emergência:
                </p>
                
                <!-- Contatos do Usuário -->
                <div id="user-contacts-container" class="space-y-3 mb-6">
                    <!-- Contatos serão carregados via JavaScript -->
                </div>
                
                <!-- Separador -->
                <div class="border-t border-gray-200 my-6">
                    <p class="text-center text-sm text-gray-500 -mt-3">
                        <span class="bg-white px-3">Números de Emergência Oficiais</span>
                    </p>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">190</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Polícia Militar</p>
                                <p class="text-sm text-gray-600">Emergências de segurança</p>
                            </div>
                        </div>
                        <button onclick="callEmergency('190')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Ligar
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">180</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Central da Mulher</p>
                                <p class="text-sm text-gray-600">Violência contra a mulher</p>
                            </div>
                        </div>
                        <button onclick="callEmergency('180')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Ligar
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">188</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">CVV</p>
                                <p class="text-sm text-gray-600">Apoio emocional</p>
                            </div>
                        </div>
                        <button onclick="callEmergency('188')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Ligar
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 flex gap-3 justify-end">
                <button onclick="closeEmergencyModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
