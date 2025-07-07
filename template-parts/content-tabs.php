<?php
/**
 * Tabs content template part
 *
 * @package TailPress
 */

// Get tabs data (this would come from custom fields or content)
$tabs = [
    ['title' => 'Tab 1', 'content' => 'Content for tab 1'],
    ['title' => 'Tab 2', 'content' => 'Content for tab 2'],
    ['title' => 'Tab 3', 'content' => 'Content for tab 3'],
];
?>

<div x-data="tabs(0)" class="bg-white rounded-lg shadow-sm border border-zinc-200">
    <!-- Tab Headers -->
    <div class="flex border-b border-zinc-200">
        <?php foreach ($tabs as $index => $tab): ?>
            <button @click="setTab(<?php echo $index; ?>)"
                    :class="activeTab === <?php echo $index; ?> ? 'bg-primary text-white' : 'bg-white text-zinc-700 hover:bg-zinc-50'"
                    class="flex-1 px-6 py-3 text-sm font-medium transition-colors first:rounded-tl-lg last:rounded-tr-lg">
                <?php echo esc_html($tab['title']); ?>
            </button>
        <?php endforeach; ?>
    </div>
    
    <!-- Tab Content -->
    <div class="p-6">
        <?php foreach ($tabs as $index => $tab): ?>
            <div x-show="activeTab === <?php echo $index; ?>"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="text-zinc-600">
                <?php echo wp_kses_post($tab['content']); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>