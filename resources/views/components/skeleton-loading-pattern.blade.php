{{-- 
  Exemple réel: Intégration Skeleton Loader dans une page de liste
  Utilisé pour: nationalites.index, mariages.index, etc.
--}}

<script>
document.addEventListener('DOMContentLoaded', function() {
    // === SKELETON LOADING PATTERN ===
    // 1. Au chargement de la page, afficher les skeletons
    // 2. Attendre le chargement du DOM
    // 3. Masquer les skeletons et afficher le contenu réel

    const skeletonTargets = document.querySelectorAll('[data-skeleton-placeholder]');
    
    skeletonTargets.forEach(placeholder => {
        const contentId = placeholder.getAttribute('data-content-id');
        const type = placeholder.getAttribute('data-skeleton-type') || 'table';
        
        // Afficher skeleton
        SkeletonLoader.show(placeholder.id, type);
        
        // Masquer le contenu réel initialement
        const content = document.getElementById(contentId);
        if (content) {
            content.style.display = 'none';
        }
    });
    
    // Quand la page est chargée
    window.addEventListener('load', function() {
        skeletonTargets.forEach(placeholder => {
            const contentId = placeholder.getAttribute('data-content-id');
            
            // Masquer skeleton avec transition
            setTimeout(() => {
                placeholder.style.display = 'none';
                
                // Afficher contenu réel
                const content = document.getElementById(contentId);
                if (content) {
                    content.style.display = 'block';
                }
            }, 400);
        });
    });
});
</script>

{{-- 
  UTILISATION DANS nationalites.index:
  
  <!-- Skeleton Placeholder -->
  <div id="nationalites-skeleton" 
       data-skeleton-placeholder 
       data-skeleton-type="table" 
       data-content-id="nationalites-content">
  </div>

  <!-- Contenu réel -->
  <div id="nationalites-content">
      <table>...</table>
  </div>
--}}