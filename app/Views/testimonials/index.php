<?php 
$title = 'Histórias de Mulheres Fortes';
require_once BASE_PATH . '/app/Views/layout/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section bg-gradient-to-br from-secondary to-white py-16 px-4  md:">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 animate-fade-in">
                Histórias de Mulheres Fortes
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Histórias reais de mulheres que encontraram força para reconstruir suas vidas. 
                <span class="text-primary font-semibold">Você não está sozinha.</span>
            </p>
            <button onclick="document.getElementById('testimonial-form').classList.toggle('hidden')" 
                    class="px-8 py-4 text-lg animate-slide-up bg-primary hover:bg-primary-hover text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition">
                + Compartilhar Minha História
            </button>
        </div>
    </div>
</section>

<main class="py-12 px-4">
    <div class="max-w-4xl mx-auto">

        <!-- Mensagens -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 bg-green-50 border-2 border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 bg-red-50 border-2 border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Formulário de Depoimento -->
        <div id="testimonial-form" class="hidden mb-8 card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-primary rounded-lg flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-2xl">✍️</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Compartilhe Sua História</h2>
                <p class="text-gray-600">Sua história pode inspirar outras mulheres</p>
            </div>
            
            <form method="POST" action="/depoimentos/create" class="space-y-4">
                <div>
                    <label class="form-label block text-sm font-medium text-gray-700 mb-1">Nome ou Iniciais</label>
                    <input type="text" name="author_name" required maxlength="100"
                           class="w-full px-4 py-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition"
                           placeholder="Ex: M.S. ou Maria">
                </div>
                
                <div>
                    <label class="form-label block text-sm font-medium text-gray-700 mb-1">Seu Depoimento (máx. 1000 caracteres)</label>
                    <textarea name="content" required maxlength="1000" rows="6"
                              class="w-full px-4 py-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition resize-y"
                              placeholder="Compartilhe sua história de superação..."></textarea>
                </div>
                
                <div class="alert alert-warning bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-md">
                    <div class="flex items-start space-x-3">
                        <span class="text-yellow-600 text-lg">⚠️</span>
                        <div>
                            <h4 class="font-semibold text-yellow-800 mb-1">Importante</h4>
                            <p class="text-sm text-yellow-700">
                                Não compartilhe informações que possam identificá-la (endereço, telefone, nomes completos). 
                                Todos os depoimentos passam por moderação antes de serem publicados.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Enviar Depoimento
                    </button>
                    <button type="button" onclick="document.getElementById('testimonial-form').classList.add('hidden')"
                            class="flex-1 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mb-8 bg-primary-light border border-primary rounded-lg p-6">
            <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-secondary rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <span class="text-primary text-sm">ℹ️</span>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 mb-1">Sobre os Depoimentos</h4>
                    <p class="text-sm text-gray-700">
                        Todos os depoimentos são anônimos e passam por moderação antes de serem publicados para garantir a segurança de todas. 
                        Você pode usar iniciais ou um nome fictício.
                    </p>
                </div>
            </div>
        </div>

        <!-- Lista de Depoimentos -->
        <div class="space-y-6">
            <?php if (empty($testimonials)): ?>
                <div class="card text-center py-12 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-gray-400 text-2xl">📝</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Nenhum depoimento ainda</h3>
                    <p class="text-gray-600">Seja a primeira a compartilhar sua história de superação.</p>
                </div>
            <?php else: ?>
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="card card-hover bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">
                                        <?= strtoupper(substr($testimonial['author_name'], 0, 2)) ?>
                                    </span>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-900">
                                        <?= htmlspecialchars($testimonial['author_name']) ?>
                                    </span>
                                    <div class="text-sm text-gray-500">
                                        <?= date('d/m/Y', strtotime($testimonial['created_at'])) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-500">Depoimento</div>
                                <div class="text-xs text-gray-400">Aprovado</div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <p class="text-gray-800 leading-relaxed">
                                <?= nl2br(htmlspecialchars($testimonial['content'])) ?>
                            </p>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="inline">
                                <button type="button"
                                        data-endpoint="/depoimentos/like/<?= $testimonial['id'] ?>"
                                        data-liked="<?= in_array($testimonial['id'], $likedTestimonials ?? []) ? '1' : '0' ?>"
                                        class="testimonial-like-btn flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-200 <?= in_array($testimonial['id'], $likedTestimonials ?? []) ? 'bg-green-100 text-green-700' : 'bg-gray-100 hover:bg-green-100 text-gray-700 hover:text-green-700' ?>"
                                        <?= in_array($testimonial['id'], $likedTestimonials ?? []) ? 'disabled' : '' ?>>
                                    <span class="like-heart" aria-hidden="true"><?= in_array($testimonial['id'], $likedTestimonials ?? []) ? '❤️' : '🤍' ?></span>
                                    <span class="like-text text-sm font-medium">
                                        <span class="like-count"><?= $testimonial['likes'] ?></span> <span class="like-label"><?= $testimonial['likes'] == 1 ? 'pessoa apoiou' : 'pessoas apoiaram' ?></span>
                                    </span>
                                </button>
                            </div>
                            
                            <div class="text-sm text-gray-500">
                                💪 História de força
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Paginação -->
        <div class="mt-10 flex items-center justify-center gap-2">
            <?php if (($page ?? 1) > 1): ?>
                <a href="/depoimentos?page=<?= ($page - 1) ?>" class="px-3 py-2 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-gray-700">Anterior</a>
            <?php endif; ?>
            <span class="px-3 py-2 text-sm text-gray-600">Página <?= $page ?? 1 ?> de <?= $totalPages ?? 1 ?></span>
            <?php if (($page ?? 1) < ($totalPages ?? 1)): ?>
                <a href="/depoimentos?page=<?= ($page + 1) ?>" class="px-3 py-2 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-gray-700">Próxima</a>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
// Like (apoio) via fetch para evitar navegação
document.querySelectorAll('.testimonial-like-btn').forEach((btn) => {
  btn.addEventListener('click', async () => {
    if (btn.disabled || btn.dataset.liked === '1') return;
    const endpoint = btn.dataset.endpoint;
    try {
      const res = await fetch(endpoint, { method: 'POST' });
      const ok = res.ok;
      // tenta ler json, mas pode falhar se backend devolver só texto
      let data = null;
      try { data = await res.json(); } catch (_) {}
      if (ok && (!data || data.success)) {
        // atualizar UI
        const countEl = btn.querySelector('.like-count');
        const labelEl = btn.querySelector('.like-label');
        const heartEl = btn.querySelector('.like-heart');
        const newCount = (parseInt(countEl.textContent || '0', 10) || 0) + 1;
        countEl.textContent = newCount;
        labelEl.textContent = newCount === 1 ? 'pessoa apoiou' : 'pessoas apoiaram';
        heartEl.textContent = '❤️';
        btn.dataset.liked = '1';
        btn.disabled = true;
        btn.classList.remove('bg-gray-100','text-gray-700');
        btn.classList.add('bg-green-100','text-green-700');
      }
    } catch (e) {
      console.error('Falha ao enviar apoio', e);
    }
  });
});
</script>

<?php include BASE_PATH . '/app/Views/layout/footer.php'; ?>
