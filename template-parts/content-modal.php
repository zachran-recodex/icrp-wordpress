<?php
/**
 * Modal content template part
 *
 * @package TailPress
 */
?>

<div x-data="modal">
    <!-- Trigger Button -->
    <button @click="show"
            class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
        <?php _e('Open Modal', 'tailpress'); ?>
    </button>
    
    <!-- Modal -->
    <div x-show="open"
         @keydown.escape.window="hide"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         style="display: none;">
        
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50" @click="hide"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md mx-auto"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-zinc-200">
                <h3 class="text-lg font-semibold text-zinc-900"><?php the_title(); ?></h3>
                <button @click="hide"
                        class="text-zinc-400 hover:text-zinc-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Content -->
            <div class="p-6">
                <div class="text-zinc-600">
                    <?php the_content(); ?>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 p-6 border-t border-zinc-200">
                <button @click="hide"
                        class="px-4 py-2 text-zinc-700 bg-zinc-100 hover:bg-zinc-200 rounded-lg transition-colors">
                    <?php _e('Close', 'tailpress'); ?>
                </button>
                <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    <?php _e('Action', 'tailpress'); ?>
                </button>
            </div>
        </div>
    </div>
</div>