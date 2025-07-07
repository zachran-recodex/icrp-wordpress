<?php
/**
 * Accordion content template part
 *
 * @package TailPress
 */
?>

<div x-data="accordion" class="border border-zinc-200 rounded-lg mb-4">
    <button @click="toggle" 
            class="w-full px-6 py-4 text-left flex items-center justify-between bg-white hover:bg-zinc-50 transition-colors rounded-lg">
        <span class="font-medium text-zinc-900"><?php the_title(); ?></span>
        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-zinc-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-zinc-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
        </svg>
    </button>
    
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 max-h-0"
         x-transition:enter-end="opacity-100 max-h-96"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 max-h-96"
         x-transition:leave-end="opacity-0 max-h-0"
         class="overflow-hidden">
        <div class="px-6 pb-4 text-zinc-600">
            <?php the_content(); ?>
        </div>
    </div>
</div>