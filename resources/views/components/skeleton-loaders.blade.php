{{-- Skeleton Loader Styles et Animations --}}
<style>
    /* Shimmer Animation */
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }

    .skeleton {
        background: linear-gradient(
            90deg,
            #f3f4f6 25%,
            #e5e7eb 50%,
            #f3f4f6 75%
        );
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
        border-radius: 0.375rem;
    }

    /* Skeleton Variants */
    .skeleton-text {
        height: 1rem;
        margin-bottom: 0.5rem;
        border-radius: 0.25rem;
    }

    .skeleton-text.lg {
        height: 1.5rem;
    }

    .skeleton-text.sm {
        height: 0.75rem;
    }

    .skeleton-heading {
        height: 2rem;
        margin-bottom: 1rem;
        border-radius: 0.375rem;
    }

    .skeleton-card {
        padding: 1.5rem;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .skeleton-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .skeleton-card-title {
        height: 1.5rem;
        width: 60%;
        background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
        border-radius: 0.375rem;
    }

    .skeleton-card-subtitle {
        height: 1rem;
        width: 40%;
        background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
        border-radius: 0.375rem;
        margin-top: 0.5rem;
    }

    .skeleton-avatar {
        display: inline-block;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
    }

    .skeleton-table-row {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        margin-bottom: 0.5rem;
    }

    .skeleton-table-cell {
        flex: 1;
        height: 1.25rem;
        background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
        border-radius: 0.25rem;
    }

    @media (max-width: 640px) {
        .skeleton-text {
            height: 0.875rem;
        }

        .skeleton-card {
            padding: 1rem;
        }
    }
</style>

<!-- Skeleton Text Line -->
<template id="skeleton-text-template">
    <div class="skeleton skeleton-text"></div>
</template>

<!-- Skeleton Heading -->
<template id="skeleton-heading-template">
    <div class="skeleton skeleton-heading"></div>
</template>

<!-- Skeleton Card -->
<template id="skeleton-card-template">
    <div class="skeleton-card">
        <div class="skeleton-card-header">
            <div>
                <div class="skeleton-card-title"></div>
                <div class="skeleton-card-subtitle"></div>
            </div>
            <div class="skeleton-avatar"></div>
        </div>
        <div class="skeleton skeleton-text"></div>
        <div class="skeleton skeleton-text"></div>
        <div class="skeleton skeleton-text sm"></div>
    </div>
</template>

<!-- Skeleton Stats Grid -->
<template id="skeleton-stats-template">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="skeleton skeleton-text lg mb-4"></div>
            <div class="skeleton skeleton-heading mb-4" style="width: 70%;"></div>
            <div class="skeleton skeleton-text sm"></div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="skeleton skeleton-text lg mb-4"></div>
            <div class="skeleton skeleton-heading mb-4" style="width: 70%;"></div>
            <div class="skeleton skeleton-text sm"></div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="skeleton skeleton-text lg mb-4"></div>
            <div class="skeleton skeleton-heading mb-4" style="width: 70%;"></div>
            <div class="skeleton skeleton-text sm"></div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="skeleton skeleton-text lg mb-4"></div>
            <div class="skeleton skeleton-heading mb-4" style="width: 70%;"></div>
            <div class="skeleton skeleton-text sm"></div>
        </div>
    </div>
</template>

<!-- Skeleton Table -->
<template id="skeleton-table-template">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="skeleton skeleton-heading mb-6"></div>
            <div class="space-y-2">
                <div class="skeleton-table-row">
                    <div class="skeleton-table-cell" style="flex: 2;"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                </div>
                <div class="skeleton-table-row">
                    <div class="skeleton-table-cell" style="flex: 2;"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                </div>
                <div class="skeleton-table-row">
                    <div class="skeleton-table-cell" style="flex: 2;"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                </div>
                <div class="skeleton-table-row">
                    <div class="skeleton-table-cell" style="flex: 2;"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Skeleton List -->
<template id="skeleton-list-template">
    <div class="space-y-4">
        <div class="skeleton-card">
            <div class="flex items-center gap-4">
                <div class="skeleton-avatar" style="width: 3rem; height: 3rem;"></div>
                <div class="flex-1">
                    <div class="skeleton-card-title" style="width: 70%;"></div>
                    <div class="skeleton skeleton-text sm" style="width: 50%; margin-top: 0.5rem;"></div>
                </div>
            </div>
        </div>
        <div class="skeleton-card">
            <div class="flex items-center gap-4">
                <div class="skeleton-avatar" style="width: 3rem; height: 3rem;"></div>
                <div class="flex-1">
                    <div class="skeleton-card-title" style="width: 70%;"></div>
                    <div class="skeleton skeleton-text sm" style="width: 50%; margin-top: 0.5rem;"></div>
                </div>
            </div>
        </div>
        <div class="skeleton-card">
            <div class="flex items-center gap-4">
                <div class="skeleton-avatar" style="width: 3rem; height: 3rem;"></div>
                <div class="flex-1">
                    <div class="skeleton-card-title" style="width: 70%;"></div>
                    <div class="skeleton skeleton-text sm" style="width: 50%; margin-top: 0.5rem;"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// Skeleton Loader Utility Functions
window.SkeletonLoader = {
    // Afficher skeleton
    show(containerId, type = 'card') {
        const container = document.getElementById(containerId);
        if (!container) return;

        const templateId = `skeleton-${type}-template`;
        const template = document.getElementById(templateId);
        if (!template) return;

        container.innerHTML = '';
        const clone = template.content.cloneNode(true);
        container.appendChild(clone);
    },

    // Masquer skeleton et afficher contenu
    hide(containerId) {
        const container = document.getElementById(containerId);
        if (container) {
            container.querySelectorAll('.skeleton, .skeleton-card').forEach(el => {
                el.style.display = 'none';
            });
        }
    },

    // Remplacer skeleton par contenu
    replace(containerId, htmlContent) {
        const container = document.getElementById(containerId);
        if (container) {
            container.innerHTML = htmlContent;
        }
    },

    // Afficher skeleton pendant n secondes
    showFor(containerId, type = 'card', duration = 2000) {
        this.show(containerId, type);
        setTimeout(() => {
            this.hide(containerId);
        }, duration);
    }
};

// Auto-hide skeletons when page loads
document.addEventListener('load', function() {
    document.querySelectorAll('[data-skeleton="auto-hide"]').forEach(el => {
        el.style.display = 'none';
    });
});
</script>